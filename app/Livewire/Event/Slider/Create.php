<?php

namespace App\Livewire\Event\Slider;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Slider;
use App\Models\SliderList;
use Illuminate\Support\Str;

class Create extends Component
{
   use WithFileUploads;

    public $title;
    public $subtitle;
    public $image;
    public $img_alt;
    public $left_btn_txt;
    public $left_btn_link;
    public $right_btn_txt;
    public $right_btn_link;
    public $starting_price;

    public $listCount = 0;
    public $lists = [];          // This will hold all dynamic items

    protected $rules = [
        'title'          => 'required|string|max:255',
        'subtitle'       => 'nullable|string|max:255',
        'image'          => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        'img_alt'        => 'nullable|string|max:255',

        'left_btn_txt'   => 'nullable|string|max:100',
        'left_btn_link'  => 'nullable|string|max:255',
        'right_btn_txt'  => 'nullable|string|max:100',
        'right_btn_link' => 'nullable|string|max:255',
        'starting_price' => 'nullable|string|max:50',

        'listCount'      => 'integer|min:0',
        'lists.*.title'  => 'required_if:listCount,>,0|string|max:255',
        'lists.*.icon'   => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5048',
    ];

    public function updatedListCount($value)
    {
        $value = max(0, (int) $value);
        $current = count($this->lists);

        if ($value > $current) {
            for ($i = $current; $i < $value; $i++) {
                $this->lists[] = ['title' => '', 'icon' => null];
            }
        } elseif ($value < $current) {
            $this->lists = array_slice($this->lists, 0, $value);
        }
    }

    public function save()
    {
        $this->validate();

        // ✅ Manual validation for titles if listCount > 0
        if ($this->listCount > 0) {
            foreach ($this->lists as $index => $item) {
                if (empty($item['title'])) {
                    $this->addError("lists.$index.title", 'Title is required.');
                    return;
                }
            }
        }

        $mainImagePath = $this->image?->store('sliders', 'public');

        $slider = Slider::create([
            'title'          => $this->title,
            'subtitle'       => $this->subtitle,
            'image'          => $mainImagePath,
            'img_alt'        => $this->img_alt,
            'left_btn_txt'   => $this->left_btn_txt,
            'left_btn_link'  => $this->left_btn_link,
            'right_btn_txt'  => $this->right_btn_txt,
            'right_btn_link' => $this->right_btn_link,
            'starting_price' => $this->starting_price,
            'slug'           => Str::slug($this->title),
        ]);

        foreach ($this->lists as $list) {
            if (!empty($list['title'])) {

                $iconPath = null;

                if (!empty($list['icon']) && is_object($list['icon'])) {
                    $iconPath = $list['icon']->store('sliders/features', 'public');
                }

                SliderList::create([
                    'slider_id' => $slider->id,
                    'title'     => $list['title'],
                    'icon'      => $iconPath,
                ]);
            }
        }

        session()->flash('success', 'Slider created successfully.');
        return redirect()->route('slider.index');
    }

    public function render()
    {
        return view('livewire.event.slider.create');
    }
}

