<?php

namespace App\Livewire\Admin\OpenGraph;

use Livewire\Component;
use App\Models\OpenGraph;
use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Edit extends Component
{
    use WithFileUploads;

    public $slug;
    public $page_id;
    public $tag_name;
    public $title;
    public $description;
    public $image; 
    public $url;
    public $type;
    public $site_name;
    public $graph;
    public $pages;

    public function mount($slug)
    {
        $this->graph = OpenGraph::where('slug', $slug)->firstOrFail();

        $this->page_id = $this->graph->page_id;
        $this->tag_name = $this->graph->tag_name;
        $this->title = $this->graph->title;
        $this->description = $this->graph->description;
        $this->url = $this->graph->url;
        $this->type = $this->graph->type;
        $this->site_name = $this->graph->site_name;
        $this->image = null;

        $this->pages = Page::select('id', 'name')
            ->whereNotIn('id', [$this->page_id])
            ->get();
    }

    protected function rules(): array
    {
        return [
            'tag_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',

            // ✅ validate ONLY if new file uploaded
            'image' => $this->image instanceof TemporaryUploadedFile
                ? 'image|max:2048'
                : 'nullable',

            'url' => 'required|url',
            'type' => 'required|string|max:100',
            'site_name' => 'required|string|max:255',
            'page_id' => 'required|exists:pages,id',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        $data = [
            'tag_name' => $validated['tag_name'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'url' => $validated['url'],
            'type' => $validated['type'],
            'site_name' => $validated['site_name'],
            'page_id' => $validated['page_id'],
        ];

        // ✅ Handle image upload only if new file selected
        if ($this->image instanceof TemporaryUploadedFile) {

            // delete old image
            if ($this->graph->image && Storage::disk('public')->exists($this->graph->image)) {
                Storage::disk('public')->delete($this->graph->image);
            }

            $imageName = Str::slug($validated['tag_name']) . '-' . time()
                . '.' . $this->image->getClientOriginalExtension();

            $path = $this->image->storeAs('open_graphs', $imageName, 'public');

            $data['image'] = $path;
        }

        $this->graph->update($data);

        session()->flash('message', 'Open Graph updated successfully.');

        return redirect()->route('graph.index');
    }

    public function render()
    {
        return view('livewire.admin.open-graph.edit');
    }
}