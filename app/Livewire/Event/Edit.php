<?php

namespace App\Livewire\Event;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Event;
use App\Models\Page;
use App\Models\EventCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public $slug;

    public $name = '';
    public $date = '';
    public $location = '';
    public $organizer = '';
    public $sponsor = '';
    public $about = '';
    public $venue = '';
    public $event_category_id = '';
    public $categories;

    // Main Image & Alt Text
    public $main_image;           // New uploaded main image
    public $image_alt = '';

    // Gallery Images
    public $images = [];                // New uploaded gallery images
    public $existingImages = [];        // Existing gallery images paths

    public $artistCount = 0;
    public $artists = [];

    public $ticketCount = 0;
    public $tickets = [];

    public $faqCount = 0;
    public $faqs = [];

    public $tocCount = 0;
    public $tocs = [];

    protected $rules = [
        'name'              => 'required|string|max:255',
        'date'              => 'required|date',
        'location'          => 'required|string|max:255',
        'organizer'         => 'required|string|max:255',
        'sponsor'           => 'nullable|string|max:255',
        'about'             => 'nullable|string',
        'venue'             => 'nullable|string|max:255',
        'event_category_id' => 'required|exists:event_categories,id',

        'main_image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        'image_alt'         => 'nullable|string|max:255',

        'images.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',

        'artistCount'       => 'integer|min:0',
        'artists.*.name'    => 'required_if:artistCount,>,0|string|max:255',
        'artists.*.image'   => 'nullable|image|max:2048',

        'ticketCount'       => 'integer|min:0',
        'tickets.*.name'    => 'required_if:ticketCount,>,0|string|max:100',
        'tickets.*.price'   => 'required_if:ticketCount,>,0|numeric|min:0',
        'tickets.*.total_seat'   => 'required_if:ticketCount,>,0|numeric|min:0',

        'faqCount'          => 'integer|min:0',
        'faqs.*.title'      => 'required_if:faqCount,>,0|string|max:255',
        'faqs.*.description'=> 'required_if:faqCount,>,0|string',

        'tocCount'          => 'integer|min:0',
        'tocs.*.title'      => 'required_if:tocCount,>,0|string|max:255',
        'tocs.*.description'=> 'required_if:tocCount,>,0|string',
    ];

    public function mount($slug)
    {
        $this->slug = $slug;
        $event = Event::where('slug', $slug)->firstOrFail();

        $this->categories = EventCategory::latest()->get();

        $this->name              = $event->name;
        $this->event_category_id = $event->event_category_id;
        $this->date              = Carbon::parse($event->date)->format('Y-m-d\TH:i');
        $this->location          = $event->location;
        $this->organizer         = $event->organizer;
        $this->sponsor           = $event->sponsor;
        $this->about             = $event->about;
        $this->venue             = $event->venue;
        $this->image_alt         = $event->image_alt ?? $event->name;
        $this->existingImages    = $event->images ?? [];

        // Artists
        $this->artistCount = $event->artists->count();
        $this->artists = $event->artists->map(fn($a) => [
            'name'           => $a->name,
            'image'          => null,
            'existing_image' => $a->image,
        ])->toArray();

        // Tickets
        $this->ticketCount = $event->tickets->count();
        $this->tickets = $event->tickets->map(fn($t) => [
            'name'  => $t->name,
            'total_seat'  => $t->total_seat,
            'price' => $t->price,
        ])->toArray();

        // FAQs
        $this->faqCount = $event->faqs->count();
        $this->faqs = $event->faqs->map(fn($f) => [
            'title'       => $f->title,
            'description' => $f->description,
        ])->toArray();

        // TOCs
        $this->tocCount = $event->tocs->count();
        $this->tocs = $event->tocs->map(fn($t) => [
            'title'       => $t->title,
            'description' => $t->description,
        ])->toArray();
    }

    // Dynamic count handlers
    public function updatedArtistCount($value) { $this->syncCount('artists', $value, ['name' => '', 'image' => null, 'existing_image' => null]); }
    public function updatedTicketCount($value) { $this->syncCount('tickets', $value, ['name' => '','total_seat' => '', 'price' => '']); }
    public function updatedFaqCount($value)    { $this->syncCount('faqs', $value, ['title' => '', 'description' => '']); }
    public function updatedTocCount($value)    { $this->syncCount('tocs', $value, ['title' => '', 'description' => '']); }

    private function syncCount($prop, $value, $default)
    {
        $value = max(0, (int)$value);
        $current = count($this->$prop);

        if ($value > $current) {
            for ($i = $current; $i < $value; $i++) {
                $this->$prop[] = $default;
            }
        } elseif ($value < $current) {
            $this->$prop = array_slice($this->$prop, 0, $value);
        }
    }

    // Delete image from storage when removed from existing gallery
    public function removeExistingImage($index)
    {
        if (isset($this->existingImages[$index])) {
            if (Storage::disk('public')->exists($this->existingImages[$index])) {
                Storage::disk('public')->delete($this->existingImages[$index]);
            }
            unset($this->existingImages[$index]);
            $this->existingImages = array_values($this->existingImages);
        }
    }

    public function removeNewImage($key)
    {
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
            $this->images = array_values($this->images);
        }
    }

    public function save()
    {
        $this->validate();

        $event = Event::where('slug', $this->slug)->firstOrFail();

        // === Handle Main Image ===
        $mainImagePath = $event->main_image; // keep old by default
        if ($this->main_image) {
            // Delete old main image if exists
            if ($event->main_image && Storage::disk('public')->exists($event->main_image)) {
                Storage::disk('public')->delete($event->main_image);
            }
            $mainImagePath = $this->main_image->store('events/main', 'public');
        }

        // === Handle Gallery Images ===
        $newImagePaths = [];
        foreach ($this->images as $image) {
            $newImagePaths[] = $image->store('events/images', 'public');
        }
        $allImages = array_merge($this->existingImages, $newImagePaths);

        // Update Event
        $event->update([
            'name'              => $this->name,
            'date'              => $this->date,
            'location'          => $this->location,
            'organizer'         => $this->organizer,
            'sponsor'           => $this->sponsor,
            'about'             => $this->about,
            'venue'             => $this->venue,
            'event_category_id' => $this->event_category_id,
            'main_image'        => $mainImagePath,
            'image_alt'         => $this->image_alt ?? $this->name,
            'images'            => $allImages ?: null,
        ]);

        // Artists
        $event->artists()->delete();
        foreach ($this->artists as $artist) {
            if (empty($artist['name'])) continue;
            $imagePath = $artist['existing_image'] ?? null;
            if (!empty($artist['image']) && $artist['image'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                $imagePath = $artist['image']->store('events/artists', 'public');
            }
            $event->artists()->create([
                'name'  => $artist['name'],
                'image' => $imagePath,
            ]);
        }

        // Tickets
        $event->tickets()->delete();
        foreach ($this->tickets as $ticket) {
            if (empty($ticket['name'])) continue;
            $event->tickets()->create([
                'name'  => $ticket['name'],
                'total_seat'  => $ticket['total_seat'],
                'price' => $ticket['price'],
            ]);
        }

        // FAQs
        $event->faqs()->delete();
        foreach ($this->faqs as $faq) {
            if (empty($faq['title'])) continue;
            $event->faqs()->create([
                'title'       => $faq['title'],
                'description' => $faq['description'],
                'slug'        => Str::slug($faq['title'] . '-' . time()),
            ]);
        }

        // TOCs
        $event->tocs()->delete();
        foreach ($this->tocs as $toc) {
            if (empty($toc['title'])) continue;
            $event->tocs()->create([
                'title'       => $toc['title'],
                'description' => $toc['description'],
                'slug'        => Str::slug($toc['title'] . '-' . time()),
            ]);
        }

        // Update the associated page
        $page = Page::where('slug', $event->slug)->first();
        if ($page) {
            $page->update([
                'name' => $event->name,
                'slug' => $event->slug,
            ]);
        }

        session()->flash('success', 'Event updated successfully.');
        return redirect()->route('event.index');
    }

    public function render()
    {
        return view('livewire.event.edit');
    }
}