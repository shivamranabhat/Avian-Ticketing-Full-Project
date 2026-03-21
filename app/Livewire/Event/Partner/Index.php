<?php

namespace App\Livewire\Event\Partner;

use Livewire\Component;
use App\Models\Partner;
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
        $partner = Partner::findOrFail($id);

        // Delete the associated image if it exists
        if ($partner->image) {
            // Storage::disk('public') matches how you stored it
            if (Storage::disk('public')->exists($partner->image)) {
                Storage::disk('public')->delete($partner->image);
            }
        }

        // Delete the record from database
        $partner->delete();

        session()->flash('success', 'Partner deleted successfully.');
    }

    public function render()
    {
        $partners = Partner::query()
            ->when($this->search, function ($query) {
                $query->where('img_alt', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate($this->perPage);
        return view('livewire.event.partner.index',compact('partners'));
    }
}
