<?php

namespace App\Livewire\Admin\Script;

use Livewire\Component;
use App\Models\Script;
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
        $script = Script::findOrFail($id);
        $script->delete();

        session()->flash('message', 'Script deleted successfully.');
    }

    public function render()
    {
        $scripts = Script::query()
            ->when($this->search, function ($query) {

                $query->where(function ($q) {
                    $q->where('page_id', 'like', '%' . $this->search . '%')
                    ->orWhere('position', 'like', '%' . $this->search . '%')
                    ->orWhereHas('page', function ($pageQuery) {
                        $pageQuery->where('name', 'like', '%' . $this->search . '%');
                    });
                });

            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.script.index', compact('scripts'));
    }
}
