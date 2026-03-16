<?php

namespace App\Livewire\Event\Admin\Account;

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
        $account = User::find($id)->where('platform', 'Ticket')->first();
        if ($account) {
            $account->delete();
        }
        dd($account);
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
            ->orWhere('platform', 'Ticket')
            ->latest()
            ->paginate($this->perPage);
        return view('livewire.event.admin.account.index',compact('accounts'));
    }
}
