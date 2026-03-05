<?php

namespace App\Livewire\Pass;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    /**
     * Log the user out and redirect to login page
     */
    public function logout()
{
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    // Use Livewire redirect helper
    return $this->redirectRoute('pass.login', navigate: true);
}

    public function render()
    {
        return view('livewire.pass.dashboard')->layout('layouts.main');
    }
}
