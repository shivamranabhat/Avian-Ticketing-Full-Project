<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin.signin');
    }
    public function render()
    {
        return view('livewire.admin.logout');
    }
}
