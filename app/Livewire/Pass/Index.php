<?php

namespace App\Livewire\Pass;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Index extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.pass.index');
    }
}
