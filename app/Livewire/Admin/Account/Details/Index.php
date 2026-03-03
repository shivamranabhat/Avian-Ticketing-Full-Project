<?php

namespace App\Livewire\Admin\Account\Details;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Details;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    protected $updatesQueryString = ['search', 'perPage'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $details = Details::findOrFail($id);

        // Delete related files if needed
        if ($details->profile_pic) {
            \Storage::disk('public')->delete($details->profile_pic);
        }

        if ($details->cover_pic) {
            \Storage::disk('public')->delete($details->cover_pic);
        }

        if ($details->side_pic) {
            \Storage::disk('public')->delete($details->side_pic);
        }

        if ($details->cv) {
            \Storage::disk('public')->delete($details->cv);
        }

        $details->delete();

        session()->flash('success', 'Details deleted successfully.');
    }

    public function render()
    {
        $accounts = Details::with('user')
            ->where(function ($query) {
                $query->where('slug', 'like', "%{$this->search}%")
                    ->orWhere('location', 'like', "%{$this->search}%")
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', "%{$this->search}%")
                          ->orWhere('email', 'like', "%{$this->search}%")
                          ->orWhere('phone', 'like', "%{$this->search}%");
                    });
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.account.details.index', compact('accounts'))->layout('layouts.app');
    }
}