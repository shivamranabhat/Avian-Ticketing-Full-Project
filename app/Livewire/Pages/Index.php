<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\FeaturedEvent;
use App\Models\FeaturedActivity;
use App\Models\Slider;
use App\Models\BodyContent;

class Index extends Component
{
    public $events;
    public $activities;
    public $sliders;
    public $header;

    public function mount()
    {
        $this->events = FeaturedEvent::with('event')->get();
        $this->activities = FeaturedActivity::with('activity')->get();
        $this->sliders = Slider::latest()->get();
        $this->header = BodyContent::where('slug', 'header')->first();
    }

    public function render()
    {
        return view('livewire.pages.index');
    }
}
