<?php

namespace App\Livewire\Pass;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Reset extends Component
{
    #[Layout('layouts.main')]

    public string $current_password = '';
    public string $password = '';           // new password
    public string $password_confirmation = '';

    public function updatePassword()
    {
        $this->validate([
            'current_password' => ['required', 'current_password'], // checks against logged-in user's password
            'password'         => ['required', 'confirmed', Password::defaults()], // min:8 + common rules
        ]);

        // Update password
        Auth::user()->update([
            'password' => Hash::make($this->password),
        ]);

        // Clear fields + success message
        $this->reset(['current_password', 'password', 'password_confirmation']);

        session()->flash('status', 'Password updated successfully!');
    }

    
    public function render()
    {
        return view('livewire.pass.reset');
    }
}
