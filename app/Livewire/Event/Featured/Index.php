<?php

namespace App\Livewire\Event\Featured;

use Livewire\Component;
use App\Models\FeaturedEvent;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $perPage = 10;

    public function delete($id)
    {
        $featured = FeaturedEvent::findOrFail($id);
        $featured->delete();
        session()->flash('success', "Event removed from featured.");
    }


    public function render()
    {
        $featured = FeaturedEvent::query()
            ->with('event')
            ->when($this->search, function ($q) {
                $q->whereHas('event', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
        return view('livewire.event.featured.index',compact('featured'));
    }
}
