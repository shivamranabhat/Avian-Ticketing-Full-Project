<?php

namespace App\Livewire\Event\Featured;

use App\Models\FeaturedEvent;
use Livewire\Component;

class Edit extends Component
{
    public $featured;
    public $slug;

    protected $rules = [
        'slug' => 'nullable|string|max:255|unique:featured_events,slug,{{ $this->featured->id }}',
    ];

    public function mount($slug)
    {
        $this->featured = FeaturedEvent::whereSlug($slug)->first();
        $this->slug     = $this->featured->slug;
    }

    public function update()
    {
        $this->validate();

        $this->featured->update([
            'slug' => $this->slug
        ]);

        session()->flash('success', 'Event created successfully.');
        return redirect()->route('event.featured.index');
    }

    public function render()
    {
        return view('livewire.featured-event.edit');
    }
}