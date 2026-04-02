<?php

namespace App\Livewire\Admin\Script;

use Livewire\Component;
use App\Models\Script;
use App\Models\Page;
use Illuminate\Support\Str;

class Create extends Component
{
    public $page_id;
    public $title;
    public $position;
    public $code;

    protected $rules = [
        'page_id' => 'required',
        'title' => 'required|unique:scripts,title',
        'position' => 'required',
        'code' => 'required',
    ];

    public function save()
    {
        $this->validate();
        $slug = Str::slug($this->title);
        Script::create([
            'page_id' => $this->page_id,
            'title' => $this->title,
            'position' => $this->position,
            'code' => $this->code,
            'slug' => $slug,
        ]);

        session()->flash('message', 'Script created successfully.');

        return redirect()->route('script.index');
    }

    public function render()
    {
        $pages = Page::select('id', 'name')->get();
        return view('livewire.admin.script.create', compact('pages'));
    }
}
