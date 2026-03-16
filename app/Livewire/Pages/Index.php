<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\EventCategory;
use App\Models\FeaturedEvent;

class Index extends Component
{
    public $eventCategories;
    public $events;
    public function mount()
    {
        $this->eventCategories = EventCategory::select('id', 'name')->get();
        $this->events = FeaturedEvent::with('event')->get();
    }

    public function render()
    {
        return view('livewire.pages.index')->layout('layouts.ticket');
    }
}
