<?php

namespace App\Livewire\Admin\OpenGraph;

use Livewire\Component;
use App\Models\OpenGraph;
use App\Models\Page;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
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
        $openGraph = OpenGraph::findOrFail($id);
        // Delete the associated image if it exists
       if ($openGraph->image) {
          // Storage::disk('public') matches how you stored it
          if (Storage::disk('public')->exists($openGraph->image)) {
              Storage::disk('public')->delete($openGraph->image);
          }
      }
        $openGraph->delete();

        session()->flash('message', 'Open Graph deleted successfully.');
    }

    public function render()
    {
        $graphs = OpenGraph::query()
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
        return view('livewire.admin.open-graph.index', compact('graphs'));
    }
}
