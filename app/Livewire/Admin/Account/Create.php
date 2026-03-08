<?php

namespace App\Livewire\Admin\Account;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Create extends Component
{
    public $name;
    public $email = '';
    public $phone = '';
    public $password = '';
    public $password_confirmation = '';
    public $is_vip = '';

    protected $rules = [
        'name'                  => 'required|string|max:255',
        'email'                 => 'required|email|unique:users,email',
        'phone'                 => 'nullable|string|max:20',
        'password'              => 'required|min:8|confirmed',
        'password_confirmation' => 'required',
        'is_vip'                => 'nullable',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'phone'    => $this->phone ?: null,
            'password' => Hash::make($this->password),
            'platform' => 'Pass',
            'is_vip'   => $this->is_vip,
            'slug'     => Str::random(6),
        ]);

        session()->flash('success', 'Account created successfully!');

        return redirect()->route('account.index');
    }

    public function render()
    {
        return view('livewire.admin.account.create');
    }
}