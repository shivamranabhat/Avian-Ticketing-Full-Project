<?php

namespace App\Livewire\Event;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Event;
use App\Models\Page;
use App\Models\EventCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $date;
    public $event_category_id;
    public $location;
    public $organizer;
    public $sponsor;
    public $about;
    public $venue;

    // New fields
    public $main_image;      // Single main/featured image
    public $image_alt;       // Alt text for main image

    public $images = [];     // Additional gallery images

    public $artistCount = 0;
    public $artists = [];

    public $ticketCount = 0;
    public $tickets = [];

    public $faqCount = 0;
    public $faqs = [];

    public $tocCount = 0;
    public $tocs = [];

    public function mount()
    {
        $this->artists = [];
        $this->tickets = [];
        $this->faqs    = [];
        $this->tocs    = [];
    }

    protected $rules = [
        'name'              => 'required|string|max:255',
        'date'              => 'required|date',
        'event_category_id' => 'required|exists:event_categories,id',
        'location'          => 'required|string|max:255',
        'organizer'         => 'required|string|max:255',
        'sponsor'           => 'nullable|string|max:255',
        'about'             => 'nullable|string',
        'venue'             => 'nullable|string|max:255',

        'main_image'        => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        'image_alt'         => 'nullable|string|max:255',

        'images.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',

        'artistCount'       => 'integer|min:0',
        'artists.*.name'    => 'required_if:artistCount,>,0|string|max:255',
        'artists.*.image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',

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

    // Dynamic count handlers
    public function updatedArtistCount($value) { $this->syncDynamicItems('artists', $value, ['name' => '', 'image' => null]); }
    public function updatedTicketCount($value) { $this->syncDynamicItems('tickets', $value, ['name' => '','total_seat' => '', 'price' => '']); }
    public function updatedFaqCount($value)    { $this->syncDynamicItems('faqs', $value, ['title' => '', 'description' => '']); }
    public function updatedTocCount($value)    { $this->syncDynamicItems('tocs', $value, ['title' => '', 'description' => '']); }

    private function syncDynamicItems($property, $newCount, $defaultItem)
    {
        $value  = max(0, (int) $newCount);
        $current = count($this->$property);

        if ($value > $current) {
            for ($i = $current; $i < $value; $i++) {
                $this->$property[] = $defaultItem;
            }
        } elseif ($value < $current) {
            $this->$property = array_slice($this->$property, 0, $value);
        }
    }

    public function removeImage($key)
    {
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
            $this->images = array_values($this->images);
        }
    }

    public function save()
    {
        $this->validate();

        // Store main image
        $mainImagePath = $this->main_image->store('events/main', 'public');

        // Store additional gallery images
        $imagePaths = [];
        foreach ($this->images as $image) {
            $imagePaths[] = $image->store('events/images', 'public');
        }

        // Create Event
        $event = Event::create([
            'name'              => $this->name,
            'slug'              => Str::slug($this->name . '-' . now()->format('YmdHis')),
            'event_category_id' => $this->event_category_id,
            'date'              => $this->date,
            'location'          => $this->location,
            'organizer'         => $this->organizer,
            'sponsor'           => $this->sponsor,
            'about'             => $this->about,
            'venue'             => $this->venue,
            'main_image'        => $mainImagePath,
            'image_alt'         => $this->image_alt ?? $this->name,
            'images'            => $imagePaths ?: null,
        ]);
        Page::create([
            'name'    => $event->name,
            'slug'     => $event->slug,
        ]);

        // Artists
        foreach ($this->artists as $artist) {
            if (empty($artist['name'])) continue;
            $artistImage = $artist['image'] ? $artist['image']->store('events/artists', 'public') : null;
            $event->artists()->create([
                'name'  => $artist['name'],
                'image' => $artistImage,
            ]);
        }

        // Tickets
        foreach ($this->tickets as $ticket) {
            if (empty($ticket['name'])) continue;
            $event->tickets()->create([
                'name'  => $ticket['name'],
                'total_seat'  => $ticket['total_seat'],
                'price' => $ticket['price'],
            ]);
        }

        // FAQs
        foreach ($this->faqs as $faq) {
            if (empty($faq['title'])) continue;
            $event->faqs()->create([
                'title'       => $faq['title'],
                'description' => $faq['description'],
                'slug'        => Str::slug($faq['title'] . '-' . time()),
            ]);
        }

        // TOCs
        foreach ($this->tocs as $toc) {
            if (empty($toc['title'])) continue;
            $event->tocs()->create([
                'title'       => $toc['title'],
                'description' => $toc['description'],
                'slug'        => Str::slug($toc['title'] . '-' . time()),
            ]);
        }

        session()->flash('success', 'Event created successfully.');
        return redirect()->route('event.index');
    }

    public function render()
    {
        $categories = EventCategory::select('id', 'name')->latest()->get();
        return view('livewire.event.create', compact('categories'));
    }
}