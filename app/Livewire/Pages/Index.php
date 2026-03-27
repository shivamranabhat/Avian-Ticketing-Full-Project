<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\FeaturedEvent;
use App\Models\Slider;

class Index extends Component
{
    public $events;
    public $sliders;

    public function mount()
    {
        $this->events = FeaturedEvent::with('event')->get();
        $this->sliders = Slider::latest()->get();
    }

    public function render()
    {
        return view('livewire.pages.index')->layout('layouts.ticket');
    }
}
