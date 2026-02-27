<?php

namespace App\Livewire\Event\Category;

use Livewire\Component;
use App\Models\EventCategory;
use Illuminate\Support\Str;

class Create extends Component
{
     public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        EventCategory::create([
            'name' => $this->name,
            'slug' => Str::slug('cat'.'-'.$this->name.'-'.now()),
        ]);

        session()->flash('success', 'Category created successfully!');
        return redirect()->route('event.category.index');
    }

    public function render()
    {
        return view('livewire.event.category.create');
    }
}
