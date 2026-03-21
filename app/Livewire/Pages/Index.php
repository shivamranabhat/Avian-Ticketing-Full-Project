<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\FeaturedEvent;

class Index extends Component
{
    public $events;
    public function mount()
    {
        $this->events = FeaturedEvent::with('event')->get();
    }

    public function render()
    {
        return view('livewire.pages.index')->layout('layouts.ticket');
    }
}
