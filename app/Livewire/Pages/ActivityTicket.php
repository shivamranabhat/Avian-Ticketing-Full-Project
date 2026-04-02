<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\ActivityBooking;
use App\Models\ActivityTicket as Ticket;

class ActivityTicket extends Component
{
    public $reference;
    public $booking;
    public $activity;

    public function mount($reference)
    {
      
        $this->booking = ActivityBooking::where('booking_reference', $reference)
            ->firstOrFail();
        // Resolve activity from first ticket
        $firstTicket = $this->booking->tickets[0] ?? null;

        if ($firstTicket) {
            $activityTicket = Ticket::with('activity')
                ->find($firstTicket['ticket_id']);

            $this->activity = $activityTicket?->activity;
        }
    }


    public function render()
    {
        return view('livewire.pages.activity-ticket');
    }
}
