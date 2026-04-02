<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Activity;
use App\Models\ActivityBooking;

class ActivityConfirmation extends Component
{
    public $slug;

    // Form Fields
    public $name = '';
    public $phone = '';
    public $email = '';
    public $pay_method = 'esewa';

    // Ticket Data
    public $selectedTickets = [];
    public $grandTotal = 0;
    public $totalTickets = 0;
    public $activity;

    public function mount()
    {
        $this->activity = Activity::where('slug', $this->slug)
            ->with('tickets')
            ->firstOrFail();

        $quantities = session('selected_tickets', []);

        if (empty($quantities)) {
            session()->flash('error', 'No tickets were selected. Please go back and select tickets.');
            $this->redirect(route('activity.show', $this->slug));
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
                $ticket = $this->activity->tickets->firstWhere('id', $ticketId);

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

        // Generate booking reference
        $bookingReference = 'ACT-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

        $booking = ActivityBooking::create([
            'activity_id'       => $this->activity->id,
            'name'              => $this->name,
            'phone'             => $this->phone,
            'email'             => $this->email,
            'pay_method'        => $this->pay_method,
            'slug'              => $this->slug,
            'booking_reference' => $bookingReference,
            'tickets'           => $this->selectedTickets,
            'total_tickets'     => $this->totalTickets,
            'total_amount'      => $this->grandTotal,
            'status'            => 'confirmed',
            'payment_status'    => 'paid',
        ]);

        // Clear session
        session()->forget('selected_tickets');

        session()->flash('success', 'Booking Confirmed! Your Booking Reference: ' . $bookingReference);

        return $this->redirect(route('activity.ticket', $bookingReference));
    }

    public function render()
    {
        return view('livewire.pages.activity-confirmation', [
            'activity' => $this->activity
        ]);
    }
}