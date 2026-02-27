<?php

namespace App\Livewire\Pass;

use Livewire\Component;
use Livewire\Attributes\On;

class Navbar extends Component
{
    #[On('profile-picture-updated')]
    public function onProfilePictureUpdated($userId = null)
    {
        // Optional: only refresh if it's the current user
        if ($userId === null || $userId === auth()->id()) {
            $this->dispatch('$refresh');   // ← forces re-render
        }
    }
    
    public function render()
    {
        return view('livewire.pass.navbar');
    }
}
