<?php

namespace App\Livewire\Event\Slider;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

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

    public function delete($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        session()->flash('message', 'Slider deleted successfully.');
    }

    public function render()
    {
        $sliders = Slider::query()
            ->when($this->search, fn ($q) =>
                $q->where('title', 'like', "%{$this->search}%")
            )
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.event.slider.index', compact('sliders'));
    }
}
