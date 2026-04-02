<?php

namespace App\Livewire\Admin\Twitter;

use Livewire\Component;
use App\Models\TwitterCard;
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
        $twitter = TwitterCard::findOrFail($id);
        // Delete the associated image if it exists
       if ($twitter->image) {
          // Storage::disk('public') matches how you stored it
          if (Storage::disk('public')->exists($twitter->image)) {
              Storage::disk('public')->delete($twitter->image);
          }
      }
        $twitter->delete();
        session()->flash('message', 'Open Graph deleted successfully.');
    }

    public function render()
    {
        $cards = TwitterCard::query()
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
        return view('livewire.admin.twitter.index',compact('cards'));
    }
}
