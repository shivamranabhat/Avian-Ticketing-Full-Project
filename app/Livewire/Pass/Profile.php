<?php

namespace App\Livewire\Pass;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;


class Profile extends Component
{
    public $bio;
    public $name;
    public $email;
    public $phone;
    public $location;
    #[Layout('layouts.main')]

    /**
     * Mount existing user + details data
     */
    public function mount()
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;

        $this->bio = optional($user->details)->bio;
        $this->location = optional($user->details)->location;
    }

    /**
     * Validation rules
     */
    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore(Auth::id())
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Save profile
     */
    public function save()
    {
        $this->validate();

        $user = Auth::user();

        /**
         * Update users table
         */
        $user->update([
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        /**
         * Create details record if missing
         */
        if (!$user->details) {
            $user->details()->create([
                'bio' => $this->bio,
                'location' => $this->location,
            ]);
        } else {
            $user->details->update([
                'bio' => $this->bio,
                'location' => $this->location,
            ]);
        }

        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.pass.profile');
    }
}