<?php

namespace App\Livewire\Admin\Account;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Edit extends Component
{
    public $slug;
    public $account;

    public $email = '';
    public $phone = '';
    public $password = '';
    public $password_confirmation = '';

    public function mount(string $slug)
    {
        $this->account = User::whereSlug($this->slug)->first();
        $this->email   = $this->account->email;
        $this->phone   = $this->account->phone ?? '';
    }

    protected function rules()
    {
        return [
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email,' . $this->account->id,
            'phone'                 => 'nullable|string|max:20',
            'password'              => 'nullable|min:8|confirmed',
            'password_confirmation' => 'nullable|required_with:password',
        ];
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone ?: null,
        ];

        // Only update password if provided
        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $this->account->update($data);

        session()->flash('success', 'Account updated successfully!');

        return redirect()->route('account.index');
    }

    public function render()
    {
        return view('livewire.admin.account.edit');
    }
}
