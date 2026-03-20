<style>
    body { font-family: Arial, sans-serif; }
    .ticket { border: 2px solid #333; padding: 25px; margin: 15px auto; }
    .barcode { text-align: center; margin: 25px 0; }
</style>

@foreach($booking->tickets as $index => $ticket)
<div class="ticket">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div></div>
        <img src="{{ public_path('main/images/logo.png') }}" style="height:60px;" alt="logo">
        <div style="font-size:22px; color:#C22C9F; font-weight:bold;">#{{ $index + 1 }}</div>
    </div>

    <h1 style="text-align:center; font-size:28px; margin:20px 0;">JACK DANIE’S TICKET</h1>

    <div style="text-align:center; line-height:1.8;">
        <p><strong>Event Date:</strong> 25th Dec, 2025</p>
        <p><strong>Event Time:</strong> 5PM Onwards</p>
        <p><strong>Event Name:</strong> John and The Locals</p>
        <p style="margin-top:15px; font-size:18px;"><strong>{{ $booking->name }}</strong>, {{ $booking->phone }}</p>
    </div>

    <div style="border-top:1px solid #999; border-bottom:1px solid #999; padding:15px 0; margin:20px 0; display:flex; justify-content:space-between;">
        <span style="font-size:18px;">Ticket Type:</span>
        <span style="font-size:18px; font-weight:bold;">{{ $ticket['name'] }}</span>
    </div>

    <div style="text-align:center; font-size:32px; color:#C22C9F; font-weight:bold;">
        Rs {{ number_format($ticket['subtotal'], 0) }}
    </div>

    <div class="barcode">
        <?php
            $barcode = new \TCPDFBarcode($booking->barcode ?? $booking->booking_reference, 'C128');
            echo $barcode->getBarcodeHTML(2, 60, 'black');
        ?>
    </div>

    <p style="text-align:center; font-size:14px; color:#6402A1;">
        {{ $booking->barcode ?? $booking->booking_reference }}
    </p>

    <p style="text-align:center; font-size:13px; color:#6402A1; margin-top:20px;">
        Keep your ticket private. Sharing it may prevent entry.
    </p>
</div>
@endforeach