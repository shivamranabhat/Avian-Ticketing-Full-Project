<?php

namespace App\Livewire\Admin\Twitter;

use Livewire\Component;
use App\Models\TwitterCard;
use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Edit extends Component
{
    use WithFileUploads;

    public $card;
    public $slug;

    public $page_id;
    public $tag_name;
    public $site;
    public $title;
    public $description;
    public $image; // only for new upload
    public $summary;

    public $pages;

    public function mount($slug)
    {
        $this->card = TwitterCard::where('slug', $slug)->firstOrFail();

        $this->page_id = $this->card->page_id;
        $this->tag_name = $this->card->tag_name;
        $this->site = $this->card->site;
        $this->title = $this->card->title;
        $this->description = $this->card->description;
        $this->summary = $this->card->summary;

        // IMPORTANT: don't assign existing image
        $this->image = null;

        $this->pages = Page::select('id', 'name')
            ->whereNotIn('id', [$this->page_id])
            ->get();
    }

    protected function rules()
    {
        return [
            'page_id' => 'required|exists:pages,id',

            // ignore current record for unique
            'tag_name' => 'required|unique:twitter_cards,tag_name,' . $this->card->id,

            'site' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',

            // validate only if new image uploaded
            'image' => $this->image instanceof TemporaryUploadedFile
                ? 'image|max:2048'
                : 'nullable',

            'summary' => 'required|string|max:255',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        $data = [
            'page_id' => $validated['page_id'],
            'tag_name' => $validated['tag_name'],
            'site' => $validated['site'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'summary' => $validated['summary'],
            'slug' => Str::slug($validated['title']),
        ];

        // handle image update
        if ($this->image instanceof TemporaryUploadedFile) {

            // delete old image
            if ($this->card->image && Storage::disk('public')->exists($this->card->image)) {
                Storage::disk('public')->delete($this->card->image);
            }

            $imageName = Str::slug($validated['title']) . '-' . time()
                . '.' . $this->image->getClientOriginalExtension();

            $path = $this->image->storeAs('twitter_cards', $imageName, 'public');

            $data['image'] = $path;
        }

        $this->card->update($data);

        session()->flash('message', 'Twitter Card updated successfully.');

        return redirect()->route('card.index');
    }

    public function render()
    {
        return view('livewire.admin.twitter.edit');
    }
}