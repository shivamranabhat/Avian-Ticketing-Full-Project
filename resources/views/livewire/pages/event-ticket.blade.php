<section class="bg-gray-50">
    <div class="px-6 py-2 sm:px-8 md:px-14 xl:px-24">
        <livewire:pages.navbar />
    </div>

    <div id="ticket-area"
        class="ticket flex flex-col gap-y-6 items-center w-full md:w-[70%] lg:w-1/2 mx-auto px-4 mb-10">

        <!-- Download Button -->
        <button id="download"
            class="text-white rounded-lg text-center p-3 font-semibold uppercase cursor-pointer transition-all hover:brightness-110 bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] w-full">
            Download PDF
        </button>

        @foreach($booking->tickets as $index => $ticket)
        <div
            class="ticket-details border border-gray-300 rounded-lg p-4 sm:p-6 w-full flex flex-col items-center gap-y-4">

            <div class="top-row flex justify-between items-center w-full">
                <div></div>
                <img src="{{ asset('main/images/logo.png') }}" class="w-34 object-contain">
                <p class="text-md sm:text-lg text-[#C22C9F] font-bold italic">#{{ $index + 1 }}</p>
            </div>

            @if($event)
            <h1 class="font-extrabold text-xl sm:text-2xl md:text-3xl">{{ $event->sponsor }}</h1>
            @endif

            <div class="mid-row flex flex-col gap-y-2 items-center">

                @if($event)
                <h5 class="text-md sm:text-lg font-semibold">
                    Event Date:
                    <span class="font-normal">
                        {{ \Carbon\Carbon::parse($event->date)->format('jS M, Y') }}
                    </span>
                </h5>

                <h5 class="text-md sm:text-lg font-semibold">
                    Event Time:
                    <span class="font-normal">
                        {{ \Carbon\Carbon::parse($event->date)->format('g:i A') }}
                    </span>
                </h5>

                <h5 class="text-md sm:text-lg font-semibold">
                    Event Name:
                    <span class="font-normal">
                        {{ $event->name }}
                    </span>
                </h5>
                @endif

                <h6 class="font-semibold my-4">
                    {{ $booking->name }}, {{ $booking->phone }}
                </h6>
            </div>

            <div class="type border-t border-b w-[90%] sm:w-[80%] md:w-[70%] p-4 flex justify-between items-center">
                <p class="text-md sm:text-lg font-semibold">Ticket Type:</p>
                <p class="text-md sm:text-lg font-semibold">{{ $ticket['name'] }}</p>
            </div>

            <h5 class="font-extrabold text-xl sm:text-2xl md:text-3xl text-[#C22C9F]">
                Rs {{ number_format($ticket['subtotal'], 0) }}
            </h5>

            <!-- Barcode -->
            <div class="w-full flex flex-col items-center mt-4">
                <p class="text-xs text-gray-500 mb-2 tracking-widest">SCAN AT ENTRY</p>

                {!! QrCode::size(120)->generate($booking->booking_reference) !!}

            </div>

            <p class="text-[#6402A1] w-[90%] sm:w-[80%] md:w-[70%] text-center opacity-60 mt-4">
                Keep your ticket private. Sharing it with others can prevent you from entering the event.
            </p>
        </div>
        @endforeach

    </div>
    <div class="no-print">
        <livewire:pages.featured-section />
        <livewire:pages.partner-section />
        <livewire:pages.footer />
    </div>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 12mm;
            }

            html,
            body {
                background: #ffffff !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            body * {
                visibility: hidden;
            }

            #ticket-area,
            #ticket-area * {
                visibility: visible;
            }

            #ticket-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 10px !important;
            }

            .ticket-details {
                page-break-inside: avoid;
                break-inside: avoid;
                margin-bottom: 20px !important;
                border: 1px solid #d1d5db !important;
                background: #ffffff !important;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>

    <script>
        const download = document.getElementById("download");

        download.addEventListener("click", function () {
            window.print();
        });
    </script>
</section>