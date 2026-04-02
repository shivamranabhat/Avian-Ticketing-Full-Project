<?php

namespace App\Livewire\Admin\Slug;

use Livewire\Component;
use App\Models\Slug;
use Livewire\WithPagination;

class Index extends Component
{
    use withPagination;
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
        $slug = Slug::findOrFail($id);
        $slug->delete();

        session()->flash('message', 'Slug deleted successfully.');
    }

    public function render()
    {
        $slugs = Slug::query()
            ->when($this->search, function ($query) {

                $query->where(function ($q) {
                    $q->where('page_id', 'like', '%' . $this->search . '%')
                    ->orWhere('page_slug', 'like', '%' . $this->search . '%')
                    ->orWhere('slug', 'like', '%' . $this->search . '%')
                    ->orWhereHas('page', function ($pageQuery) {
                        $pageQuery->where('name', 'like', '%' . $this->search . '%');
                    });
                });

            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.slug.index', compact('slugs'));
    }
}
