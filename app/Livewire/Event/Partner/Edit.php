<?php

namespace App\Livewire\Event\Partner;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Partner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;
    public $slug;
    public $img_alt;
    public $image;
    public $partner;

   public function mount($slug)
    {
        $this->partner = Partner::where('slug', $slug)->firstOrFail();

        $this->fill([
            'img_alt'        => $this->partner->img_alt,
            'slug'        => $this->partner->slug,
        ]);
    }

    protected function rules(): array
    {
        return [
            'img_alt' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        $data = [
            'img_alt'        => $validated['img_alt'],
        ];

        // Handle image replacement + delete old one
        if ($this->image) {
            // Delete old image if it exists
            if ($this->partner->image && Storage::disk('public')->exists($this->partner->image)) {
                Storage::disk('public')->delete($this->partner->image);
            }

            // Store new image
            $imageName = Str::slug($validated['img_alt']) . '-' . time()
                         . '.' . $this->image->getClientOriginalExtension();

            $path = $this->image->storeAs('partners', $imageName, 'public');

            $data['image'] = $path;  // 'partners/filename.jpg'
        }

        $this->partner->update($data);

        session()->flash('message', 'Partner updated successfully.');
        return redirect()->route('partner.index');
    }
    
    public function render()
    {
        return view('livewire.event.partner.edit');
    }
}
