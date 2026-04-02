<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Support\Str;

class Confirmation extends Component
{
    public $slug;
    public $event;

    // Form Fields
    public $name = '';
    public $phone = '';
    public $email = '';
    public $pay_method = 'esewa';

    // Ticket Data
    public $selectedTickets = [];
    public $grandTotal = 0;
    public $totalTickets = 0;

    public function mount()
    {
        $this->event = Event::where('slug', $this->slug)
            ->with('tickets')           // Important: eager load tickets
            ->firstOrFail();

        $quantities = session('selected_tickets', []);

        if (empty($quantities)) {
            session()->flash('error', 'No tickets were selected. Please go back and select tickets.');
            $this->redirect(route('ticket.details', $this->slug));
            return;
        }

        $this->processSelectedTickets($quantities);
    }

    private function processSelectedTickets(array $quantities)
    {
        $selected = [];
        $total = 0;
        $count = 0;

        foreach ($quantities as $ticketId => $qty) {
            if ($qty > 0) {
                $ticket = $this->event->tickets->firstWhere('id', $ticketId);

                if ($ticket) {
                    $subtotal = $ticket->price * $qty;

                    $selected[] = [
                        'ticket_id' => $ticket->id,
                        'name'      => $ticket->name,
                        'price'     => $ticket->price,
                        'qty'       => $qty,
                        'subtotal'  => $subtotal,
                    ];

                    $total += $subtotal;
                    $count += $qty;
                }
            }
        }

        $this->selectedTickets = $selected;
        $this->grandTotal = $total;
        $this->totalTickets = $count;
    }

    public function confirmBooking()
    {
        $this->validate([
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            'email'      => 'required|email|max:255',
            'pay_method' => 'required|in:esewa,khalti',
        ]);

        $quantities = session('selected_tickets', []);

        if (empty($quantities)) {
            $this->addError('tickets', 'No tickets selected.');
            return;
        }

        $booking = Booking::create([
            'name'           => $this->name,
            'phone'          => $this->phone,
            'email'          => $this->email,
            'pay_method'     => $this->pay_method,
            'slug'           => $this->slug,
            'tickets'        => $this->selectedTickets,
            'total_tickets'  => $this->totalTickets,
            'total_amount'   => $this->grandTotal,
            'status'         => 'confirmed',
            'payment_status' => 'paid',
        ]);

        // Reduce available seats
        foreach ($quantities as $ticketId => $qty) {
            if ($qty > 0) {
                $ticket = $this->event->tickets()->find($ticketId);
                if ($ticket && $ticket->sold_seats + $qty <= $ticket->total_seat) {
                    $ticket->increment('sold_seats', $qty);
                }
            }
        }

        session()->forget('selected_tickets');

        session()->flash('success', 'Confirmed! Your Booking Reference: ' . $booking->booking_reference);

        return $this->redirect(route('event.ticket', $booking->booking_reference));
    }

    public function render()
    {
        return view('livewire.pages.confirmation', [
            'event' => $this->event
        ]);
    }
}