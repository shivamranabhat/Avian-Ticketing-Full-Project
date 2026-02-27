<?php

namespace App\Livewire\Event;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Event;
use App\Models\EventCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $slug;

    public $name = '';
    public $date = '';
    public $location = '';
    public $organizer = '';
    public $about = '';
    public $venue = '';
    public $event_category_id = '';
    public $categories;
    public $images = [];
    public $existingImages = [];

    public $artistCount = 0;
    public $artists = [];

    public $ticketCount = 0;
    public $tickets = [];

    protected $rules = [
        'name'          => 'required|string|max:255',
        'date'          => 'required|date',
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

    public function mount($slug)
    {
        $event = Event::whereSlug($this->slug)->first();
        $this->categories = EventCategory::latest()->get();
        $this->eventId = $event->id;
        $this->name       = $event->name;
        $this->event_category_id = $event->event_category_id;
        $this->date       = Carbon::parse($event->date)->format('Y-m-d\TH:i');
        $this->location   = $event->location;
        $this->organizer  = $event->organizer;
        $this->about      = $event->about;
        $this->venue      = $event->venue;
        $this->existingImages = $event->images ?? [];

        $this->artistCount = $event->artists->count();
        $this->artists = $event->artists->map(function ($a) {
            return [
                'name'           => $a->name,
                'image'          => null,
                'existing_image' => $a->image,
            ];
        })->toArray();

        $this->ticketCount = $event->tickets->count();
        $this->tickets = $event->tickets->map(function ($t) {
            return [
                'name'  => $t->name,
                'price' => $t->price,
            ];
        })->toArray();
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

    public function removeExistingImage($index)
    {
        unset($this->existingImages[$index]);
        $this->existingImages = array_values($this->existingImages);
    }

    public function save()
    {
        $this->validate();

        $newImagePaths = [];
        foreach ($this->images as $image) {
            $newImagePaths[] = $image->store('events/images', 'public');
        }
        $allImages = array_merge($this->existingImages, $newImagePaths);

        $event = Event::whereSlug($this->slug)->first();
        $event->update([
            'name'      => $this->name,
            'date'      => $this->date,
            'location'  => $this->location,
            'organizer' => $this->organizer,
            'about'     => $this->about,
            'venue'     => $this->venue,
            'images'    => $allImages ?: null,
        ]);

        $event->artists()->delete();
        foreach ($this->artists as $artist) {
            if (empty($artist['name'])) continue;
            $imagePath = $artist['existing_image'] ?? null;
            if ($artist['image']) {
                $imagePath = $artist['image']->store('events/artists', 'public');
            }
            $event->artists()->create([
                'name'  => $artist['name'],
                'image' => $imagePath,
            ]);
        }

        $event->tickets()->delete();
        foreach ($this->tickets as $ticket) {
            if (empty($ticket['name'])) continue;
            $event->tickets()->create([
                'name'  => $ticket['name'],
                'price' => $ticket['price'],
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
