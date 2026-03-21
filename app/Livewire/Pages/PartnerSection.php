<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Partner;

class PartnerSection extends Component
{
    public function render()
    {
        $partners = Partner::select('image','img_alt')->latest()->get();
        return view('livewire.pages.partner-section',compact('partners'));
    }
}
