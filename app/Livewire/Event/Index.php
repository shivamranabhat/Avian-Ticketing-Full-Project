<?php

namespace App\Livewire\Event;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function delete($id)
    {
        $event = Event::findOrFail($id);

        foreach ($event->images ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }

        foreach ($event->artists as $artist) {
            if ($artist->image) {
                Storage::disk('public')->delete($artist->image);
            }
        }

        $event->delete();

        session()->flash('success', 'Event deleted successfully.');
    }

    public function render()
    {
        $events = Event::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.event.index',compact('events'));
    }
}
