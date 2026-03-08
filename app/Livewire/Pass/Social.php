<?php

namespace App\Livewire\Pass;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\SocialLink;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Social extends Component
{
    #[Layout('layouts.main')]
    public $links = []; // array of ['name' => '', 'url' => '']

    public function mount()
    {
        // Load existing links for the current user
        $existing = SocialLink::where('user_id', Auth::id())
            ->select('name', 'url')
            ->get()
            ->map(fn($item) => ['name' => $item->name, 'url' => $item->url])
            ->toArray();

        $this->links = $existing ?: [['name' => '', 'url' => '']]; // at least one empty row
    }

    public function addLink()
    {
        $this->links[] = ['name' => '', 'url' => ''];
    }

    public function removeLink($index)
    {
        if (count($this->links) > 1) {
            unset($this->links[$index]);
            $this->links = array_values($this->links); // re-index
        }
    }

    public function saveLinks()
    {
        $this->validate([
            'links.*.name' => 'required|string',
            'links.*.url'  => 'required|url',
        ], [
            'links.*.name.required' => 'Platform name is required.',
            'links.*.url.required'  => 'URL is required.',
            'links.*.url.url'       => 'Please enter a valid URL.',
        ]);

        $userId = Auth::id();

        // Optional: delete old links first (if you want to replace all)
        SocialLink::where('user_id', $userId)->delete();

        foreach ($this->links as $link) {
            if (!empty($link['name']) && !empty($link['url'])) {
                SocialLink::create([
                    'user_id' => $userId,
                    'name'    => $link['name'],
                    'url'     => $link['url'],
                    'slug'    => Str::slug($link['name'] . '-' . Str::random(6)), // or your own logic
                ]);
            }
        }

        session()->flash('status', 'Social links saved successfully!');

        // Refresh from DB to show latest
        $this->mount();
    }
    public function render()
    {
        return view('livewire.pass.social');
    }
}

