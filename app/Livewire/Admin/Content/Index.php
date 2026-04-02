<?php

namespace App\Livewire\Admin\Content;

use Livewire\Component;
use App\Models\BodyContent;
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
        $content = BodyContent::findOrFail($id);
        $content->delete();

        session()->flash('message', 'Content deleted successfully!');
    }



    public function render()
    {
        $contents = BodyContent::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('position', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate($this->perPage);
        return view('livewire.admin.content.index', compact('contents'));
    }
}
