<?php

namespace App\Livewire\Event\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EventCategory;


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
        $category = EventCategory::where('slug', $slug)
            ->firstOrFail();
        $category->delete();

        session()->flash('success', 'Category deleted successfully!');
    }

    public function render()
    {
        $categories = EventCategory::where('name', 'like', "%{$this->search}%")
            ->latest()
            ->paginate($this->perPage);
        return view('livewire.event.category.index',compact('categories'));
    }
}
