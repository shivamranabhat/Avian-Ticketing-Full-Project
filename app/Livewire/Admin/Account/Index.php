<?php

namespace App\Livewire\Admin\Account;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

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
        $account = User::find($id)->first()->delete();
        session()->flash('success', 'Account deleted successfully.');
    }

    public function render()
    {
        $accounts = User::query()
            ->when($this->search, function ($query) {
                $query->where('email', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%')
                      ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
            ->where('platform', 'Pass')
            ->orWhere('platform', 'Ticket')
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.account.index', compact('accounts'));
    }
}