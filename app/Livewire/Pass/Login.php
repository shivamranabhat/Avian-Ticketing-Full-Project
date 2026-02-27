<?php

namespace App\Livewire\Pass;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required|min:6')]
    public string $password = '';

    public bool $remember = false;

    public string $message = '';

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            return redirect()->intended('/pass/dashboard'); 
        }

        $this->addError('email', 'These credentials do not match our records.');
    }

    #[Layout('layouts.main')] 
    public function render()
    {
        return view('livewire.pass.login');
    }
}
