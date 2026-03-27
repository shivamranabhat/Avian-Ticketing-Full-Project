<?php

namespace App\Livewire\Event\Activity\Featured;

use Livewire\Component;
use App\Models\FeaturedActivity;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $perPage = 10;

    public function delete($id)
    {
        $featured = FeaturedActivity::findOrFail($id);
        $featured->delete();
        session()->flash('success', "Activity removed from featured.");
    }


    public function render()
    {
        $featured = FeaturedActivity::query()
            ->with('activity')
            ->when($this->search, function ($q) {
                $q->whereHas('activity', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
        return view('livewire.event.activity.featured.index',compact('featured'));
    }
}
