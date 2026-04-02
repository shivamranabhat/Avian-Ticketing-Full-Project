<?php

namespace App\Livewire\Event\Activity\List;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Activity;
use App\Models\Page;
use App\Models\ActivityCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $activity_category_id;
    public $location;
    public $organizer;
    public $spnsor;
    public $about;
    public $venue;

    // New fields
    public $main_image;      // Single main/featured image
    public $img_alt;       // Alt text for main image

    public $images = [];     // Additional gallery images


    public $ticketCount = 0;
    public $tickets = [];

    public $faqCount = 0;
    public $faqs = [];

    public $tocCount = 0;
    public $tocs = [];

    public function mount()
    {
        $this->tickets = [];
        $this->faqs    = [];
        $this->tocs    = [];
    }

    protected $rules = [
        'name'              => 'required|string|max:255',
        'activity_category_id' => 'required|exists:activity_categories,id',
        'location'          => 'required|string|max:255',
        'organizer'         => 'nullable|string|max:255',
        'sponsor'           => 'nullable|string|max:255',
        'about'             => 'nullable|string',

        'main_image'        => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        'img_alt'         => 'nullable|string|max:255',

        'images.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',


        'ticketCount'       => 'integer|min:0',
        'tickets.*.name'    => 'required_if:ticketCount,>,0|string|max:100',
        'tickets.*.price'   => 'required_if:ticketCount,>,0|numeric|min:0',

        'faqCount'          => 'integer|min:0',
        'faqs.*.title'      => 'required_if:faqCount,>,0|string|max:255',
        'faqs.*.description'=> 'required_if:faqCount,>,0|string',

        'tocCount'          => 'integer|min:0',
        'tocs.*.title'      => 'required_if:tocCount,>,0|string|max:255',
        'tocs.*.description'=> 'required_if:tocCount,>,0|string',
    ];

    // Dynamic count handlers
    public function updatedTicketCount($value) { $this->syncDynamicItems('tickets', $value, ['name' => '', 'price' => '']); }
    public function updatedFaqCount($value)    { $this->syncDynamicItems('faqs', $value, ['title' => '', 'description' => '']); }
    public function updatedTocCount($value)    { $this->syncDynamicItems('tocs', $value, ['title' => '', 'description' => '']); }

    private function syncDynamicItems($property, $newCount, $defaultItem)
    {
        $value  = max(0, (int) $newCount);
        $current = count($this->$property);

        if ($value > $current) {
            for ($i = $current; $i < $value; $i++) {
                $this->$property[] = $defaultItem;
            }
        } elseif ($value < $current) {
            $this->$property = array_slice($this->$property, 0, $value);
        }
    }

    public function removeImage($key)
    {
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
            $this->images = array_values($this->images);
        }
    }

    public function save()
    {
        $this->validate();

        // Store main image
        $mainImagePath = $this->main_image->store('activities/main', 'public');

        // Store additional gallery images
        $imagePaths = [];
        foreach ($this->images as $image) {
            $imagePaths[] = $image->store('activities/images', 'public');
        }

        // Create Activity
        $activity = Activity::create([
            'name'              => $this->name,
            'slug'              => Str::slug($this->name . '-' . now()->format('YmdHis')),
            'activity_category_id' => $this->activity_category_id,
            'location'          => $this->location,
            'organizer'         => $this->organizer,
            'sponsor'           => $this->sponsor,
            'about'             => $this->about,
            'main_image'        => $mainImagePath,
            'img_alt'         => $this->img_alt ?? $this->name,
            'images'            => $imagePaths ?: null,
        ]);

       

        // Tickets
        foreach ($this->tickets as $ticket) {
            if (empty($ticket['name'])) continue;
            $activity->tickets()->create([
                'name'  => $ticket['name'],
                'price' => $ticket['price'],
            ]);
        }

        // FAQs
        foreach ($this->faqs as $faq) {
            if (empty($faq['title'])) continue;
            $activity->faqs()->create([
                'title'       => $faq['title'],
                'description' => $faq['description'],
                'slug'        => Str::slug($faq['title'] . '-' . time()),
            ]);
        }

        // TOCs
        foreach ($this->tocs as $toc) {
            if (empty($toc['title'])) continue;
            $activity->tocs()->create([
                'title'       => $toc['title'],
                'description' => $toc['description'],
                'slug'        => Str::slug($toc['title'] . '-' . time()),
            ]);
        }

        Page::create([
            'name'    => $activity->name,
            'slug'     => $activity->slug,
        ]);
        
        session()->flash('success', 'Activity created successfully.');
        return redirect()->route('activity.list.index');
    }

    public function render()
    {
        $categories = ActivityCategory::select('id', 'name')->latest()->get();
        return view('livewire.event.activity.list.create',compact('categories'));
    }
}
