<?php

namespace App\Livewire\Event\Activity\List;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{ use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function delete($id)
    {
        $activity = Activity::findOrFail($id);

        foreach ($activity->images ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }


        $activity->delete();

        session()->flash('success', 'Activity deleted successfully.');
    }

    public function render()
    {
        $activities = Activity::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->latest()
            ->paginate($this->perPage);
        return view('livewire.event.activity.list.index',compact('activities'));
    }
}
