<?php

namespace App\Livewire\Admin\Tag;

use Livewire\Component;
use App\Models\Tag;
use App\Models\Page;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $tag;
    public $tag_name;
    public $title;
    public $meta_description;
    public $meta_keywords;
    public $canonical_tag;
    public $page_id;
    public $pages;

    protected $rules = [
        'tag_name' => 'required',
        'title' => 'required',
        'meta_description' => 'required',
        'meta_keywords' => 'required',
        'canonical_tag' => 'required',
        'page_id' => 'required|exists:pages,id',
    ];

    public function mount($slug)
    {
        $this->tag = Tag::where('slug', $slug)->firstOrFail();
        $this->tag_name = $this->tag->tag_name;
        $this->title = $this->tag->title;
        $this->meta_description = $this->tag->meta_description;
        $this->meta_keywords = $this->tag->meta_keywords;
        $this->canonical_tag = $this->tag->canonical_tag;
        $this->page_id = $this->tag->page_id;
        $this->pages = Page::all();
    }

    public function save()
    {
        $this->validate();

        $this->tag->update([
            'tag_name' => $this->tag_name,
            'title' => $this->title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'canonical_tag' => $this->canonical_tag,
            'page_id' => $this->page_id,
            'slug' => Str::slug($this->tag_name),
        ]);

       session()->flash('message', 'Tag updated successfully.');

       return redirect()->route('tag.index');
    }
    public function render()
    {
        return view('livewire.admin.tag.edit');
    }
}
