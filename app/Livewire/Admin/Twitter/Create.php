<?php

namespace App\Livewire\Admin\Twitter;

use Livewire\Component;
use App\Models\TwitterCard;
use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $page_id;
    public $tag_name;
    public $site;
    public $title;
    public $description;
    public $image;
    public $summary;

    protected $rules = [
        'page_id' => 'required',
        'tag_name' => 'required|unique:twitter_cards,tag_name',
        'site' => 'required',
        'title' => 'required',
        'description' => 'required',
        'image' => 'required',
        'summary' => 'required',
    ];

    public function save()
    {
        $this->validate();
        $slug = Str::slug($this->title);
        $imagePath = null;
         if ($this->image) {
            $imagePath = $this->image->store('twitter_cards', 'public');
        }

        TwitterCard::create([
            'page_id' => $this->page_id,
            'tag_name' => $this->tag_name,
            'site' => $this->site,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imagePath,
            'summary' => $this->summary,
            'slug' => $slug,
        ]);

        session()->flash('message', 'Twitter Card created successfully.');

        return redirect()->route('card.index');
    }
    

    public function render()
    {
        $pages = Page::select('id','name')->get();
        return view('livewire.admin.twitter.create',compact('pages'));
    }
}
