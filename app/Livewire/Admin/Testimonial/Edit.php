<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;
    public $slug;
    public $name;
    public $role;
    public $description;
    public $image;
    public $testimonial;

   public function mount($slug)
    {
        $this->testimonial = Testimonial::where('slug', $slug)->firstOrFail();

        $this->fill([
            'name'        => $this->testimonial->name,
            'role'        => $this->testimonial->role,
            'description' => $this->testimonial->description,
            'slug'        => $this->testimonial->slug,
        ]);
    }

    protected function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'role'        => 'required|string|max:100',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
        ];
    }

    public function update()
    {
        $validated = $this->validate();

        $data = [
            'name'        => $validated['name'],
            'role'        => $validated['role'],
            'description' => $validated['description'],
        ];

        // Handle image replacement + delete old one
        if ($this->image) {
            // Delete old image if it exists
            if ($this->testimonial->image && Storage::disk('public')->exists($this->testimonial->image)) {
                Storage::disk('public')->delete($this->testimonial->image);
            }

            // Store new image
            $imageName = Str::slug($validated['name']) . '-' . time()
                         . '.' . $this->image->getClientOriginalExtension();

            $path = $this->image->storeAs('testimonials', $imageName, 'public');

            $data['image'] = $path;  // 'testimonials/filename.jpg'
        }

        $this->testimonial->update($data);

        session()->flash('message', 'Testimonial updated successfully.');
        return redirect()->route('testimonial.index');
    }
    
    public function render()
    {

        return view('livewire.admin.testimonial.edit');
    }
}
