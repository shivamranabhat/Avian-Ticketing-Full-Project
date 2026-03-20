<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Booking;
use TCPDF;

class Ticket extends Component
{
    public $reference;
    public $booking;

    public function mount($reference)
    {
        $this->booking = Booking::where('booking_reference', $reference)
            ->firstOrFail();
    }

    public function downloadPdf()
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator('Jack Danie’s');
        $pdf->SetAuthor('Jack Danie’s Event');
        $pdf->SetTitle('Ticket - ' . $this->booking->booking_reference);
        $pdf->SetSubject('Event Ticket');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        $html = view('livewire.pages.ticket-pdf', ['booking' => $this->booking])->render();

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('ticket-' . $this->booking->booking_reference . '.pdf', 'D');
    }

    public function render()
    {
        return view('livewire.pages.ticket');
    }
}