<?php

namespace App\Livewire\Admin\Content;

use Livewire\Component;
use App\Models\BodyContent;
use Illuminate\Support\Str;


class Edit extends Component
{
    public $slug;

    public $title;
    public $subtitle;
    public $content;
    public $btn_txt;
    public $btn_link;
    public $whatsapp_number;
    public $position;

    public function mount($slug)
    {
        $content = BodyContent::where('slug', $slug)->firstOrFail();
        $this->slug = $content->slug;
        $this->title = $content->title;
        $this->subtitle = $content->subtitle;
        $this->content = $content->content;
        $this->btn_txt = $content->btn_txt;
        $this->btn_link = $content->btn_link;
        $this->whatsapp_number = $content->whatsapp_number;
        $this->position = $content->position;
    }

    public function save()
    {
        if($this->position == 'Header')
        {
            $this->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'btn_txt' => 'required|string|max:255',
                'btn_link' => 'required|string|max:255',
            ]);
        }
        elseif($this->position == 'Footer')
        {
            $this->validate([
                'content' => 'required|string',
            ]);
        }
        elseif($this->position == 'Rsvp')
        {
            $this->validate([
                'title' => 'required|string|max:255',
                'btn_link' => 'required|string|max:255',
                'whatsapp_number' => 'required|string|max:20',
            ]);
        }

        $content = BodyContent::where('slug', $this->slug)->firstOrFail();
        $content->update([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'content' => $this->content,
            'btn_txt' => $this->btn_txt,
            'btn_link' => $this->btn_link,
            'whatsapp_number' => $this->whatsapp_number,
            'position' => $this->position,
            'slug' => Str::slug($this->position), 
        ]);
        session()->flash('message', 'Content updated successfully!');
        return redirect()->route('content.index');
    }

    public function render()
    {
        return view('livewire.admin.content.edit');
    }
}
