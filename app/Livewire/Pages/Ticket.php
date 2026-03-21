<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Booking;
use App\Models\EventTicket;
use TCPDF;

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

    public function downloadPdf()
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator('Jack Danie’s');
        $pdf->SetAuthor('Jack Danie’s Event');
        $pdf->SetTitle('Ticket - ' . $this->booking->booking_reference);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        // HTML content
        $html = view('livewire.pages.ticket-pdf', [
            'booking' => $this->booking,
            'event' => $this->event
        ])->render();

        $pdf->writeHTML($html, true, false, true, false, '');

        // ✅ ADD BARCODE HERE (not in blade)
        $pdf->Ln(10);

        $style = [
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 0,
            'vpadding' => 0,
            'fgcolor' => [0,0,0],
            'bgcolor' => false,
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 10,
        ];

        $code = $this->booking->barcode ?? $this->booking->booking_reference;

        $pdf->write1DBarcode($code, 'C128', '', '', '', 40, 0.4, $style, 'N');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->Output('', 'S');
        }, 'ticket-' . $this->booking->booking_reference . '.pdf');
    }

    public function render()
    {
        return view('livewire.pages.ticket', [
            'booking' => $this->booking,
            'event' => $this->event
        ]);
    }
}