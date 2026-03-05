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

        $baseSlug = Str::slug($this->name);

        // Get all slugs that start with baseSlug
        $existingSlugs = User::where('slug', 'LIKE', $baseSlug . '%')
            ->pluck('slug')
            ->toArray();

        if (!in_array($baseSlug, $existingSlugs)) {
            $slug = $baseSlug;
        } else {
            $max = 1;

            foreach ($existingSlugs as $existingSlug) {
                if (preg_match('/^' . preg_quote($baseSlug, '/') . '-(\d+)$/', $existingSlug, $matches)) {
                    $number = (int) $matches[1];
                    $max = max($max, $number);
                }
            }

            $slug = $baseSlug . '-' . ($max + 1);
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