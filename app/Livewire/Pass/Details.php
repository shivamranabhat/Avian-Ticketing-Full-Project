<?php

namespace App\Livewire\Pass;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;

class Details extends Component
{
    public $slug;
    public $details;
    #[Layout('layouts.main')]
    public function mount()
    {
        $this->details = User::whereSlug($this->slug)->firstOrFail();
        
    }
    public function render()
    {
        return view('livewire.pass.details');
    }
}
