<?php

namespace App\Livewire\Event\Activity\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ActivityCategory;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($slug)
    {
        $category = ActivityCategory::where('slug', $slug)
            ->firstOrFail();
        $category->delete();

        session()->flash('success', 'Category deleted successfully!');
    }

    public function render()
    {
        $categories = ActivityCategory::where('name', 'like', "%{$this->search}%")
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.event.activity.category.index',compact('categories'));
    }
}
