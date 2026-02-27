<?php

namespace App\Livewire\Event;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Event;
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
    public $about;
    public $venue;
    public $existingImages = [];

    public $artistCount = 0;
    public $artists = [];

    public $ticketCount = 0;
    public $tickets = [];

    public $images = [];

    public function removeImage($key)
    {
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
            $this->images = array_values($this->images); // re-index array
        }
    }

    protected $rules = [
        'name'          => 'required|string|max:255',
        'date'          => 'required|date',
        'event_category_id'   => 'required',
        'location'      => 'required|string|max:255',
        'organizer'     => 'required|string|max:255',
        'about'         => 'nullable|string',
        'venue'         => 'nullable|string|max:255',
        'images.*'      => 'nullable|image|max:5120',
        'artistCount'   => 'integer|min:0',
        'artists.*.name'  => 'required_if:artistCount,>,0|string|max:255',
        'artists.*.image' => 'nullable|image|max:2048',
        'ticketCount'   => 'integer|min:0',
        'tickets.*.name'  => 'required_if:ticketCount,>,0|string|max:100',
        'tickets.*.price' => 'required_if:ticketCount,>,0|numeric|min:0',
    ];

    public function mount()
    {
        $this->artists = [];
        $this->tickets = [];
        $this->existingImages = [];
    }

    public function updatedArtistCount($value)
    {
        $value = max(0, (int)$value);
        $current = count($this->artists);

        if ($value > $current) {
            for ($i = $current; $i < $value; $i++) {
                $this->artists[] = ['name' => '', 'image' => null, 'existing_image' => null];
            }
        } elseif ($value < $current) {
            $this->artists = array_slice($this->artists, 0, $value);
        }
    }

    public function updatedTicketCount($value)
    {
        $value = max(0, (int)$value);
        $current = count($this->tickets);

        if ($value > $current) {
            for ($i = $current; $i < $value; $i++) {
                $this->tickets[] = ['name' => '', 'price' => ''];
            }
        } elseif ($value < $current) {
            $this->tickets = array_slice($this->tickets, 0, $value);
        }
    }

    public function save()
    {
        $this->validate();

        $newImagePaths = [];
        foreach ($this->images as $image) {
            $newImagePaths[] = $image->store('events/images', 'public');
        }
        $allImages = $newImagePaths;
        $event = Event::create([
            'name'      => $this->name,
            'event_category_id'=> $this->event_category_id,
            'date'      => $this->date,
            'location'  => $this->location,
            'organizer' => $this->organizer,
            'about'     => $this->about,
            'venue'     => $this->venue,
            'images'    => $allImages ?: null,
            'slug'      => Str::slug($this->name.now())
        ]);

        foreach ($this->artists as $artist) {
            if (empty($artist['name'])) continue;
            $imagePath = null;
            if ($artist['image']) {
                $imagePath = $artist['image']->store('events/artists', 'public');
            }
            $event->artists()->create([
                'name'  => $artist['name'],
                'image' => $imagePath,
            ]);
        }

        foreach ($this->tickets as $ticket) {
            if (empty($ticket['name'])) continue;
            $event->tickets()->create([
                'name'  => $ticket['name'],
                'price' => $ticket['price'],
            ]);
        }

        session()->flash('success', 'Event created successfully.');
        return redirect()->route('event.featured.index');
    }

    public function render()
    {
        $categories = EventCategory::select('id','name')->latest()->get();
        return view('livewire.event.create',compact('categories'));
    }
}
