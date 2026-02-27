<?php

namespace App\Livewire\Admin\Account;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Create extends Component
{
    public $email = '';
    public $phone = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name'                  => 'required|string|max:255',
        'email'                 => 'required|email|unique:users,email',
        'phone'                 => 'nullable|string|max:20',
        'password'              => 'required|min:8|confirmed',
        'password_confirmation' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        // Generate slug automatically from email
        // Examples:
        //   john.doe@example.com   →  john-doe
        //   admin@company.com      →  admin-company-com-xyz123 (if collision)
        $base = Str::slug(
            Str::before($this->email, '@') . '-' . 
            Str::afterLast($this->email, '@')
        );

        $slug = $base;
        $counter = 1;

        // Ensure uniqueness (very simple collision handling)
        while (User::where('slug', $slug)->exists()) {
            $slug = $base . '-' . Str::random(6);
            $counter++;
            if ($counter > 10) { // safety limit
                $slug = $base . '-' . Str::random(12);
                break;
            }
        }

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'phone'    => $this->phone ?: null,
            'password' => Hash::make($this->password),
            'platform' => 'Pass',
            'slug'     => $slug,
        ]);

        session()->flash('success', 'Account created successfully!');

        return redirect()->route('account.index');
    }

    public function render()
    {
        return view('livewire.admin.account.create');
    }
}