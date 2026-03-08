<?php

namespace App\Livewire\Admin\Faq;

use Livewire\Component;
use App\Models\Faq;
use Illuminate\Support\Str;

class Create extends Component
{
    public $title;
    public $description;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        Faq::create([
            'title' => $this->title,
            'description' => $this->description,
            'platform' => 'Vip',
            'slug' => Str::slug($this->title, '-') . '-' . Str::random(6),
        ]);

        session()->flash('success', 'FAQ created successfully.');

        return redirect()->route('faq.index');
    }
    public function render()
    {
        return view('livewire.admin.faq.create');
    }
}
