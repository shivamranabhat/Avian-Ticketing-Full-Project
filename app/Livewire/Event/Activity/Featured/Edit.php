<?php

namespace App\Livewire\Event\Activity\Featured;

use Livewire\Component;
use App\Models\Activity;
use App\Models\FeaturedActivity;

class Edit extends Component
{
    public $featured;
    public $slug;

    protected $rules = [
        'slug' => 'nullable|string|max:255',
    ];

    public function mount($slug)
    {
        $this->featured = FeaturedActivity::whereSlug($slug)->first();
        $this->slug     = $this->featured->slug;
    }

    public function update()
    {
        $this->validate();

        $this->featured->update([
            'slug' => $this->slug
        ]);

        session()->flash('success', 'Activity set to featured successfully.');
        return redirect()->route('activity.featured.index');
    }


    public function render()
    {
         $activities = Activity::whereDoesntHave('featured')
            ->orderBy('name')
            ->get(['id', 'name']);
        return view('livewire.event.activity.featured.edit',compact('activities'));
    }
}
