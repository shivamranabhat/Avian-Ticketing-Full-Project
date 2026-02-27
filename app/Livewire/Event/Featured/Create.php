<?php

namespace App\Livewire\Event\Featured;

use App\Models\Event;
use App\Models\FeaturedEvent;
use Livewire\Component;

class Create extends Component
{
    public $event_id;
    public $slug;

    protected $rules = [
        'event_id' => 'required|exists:events,id|unique:featured_events,event_id',
        'slug'     => 'nullable|string|max:255|unique:featured_events,slug',
    ];

    public function save()
    {
        $this->validate();

        FeaturedEvent::create([
            'event_id' => $this->event_id,
            'slug'     => $this->slug ?? \Str::slug(Event::find($this->event_id)->name . '-' . now()->format('YmdHis')),
        ]);

        session()->flash('success', 'Event created successfully.');
        return redirect()->route('event.index');
    }

    public function render()
    {
        // Only show events that are NOT already featured
        $events = Event::whereDoesntHave('featured')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('livewire.featured-event.create', compact('events'));
    }
}