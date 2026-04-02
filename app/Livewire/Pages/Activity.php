<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\BodyContent;
use App\Models\Activity as ActivityModel;

class Activity extends Component
{
    public $slug;
    public $activity;
    public $quantities = [];   // e.g. [ticket_id => quantity]
    public $rsvp;
    public $showFullAbout = false;
    public $aboutHasMore = false;

    public function mount()
    {
        $this->activity = ActivityModel::where('slug', $this->slug)
            ->with('tickets')           // eager load tickets
            ->firstOrFail();

        $this->rsvp = BodyContent::where('slug', 'rsvp')->first();

        // Initialize quantities array with 0 for each ticket
        $this->quantities = $this->activity->tickets
            ->pluck('id')
            ->mapWithKeys(fn($id) => [$id => 0])
            ->toArray();
        $this->aboutHasMore = str_word_count($this->activity->about) > 50;
    }

    // Increase quantity
    public function increment($ticketId)
    {
        $this->quantities[$ticketId] = ($this->quantities[$ticketId] ?? 0) + 1;
    }

    public function toggleAbout()
    {
        $this->showFullAbout = !$this->showFullAbout;
    }

    // Decrease quantity (prevent negative)
    public function decrement($ticketId)
    {
        if (isset($this->quantities[$ticketId]) && $this->quantities[$ticketId] > 0) {
            $this->quantities[$ticketId]--;
        }
    }

    public function proceedToCheckout()
    {
        $totalSelected = collect($this->quantities)->sum();

        if ($totalSelected === 0) {
            $this->addError('tickets', 'Please select at least one ticket.');
            return;
        }

        // Store selected quantities in session (ticket_id => quantity)
        session(['selected_tickets' => $this->quantities]);

        $this->redirect(route('activity.confirmation', $this->slug));
    }

    public function getTotalTicketsProperty()
    {
        return collect($this->quantities)->sum();
    }

    public function getGrandTotalProperty()
    {
        $total = 0;

        foreach ($this->activity->tickets as $ticket) {
            $qty = $this->quantities[$ticket->id] ?? 0;
            $total += $qty * $ticket->price;
        }

        return $total;
    }
    
    public function render()
    {
        return view('livewire.pages.activity', [
            'activity' => $this->activity,
        ]);
    }
}