<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket - {{ $booking->booking_reference }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f9f9f9;
        }
        .ticket {
            background: white;
            border: 2px solid #333;
            border-radius: 12px;
            padding: 25px;
            margin: 15px auto;
            max-width: 650px;
        }
        .top-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h1 {
            text-align: center;
            font-size: 28px;
            font-weight: 900;
            color: #111;
            margin: 15px 0 25px 0;
        }
        .mid-row {
            text-align: center;
            line-height: 1.8;
            margin-bottom: 25px;
        }
        .type {
            border-top: 1px solid #999;
            border-bottom: 1px solid #999;
            padding: 15px 0;
            margin: 20px 0;
            display: flex;
            justify-content: space-between;
            font-size: 18px;
        }
        .barcode-container {
            text-align: center;
            margin: 30px 0;
        }
        .warning {
            text-align: center;
            color: #6402A1;
            font-size: 13px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

@foreach($booking->tickets as $index => $ticket)
    <div class="ticket">

        <!-- Top Row -->
        <div class="top-row">
            <div></div>
            <img src="{{ public_path('main/images/logo.png') }}" style="height: 65px;" alt="logo">
            <p style="font-size: 22px; color: #C22C9F; font-weight: bold;">#{{ $index + 1 }}</p>
        </div>

        <!-- Title -->
        <h1>JACK DANIE’S TICKET</h1>

        <!-- Event Details -->
        <div class="mid-row">
            @if(isset($event) && $event)
                <p><strong>Event Date:</strong> 
                    {{ \Carbon\Carbon::parse($event->date)->format('jS M, Y') }}
                </p>
                <p><strong>Event Time:</strong> 
                    {{ \Carbon\Carbon::parse($event->date)->format('g:i A') }}
                </p>
                <p><strong>Event Name:</strong> {{ $event->name }}</p>
            @else
                <p><strong>Event Date:</strong> 25th Dec, 2025</p>
                <p><strong>Event Time:</strong> 5PM Onwards</p>
                <p><strong>Event Name:</strong> John and The Locals</p>
            @endif

            <p style="margin-top: 18px; font-size: 18px; font-weight: 600;">
                {{ $booking->name }}, {{ $booking->phone }}
            </p>
        </div>

        <!-- Ticket Type -->
        <div class="type">
            <span>Ticket Type:</span>
            <span style="font-weight: bold;">{{ $ticket['name'] }}</span>
        </div>

        <!-- Price -->
        <div style="text-align: center; font-size: 34px; font-weight: 900; color: #C22C9F; margin: 20px 0;">
            Rs {{ number_format($ticket['subtotal'], 0) }}
        </div>

        <!-- Barcode -->
        <div class="barcode-container">
            <p style="font-size: 12px; color: #555; margin-bottom: 8px;">SCAN AT ENTRY</p>
            <?php
                $barcode = new \TCPDFBarcode($booking->barcode ?? $booking->booking_reference, 'C128');
                echo $barcode->getBarcodeHTML(2.2, 70, 'black');
            ?>
            <p style="margin-top: 12px; font-family: monospace; font-size: 15px; font-weight: bold;">
                {{ $booking->barcode ?? $booking->booking_reference }}
            </p>
        </div>

        <!-- Warning -->
        <p class="warning">
            Keep your ticket private. Sharing it with others can prevent you from entering the event.
        </p>

    </div>
@endforeach

</body>
</html>