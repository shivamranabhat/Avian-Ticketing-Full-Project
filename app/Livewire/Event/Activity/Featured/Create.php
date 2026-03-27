<?php

namespace App\Livewire\Event\Activity\Featured;

use Livewire\Component;
use App\Models\Activity;
use App\Models\FeaturedActivity;
use Illuminate\Support\Str;

class Create extends Component
{
    public $activity_id;

    protected $rules = [
        'activity_id' => 'required|exists:activities,id|unique:featured_activities,activity_id',
    ];

    public function save()
    {
        $this->validate();

        FeaturedActivity::create([
            'activity_id' => $this->activity_id,
            'slug'     => Str::slug(Activity::find($this->activity_id)->name . '-' . now()->format('YmdHis')),
        ]);

        session()->flash('success', 'Activity set to featured successfully');
        return redirect()->route('activity.featured.index');
    }

    public function render()
    {
        // Only show activities that are NOT already featured
        $activities = Activity::whereDoesntHave('featured')
            ->orderBy('name')
            ->get(['id', 'name']);
        return view('livewire.event.activity.featured.create',compact('activities'));
    }
}
