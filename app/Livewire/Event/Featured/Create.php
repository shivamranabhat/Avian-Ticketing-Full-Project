<?php

namespace App\Livewire\Event\Featured;

use App\Models\Event;
use App\Models\FeaturedEvent;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $event_id;

    protected $rules = [
        'event_id' => 'required|exists:events,id|unique:featured_events,event_id',
    ];

    public function save()
    {
        $this->validate();

        FeaturedEvent::create([
            'event_id' => $this->event_id,
            'slug'     => Str::slug(Event::find($this->event_id)->name . '-' . now()->format('YmdHis')),
        ]);

        session()->flash('success', 'Event set to featured successfully');
        return redirect()->route('event.featured.index');
    }

    public function render()
    {
        // Only show events that are NOT already featured
        $events = Event::whereDoesntHave('featured')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('livewire.event.featured.create', compact('events'));
    }
}