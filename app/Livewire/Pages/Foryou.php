<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\EventCategory;
use App\Models\Event;
use App\Models\FeaturedEvent;

class Foryou extends Component
{
    public $categories;
    public $events;
    public $featured;

    public $selectedCategory = null;   // null means "All Events"

    public function mount()
    {
        $this->categories = EventCategory::select('id', 'name')->latest()->get();
        $this->featured = FeaturedEvent::latest()->get();
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $query = Event::latest();

        if ($this->selectedCategory) {
            $query->where('event_category_id', $this->selectedCategory);
        }

        $this->events = $query->get();
    }

    public function filterByCategory($categoryId = null)
    {
        $this->selectedCategory = $categoryId;
        $this->loadEvents();
    }

    public function render()
    {
        return view('livewire.pages.foryou', [
            'categories' => $this->categories,
        ]);
    }
}