<?php

namespace App\Livewire\Admin\Faq;

use Livewire\Component;
use App\Models\Faq;
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
        $faq = Faq::find($id)->firstOrFail();
        $faq->delete();
        session()->flash('success', 'FAQ deleted successfully.');
    }
    public function render()
    {
        $faqs = Faq::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->where('platform', 'Vip')
            ->latest()
            ->paginate($this->perPage);
        return view('livewire.admin.faq.index', compact('faqs'));
    }
}
