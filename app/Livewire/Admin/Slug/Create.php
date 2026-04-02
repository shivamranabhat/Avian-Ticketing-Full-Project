<?php

namespace App\Livewire\Admin\Slug;

use Livewire\Component;
use App\Models\Slug;
use App\Models\Page;
use Illuminate\Support\Str;

class Create extends Component
{
    public $slug;
    public $page_id;
    public $page_slug;
    protected $rules = [
        'page_id' => 'required|unique:slugs,page_id',
        'page_slug' => 'required|unique:slugs,page_slug',
    ];

    public function save()
    {
        $this->validate();
        $page_slug = Str::slug($this->page_slug);
        Slug::create([
            'page_id' => $this->page_id,
            'page_slug' => $page_slug,
            'slug' => $page_slug,
        ]);

        session()->flash('message', 'Slug created successfully.');

        return redirect()->route('slug.index');
    }
    public function render()
    {
        $pages = Page::select('id', 'name')->get();
        return view('livewire.admin.slug.create', compact('pages'));
    }
}
