<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Event;

class Details extends Component
{
    public $slug;
    public $event;
    public $quantities = [];

    public function mount()
    {
        $this->event = Event::where('slug', $this->slug)->firstOrFail();

        foreach ($this->event->tickets as $ticket) {
            $this->quantities[$ticket->id] = 0;
        }
    }

    public function increment($ticketId)
    {
        $ticket = $this->getTicket($ticketId);
        if (!$ticket) return;

        $available = $ticket->total_seat - $ticket->sold_seats;

        if (($this->quantities[$ticketId] ?? 0) < $available) {
            $this->quantities[$ticketId]++;
        }
    }

    public function decrement($ticketId)
    {
        if (($this->quantities[$ticketId] ?? 0) > 0) {
            $this->quantities[$ticketId]--;
        }
    }

    private function getTicket($ticketId)
    {
        return $this->event?->tickets->firstWhere('id', $ticketId);
    }

    // ==================== Computed Properties ====================

    public function getSelectedTicketsProperty()
    {
        $selected = [];

        foreach ($this->quantities as $id => $qty) {
            if ($qty > 0) {
                $ticket = $this->event->tickets->firstWhere('id', $id);

                if ($ticket) {
                    $selected[] = [
                        'id'       => $ticket->id,
                        'name'     => $ticket->name,
                        'price'    => $ticket->price,
                        'qty'      => $qty,
                        'subtotal' => $ticket->price * $qty,
                    ];
                }
            }
        }

        return $selected;
    }

    public function getGrandTotalProperty()
    {
        return collect($this->selectedTickets)->sum('subtotal');
    }

    public function getTotalTicketsProperty()
    {
        return collect($this->quantities)->sum();
    }

    // ==================== Checkout ====================

    public function proceedToCheckout()
    {
        $totalSelected = collect($this->quantities)->sum();

        if ($totalSelected === 0) {
            $this->addError('tickets', 'Please select at least one ticket.');
            return;
        }

        // Store in session
        session(['selected_tickets' => $this->quantities]);
        $this->redirect(route('ticket.confirmation', $this->slug));
    }

    public function render()
    {
        return view('livewire.pages.details', [
            'event' => $this->event
        ]);
    }
}