<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Testimonial;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;
    public $name;
    public $role;
    public $description;
    public $image;

    public function save()
    {
        $validated = $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('testimonials', 'public');
        }

        Testimonial::create([
            'name'        => $validated['name'],
            'role'        => $validated['role'],
            'description' => $validated['description'],
            'slug'        => Str::slug($validated['name']) . '-' . time(),
            'image'       => $imagePath,
        ]);

        session()->flash('success', 'Testimonial created successfully.');

        return redirect()->route('testimonial.index');
    }

    protected function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'role'        => 'required|string|max:100',
            'description' => 'required|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
        ];
    }

    public function render()
    {
        return view('livewire.admin.testimonial.create');
    }
}
