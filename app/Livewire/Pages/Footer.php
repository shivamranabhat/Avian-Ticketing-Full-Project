<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\BodyContent;

class Footer extends Component
{
    public $footer;

    public function mount()
    {
        $this->footer = BodyContent::where('position', 'Footer')->first();
    }
    
    public function render()
    {
        return view('livewire.pages.footer');
    }
}
