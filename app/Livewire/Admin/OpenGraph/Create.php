<?php

namespace App\Livewire\Admin\OpenGraph;

use Livewire\Component;
use App\Models\OpenGraph;
use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $page_id;
    public $tag_name;
    public $title;
    public $description;
    public $image;
    public $url;
    public $type;
    public $site_name;

    protected $rules = [
        'page_id' => 'required',
        'tag_name' => 'required|unique:open_graphs,tag_name',
        'title' => 'required',
        'description' => 'required',
        'image' => 'required',
        'url' => 'required|url',
        'type' => 'required',
        'site_name' => 'required',
    ];

    public function save()
    {
        $this->validate();
        $slug = Str::slug($this->title);
        $imagePath = null;
         if ($this->image) {
            $imagePath = $this->image->store('open_graphs', 'public');
        }

        OpenGraph::create([
            'page_id' => $this->page_id,
            'tag_name' => $this->tag_name,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imagePath,
            'url' => $this->url,
            'type' => $this->type,
            'site_name' => $this->site_name,
            'slug' => $slug,
        ]);

        session()->flash('message', 'Open Graph created successfully.');

        return redirect()->route('graph.index');
    }
    
    public function render()
    {
        $pages = Page::select('id','name')->get();
        return view('livewire.admin.open-graph.create',compact('pages'));
    }
}
