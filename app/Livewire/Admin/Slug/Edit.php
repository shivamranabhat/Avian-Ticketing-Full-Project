<?php

namespace App\Livewire\Admin\Slug;

use Livewire\Component;
use App\Models\Slug;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    public $slug;
    public $page_id;
    public $page_slug;
    public $slug_id;
    public $pages;


    public function mount()
    {
        $this->slug = Slug::whereSlug($this->slug)->first();
        $this->slug_id = $this->slug->id;
        $this->page_id = $this->slug->page_id;
        $this->page_slug = $this->slug->page_slug;
        $this->pages = Page::select('id', 'name')->whereNotIn('id', [$this->page_id])->get();
    }

    public function save()
    {
       $this->validate([
            'page_id' => [
                'required',
                Rule::unique('slugs', 'page_id')->ignore($this->slug_id),
            ],
            'page_slug' => [
                'required',
                Rule::unique('slugs', 'page_slug')->ignore($this->slug_id),
            ],
        ]);

        $slug = Slug::findOrFail($this->slug_id);
        $page_slug = Str::slug($this->page_slug);
        $slug->update([
            'page_id' => $this->page_id,
            'page_slug' => $page_slug,
            'slug' => $page_slug,
        ]);

        session()->flash('message', 'Slug updated successfully.');

        return redirect()->route('slug.index');
    }
    public function render()
    {
        return view('livewire.admin.slug.edit');
    }
}
