<?php

namespace App\Livewire\Admin\Faq;

use Livewire\Component;
use App\Models\Faq;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $slug;
    public $title;
    public $description;
    public $faq;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    public function mount($slug)
    {
        $this->faq = Faq::where('slug', $slug)->firstOrFail();
        $this->slug = $this->faq->slug;
        $this->title = $this->faq->title;
        $this->description = $this->faq->description;
    }

    public function update()
    {
        $this->validate();

        $this->faq->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('success', 'FAQ updated successfully.');

        return redirect()->route('faq.index');
    }

    public function render()
    {
        return view('livewire.admin.faq.edit');
    }
}
