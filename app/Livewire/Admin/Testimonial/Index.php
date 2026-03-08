<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use App\Models\Testimonial;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        // Delete the associated image if it exists
        if ($testimonial->image) {
            // Storage::disk('public') matches how you stored it
            if (Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }
        }

        // Delete the record from database
        $testimonial->delete();

        session()->flash('success', 'Testimonial deleted successfully.');
    }

    public function render()
    {
            $testimonials = Testimonial::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('role', 'like', '%' . $this->search . '%');
                })
                ->latest()
                ->paginate($this->perPage);
        return view('livewire.admin.testimonial.index', compact('testimonials'));
    }
}
