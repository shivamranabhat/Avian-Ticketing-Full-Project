<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\ActivityCategory;
use App\Models\Activity;
use App\Models\FeaturedActivity;

class Activities extends Component
{
    public $categories;
    public $activities;
    public $featured;

    public $selectedCategory = null;   // null means "All Activity"

    public function mount()
    {
        $this->categories = ActivityCategory::select('id', 'name')->latest()->get();
        $this->featured = FeaturedActivity::latest()->get();
        $this->loadActivities();
    }

    public function loadActivities()
    {
        $query = Activity::latest();

        if ($this->selectedCategory) {
            $query->where('activity_category_id', $this->selectedCategory);
        }

        $this->activities = $query->get();
    }

    public function filterByCategory($categoryId = null)
    {
        $this->selectedCategory = $categoryId;
        $this->loadActivities();
    }

    public function render()
    {
        return view('livewire.pages.activities', [
            'categories' => $this->categories,
        ]);
    }
}
