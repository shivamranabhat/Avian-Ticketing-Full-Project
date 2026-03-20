<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\EventCategory;
use App\Models\Event;

class Foryou extends Component
{
    public function render()
    {
        $categories = EventCategory::select('id','name')->latest()->get();
        $events = Event::latest()->get();
        return view('livewire.pages.foryou',compact('categories','events'));
    }
}
