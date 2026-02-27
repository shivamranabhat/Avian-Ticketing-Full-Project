<?php

namespace App\Livewire\Pass;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Cv extends Component
{
    use WithFileUploads;

    public $cv;
    public $uploadStatus = '';
    public $currentCvPath;

    #[Layout('layouts.main')]
    public function mount()
    {
        $details = Auth::user()->details;
        $this->currentCvPath = $details?->cv;
    }

    public function render()
    {
        return view('livewire.pass.cv');
    }

    public function save()
    {
        $this->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $user = Auth::user();
        $details = $user->details ?? $user->details()->create([]);

        if ($details->cv) {
            Storage::disk('public')->delete($details->cv);
        }

        $path = $this->cv->store('cvs', 'public');

        $details->update([
            'cv' => $path,
        ]);

        $this->currentCvPath = $path;
        $this->uploadStatus = 'CV uploaded successfully!';
        $this->reset('cv');
    }

    public function removeCv()
    {
        $user = Auth::user();
        $details = $user->details;

        if ($details && $details->cv) {
            Storage::disk('public')->delete($details->cv);
            $details->update(['cv' => null]);

            $this->currentCvPath = null;
            $this->uploadStatus = 'CV removed successfully.';
        }
    }
}