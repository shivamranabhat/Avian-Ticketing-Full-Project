<?php

namespace App\Livewire\Admin\Tag;

use Livewire\Component;
use App\Models\Tag;
use App\Models\Page;
use Illuminate\Support\Str;

class Create extends Component
{
    public $tag_name;
    public $title;
    public $meta_description;
    public $meta_keywords;
    public $canonical_tag;
    public $page_id;

    protected $rules = [
        'tag_name' => 'required|unique:tags,tag_name',
        'title' => 'required',
        'meta_description' => 'required',
        'meta_keywords' => 'required',
        'canonical_tag' => 'required',
        'page_id' => 'required|exists:pages,id',
    ];

    public function save()
    {
        $this->validate();

        Tag::create([
            'tag_name' => $this->tag_name,
            'title' => $this->title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'canonical_tag' => $this->canonical_tag,
            'page_id' => $this->page_id,
            'slug' => Str::slug($this->tag_name),
        ]);

       session()->flash('message', 'Tag created successfully.');

       return redirect()->route('tag.index');
    }

    public function render()
    {
        $pages = Page::select('id', 'name')->get();
        return view('livewire.admin.tag.create', compact('pages'));
    }
}
