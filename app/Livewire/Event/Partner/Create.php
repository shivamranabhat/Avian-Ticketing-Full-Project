<?php

namespace App\Livewire\Event\Partner;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Partner;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;
    public $img_alt;
    public $image;

    public function save()
    {
        $validated = $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('partners', 'public');
        }

        Partner::create([
            'img_alt'        => $validated['img_alt'],
            'slug'        => Str::slug($validated['img_alt']) . '-' . time(),
            'image'       => $imagePath,
        ]);

        session()->flash('success', 'Partner created successfully.');

        return redirect()->route('partner.index');
    }

    protected function rules(): array
    {
        return [
            'img_alt'     => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
        ];
    }
    public function render()
    {
        return view('livewire.event.partner.create');
    }
}
