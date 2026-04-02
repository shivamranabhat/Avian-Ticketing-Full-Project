<?php

namespace App\Livewire\Admin\Tag;

use Livewire\Component;
use App\Models\Tag;
use App\Models\Page;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        session()->flash('message', 'Tag deleted successfully.');
    }

    public function render()
    {
        $tags = Tag::query()
            ->when($this->search, function ($query) {

                $query->where(function ($q) {
                    $q->where('page_id', 'like', '%' . $this->search . '%')
                    ->orWhere('tag_name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('page', function ($pageQuery) {
                        $pageQuery->where('name', 'like', '%' . $this->search . '%');
                    });
                });

            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.tag.index', compact('tags'));
    }
}
