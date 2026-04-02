<?php

namespace App\Livewire\Admin\Script;

use Livewire\Component;
use App\Models\Script;
use App\Models\Page;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $page_id;
    public $title;
    public $position;
    public $code;
    public $script;
    public $pages;
    public $slug;

    protected $rules = [
        'page_id' => 'required',
        'title' => 'required',
        'position' => 'required',
        'code' => 'required',
    ];

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->script = Script::where('slug', $this->slug)->firstOrFail();
        $this->page_id = $this->script->page_id;
        $this->title = $this->script->title;
        $this->position = $this->script->position;
        $this->code = $this->script->code;
        $this->pages = Page::select('id', 'name')->whereNotIn('id', [$this->page_id])->get();
    }

    public function save()
    {
        $this->validate();
        $script = Script::where('slug', $this->slug)->firstOrFail();
        $script->update([
            'page_id' => $this->page_id,
            'title' => $this->title,
            'position' => $this->position,
            'code' => $this->code,
        ]);

        session()->flash('message', 'Script updated successfully.');

        return redirect()->route('script.index');
    }
    public function render()
    {

        return view('livewire.admin.script.edit');
    }
}
