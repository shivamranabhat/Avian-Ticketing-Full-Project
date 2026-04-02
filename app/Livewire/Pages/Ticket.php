<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Booking;
use App\Models\EventTicket;

class Ticket extends Component
{
    public $reference;
    public $booking;
    public $event;

    public function mount($reference)
    {
        $this->booking = Booking::where('booking_reference', $reference)
            ->firstOrFail();

        // Resolve event from first ticket
        $firstTicket = $this->booking->tickets[0] ?? null;

        if ($firstTicket) {
            $eventTicket = EventTicket::with('event')
                ->find($firstTicket['ticket_id']);

            $this->event = $eventTicket?->event;
        }
    }

 

    public function render()
    {
        return view('livewire.pages.ticket');
    }
}