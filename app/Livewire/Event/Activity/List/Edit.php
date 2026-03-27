<?php

namespace App\Livewire\Event\Activity\List;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Activity;
use App\Models\ActivityCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public $slug;
    public $activity;

    public $name = '';
    public $location = '';
    public $organizer = '';
    public $about = '';
    public $activity_category_id = '';
    public $categories;

    // Main Image & Alt Text
    public $main_image;           // New uploaded main image
    public $img_alt = '';

    // Gallery Images
    public $images = [];                // New uploaded gallery images
    public $existingImages = [];        // Existing gallery images paths


    public $ticketCount = 0;
    public $tickets = [];

    public $faqCount = 0;
    public $faqs = [];

    public $tocCount = 0;
    public $tocs = [];

    protected $rules = [
        'name'              => 'required|string|max:255',
        'location'          => 'required|string|max:255',
        'organizer'         => 'required|string|max:255',
        'about'             => 'nullable|string',
        'activity_category_id' => 'required|exists:activity_categories,id',

        'main_image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        'img_alt'         => 'nullable|string|max:255',

        'images.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',

        'ticketCount'       => 'integer|min:0',
        'tickets.*.name'    => 'required_if:ticketCount,>,0|string|max:100',
        'tickets.*.price'   => 'required_if:ticketCount,>,0|numeric|min:0',

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
        $this->activity = Activity::where('slug', $slug)->firstOrFail();

        $this->categories = ActivityCategory::latest()->get();

        $this->name              = $this->activity->name;
        $this->activity_category_id = $this->activity->activity_category_id;
        $this->date              = Carbon::parse($this->activity->date)->format('Y-m-d\TH:i');
        $this->location          = $this->activity->location;
        $this->organizer         = $this->activity->organizer;
        $this->about             = $this->activity->about;
        $this->venue             = $this->activity->venue;
        $this->img_alt         = $this->activity->img_alt ?? $this->activity->name;
        $this->existingImages    = $this->activity->images ?? [];


        // Tickets
        $this->ticketCount = $this->activity->tickets->count();
        $this->tickets = $this->activity->tickets->map(fn($t) => [
            'name'  => $t->name,
            'price' => $t->price,
        ])->toArray();

        // FAQs
        $this->faqCount = $this->activity->faqs->count();
        $this->faqs = $this->activity->faqs->map(fn($f) => [
            'title'       => $f->title,
            'description' => $f->description,
        ])->toArray();

        // TOCs
        $this->tocCount = $this->activity->tocs->count();
        $this->tocs = $this->activity->tocs->map(fn($t) => [
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

        $activity = Activity::where('slug', $this->slug)->firstOrFail();

        // === Handle Main Image ===
        $mainImagePath = $activity->main_image; // keep old by default
        if ($this->main_image) {
            // Delete old main image if exists
            if ($activity->main_image && Storage::disk('public')->exists($activity->main_image)) {
                Storage::disk('public')->delete($activity->main_image);
            }
            $mainImagePath = $this->main_image->store('activities/main', 'public');
        }

        // === Handle Gallery Images ===
        $newImagePaths = [];
        foreach ($this->images as $image) {
            $newImagePaths[] = $image->store('activities/images', 'public');
        }
        $allImages = array_merge($this->existingImages, $newImagePaths);

        // Update Event
        $activity->update([
            'name'              => $this->name,
            'location'          => $this->location,
            'organizer'         => $this->organizer,
            'about'             => $this->about,
            'activity_category_id' => $this->activity_category_id,
            'main_image'        => $mainImagePath,
            'img_alt'         => $this->img_alt ?? $this->name,
            'images'            => $allImages ?: null,
        ]);

        // Tickets
        $activity->tickets()->delete();
        foreach ($this->tickets as $ticket) {
            if (empty($ticket['name'])) continue;
            $activity->tickets()->create([
                'name'  => $ticket['name'],
                'price' => $ticket['price'],
            ]);
        }

        // FAQs
        $activity->faqs()->delete();
        foreach ($this->faqs as $faq) {
            if (empty($faq['title'])) continue;
            $activity->faqs()->create([
                'title'       => $faq['title'],
                'description' => $faq['description'],
                'slug'        => Str::slug($faq['title'] . '-' . time()),
            ]);
        }

        // TOCs
        $activity->tocs()->delete();
        foreach ($this->tocs as $toc) {
            if (empty($toc['title'])) continue;
            $activity->tocs()->create([
                'title'       => $toc['title'],
                'description' => $toc['description'],
                'slug'        => Str::slug($toc['title'] . '-' . time()),
            ]);
        }

        session()->flash('success', 'Activity updated successfully.');
        return redirect()->route('activity.list.index');
    }


    public function render()
    {
        return view('livewire.event.activity.list.edit');
    }
}
