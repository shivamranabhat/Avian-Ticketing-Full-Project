<?php

namespace App\Livewire\Pass;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    #[Layout('layouts.main')]

    /**
     * Log the user out and redirect to login page
     */
    public function logout()
    {
        Auth::logout();

        // Invalidate the session and regenerate the token (security best practice)
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        // Redirect to login route (adjust name if your login route has different name)
        return redirect()->route('pass.login');
    }

    public function render()
    {
        return view('livewire.pass.dashboard');
    }
}
