<?php

namespace App\Livewire\Event\Slider;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Slider;
use App\Models\SliderList;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
   use WithFileUploads;

    public $slider;
    public $title, $image, $oldImage, $img_alt;
    public $left_btn_txt, $left_btn_link, $right_btn_txt, $right_btn_link, $starting_price;

    public $listCount = 0;
    public $lists = [];

    public function mount($slug)
    {
        $this->slider = Slider::where('slug', $slug)->firstOrFail();

        $this->title = $this->slider->title;
        $this->left_btn_txt = $this->slider->left_btn_txt;
        $this->left_btn_link = $this->slider->left_btn_link;
        $this->right_btn_txt = $this->slider->right_btn_txt;
        $this->right_btn_link = $this->slider->right_btn_link;
        $this->starting_price = $this->slider->starting_price;

        $this->oldImage = $this->slider->image;
        $this->img_alt = $this->slider->img_alt;

        // Load lists properly
        $this->lists = $this->slider->sliderLists->map(function ($item) {
            return [
                'title' => $item->title,
                'icon'  => $item->icon,
            ];
        })->toArray();

        $this->listCount = count($this->lists);
    }

    public function save()
    {
        $this->validate([
            'title'           => 'required|string|max:255',
            'left_btn_txt'    => 'required|string|max:100',
            'left_btn_link'   => 'required|url|max:255',
            'right_btn_txt'   => 'nullable|string|max:100',
            'right_btn_link'  => 'nullable|url|max:255',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',

            // list validation
            'lists.*.title'   => 'nullable|string|max:255',
        ]);

        // Manual validation (same as create)
        if ($this->listCount > 0) {
            foreach ($this->lists as $index => $item) {
                if (empty($item['title'])) {
                    $this->addError("lists.$index.title", 'Title is required.');
                    return;
                }
            }
        }

        $path = $this->oldImage;

        // Update main image
        if ($this->image) {
            if ($this->oldImage) {
                Storage::disk('public')->delete($this->oldImage);
            }
            $path = $this->image->store('sliders', 'public');
        }

        // Update slider
        $this->slider->update([
            'title'          => $this->title,
            'left_btn_txt'   => $this->left_btn_txt,
            'left_btn_link'  => $this->left_btn_link,
            'right_btn_txt'  => $this->right_btn_txt,
            'right_btn_link' => $this->right_btn_link,
            'starting_price' => $this->starting_price,
            'image'          => $path,
            'img_alt'        => $this->img_alt,
        ]);

        // Delete old list images BEFORE deleting DB
        $oldLists = SliderList::where('slider_id', $this->slider->id)->get();

        foreach ($oldLists as $old) {
            if ($old->icon) {
                Storage::disk('public')->delete($old->icon);
            }
        }

        // Delete old records
        SliderList::where('slider_id', $this->slider->id)->delete();

        // Save new lists
        foreach ($this->lists as $list) {

            if (!empty($list['title'])) {

                $iconPath = null;

                // If new file uploaded
                if (isset($list['icon']) && is_object($list['icon'])) {
                    $iconPath = $list['icon']->store('sliders/features', 'public');
                }
                // If old image path (string)
                elseif (is_string($list['icon'])) {
                    $iconPath = $list['icon'];
                }

                SliderList::create([
                    'slider_id' => $this->slider->id,
                    'title'     => $list['title'],
                    'icon'      => $iconPath,
                ]);
            }
        }

        session()->flash('message', 'Slider updated successfully.');
        return redirect()->route('slider.index');
    }


    public function render()
    {
        return view('livewire.event.slider.edit');
    }
}
