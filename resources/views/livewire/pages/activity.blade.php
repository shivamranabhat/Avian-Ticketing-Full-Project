<section>
    <div class="flex flex-col gap-y-8 px-6 py-2 sm:px-8 md:px-14 xl:px-24">
        <livewire:pages.navbar />
        <!-- details container -->

        <div class="details grid grid-cols-2 xl:grid-cols-9 gap-x-10">
            <div class="left-col col-span-2 xl:col-span-6 flex flex-col gap-y-8">
                <div class="gallery w-full">
                    <div class="grid grid-cols-8 grid-rows-2 gap-2 md:gap-4">
                        @foreach($activity->images as $index => $img)
                        @php
                        $classes = match($index) {
                        0 => 'col-span-4 md:col-span-2 row-start-1 h-full',
                        1 => 'col-span-4 md:col-span-2 row-start-2 h-full',
                        2 => 'col-span-4 md:col-span-2 row-span-2 h-full',
                        3 => 'col-span-8 md:col-span-4 row-span-2 h-[30vh] md:h-full',
                        default => 'hidden'
                        };
                        @endphp
                        <img src="{{ Storage::url($img) }}" class="{{ $classes }} w-full object-cover rounded-xl"
                            alt="Activity Image {{ $index + 1 }}">
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-col gap-y-4">
                    <h1 class="text-2xl font-bold">{{$activity->title}}</h1>
                    <div class="flex flex-col md:flex-row gap-y-4 md:gap-y-0 gap-x-0 md:gap-x-8 ">
                        <div class="organizer flex items-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="#545459" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <p class="text-primary text-sm">
                                {{$activity->organizer}}
                            </p>
                        </div>
                        <div class="location flex items-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="#545459" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>


                            <p class="text-primary text-sm">
                                {{$activity->location}}
                            </p>

                        </div>
                    </div>
                </div>
                @if($rsvp)
                <div class="rspv bg-black text-white rounded-lg p-4">
                    <p class="text-sm italic">{{$rsvp->title}}: <a href="{{$rsvp->btn_link}}" target="_blank"
                            class="underline">{{$rsvp->whatsapp_number}}</a></p>
                </div>
                @endif
                <div class="flex flex-col gap-y-3 items-start">
                    <h5 class="font-bold text-xl text-secondary">About the Event</h5>

                    <div class="text-sm text-primary leading-relaxed">
                        @if(!$showFullAbout)
                        {{ \Illuminate\Support\Str::words($activity->about, 30, '...') }}
                        @else
                        {{ $activity->about }}
                        @endif
                    </div>

                    @if($aboutHasMore)
                    <button wire:click="toggleAbout"
                        class="text-sm text-secondary hover:underline cursor-pointer flex items-center gap-x-1 transition-all duration-200">

                        <span>{{ $showFullAbout ? 'Show Less' : 'Show More' }}</span>

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 transition-transform duration-300 {{ $showFullAbout ? 'rotate-180' : '' }}"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    @endif
                </div>
                <!-- Mobile Ticket Section -->
                <div class="flex xl:hidden flex-col gap-y-6">

                    <!-- Select Ticket Type -->
                    <div class="border border-gray-300 rounded-lg p-4 flex flex-col gap-y-4 md:gap-y-6">
                        <h5 class="font-bold text-xl text-secondary">Select Ticket Type</h5>

                        @foreach($activity->tickets as $ticket)
                        <div class="flex justify-between items-center">
                            <div class="flex flex-col">
                                <p class="text-xs text-primary italic">{{ $ticket->name }}</p>
                                <h5 class="font-bold text-xl text-secondary">Rs {{ number_format($ticket->price)
                                    }}/person</h5>
                                <p class="text-xs text-primary italic">View Details</p>
                            </div>

                        </div>
                        <div class="flex justify-end">
                            <div class="flex items-center gap-x-3">
                                @if(false) {{-- Change to real sold out logic later if needed --}}
                                <button
                                    class="text-white rounded text-center px-4 py-2 text-xs font-semibold uppercase cursor-not-allowed bg-gray-400"
                                    disabled>
                                    Sold Out
                                </button>
                                @else
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                    <button wire:click="decrement({{ $ticket->id }})"
                                        class="w-9 h-9 flex items-center justify-center cursor-pointer text-lg font-medium hover:bg-gray-100 active:bg-gray-200 transition-colors">
                                        −
                                    </button>

                                    <span class="w-12 text-center font-semibold text-lg">{{ $quantities[$ticket->id] ??
                                        0 }}</span>

                                    <button wire:click="increment({{ $ticket->id }})"
                                        class="w-9 h-9 flex items-center justify-center cursor-pointer text-lg font-medium hover:bg-gray-100 active:bg-gray-200 transition-colors">
                                        +
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                        @if(!$loop->last)
                        <div class="bg-[#9EA2AC] w-full h-[0.05rem]"></div>
                        @endif
                        @endforeach
                    </div>

                    <!-- Total Summary -->
                    <div class="border border-gray-300 rounded-lg p-4 flex flex-col gap-y-4 md:gap-y-6">
                        <div class="flex gap-x-4 items-center">
                            <h5 class="font-bold text-xl text-secondary">Total Tickets</h5>
                            <span
                                class="bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] rounded px-4 py-2 text-xs text-white">
                                {{ $this->totalTickets }}X
                            </span>
                        </div>

                        <div class="flex flex-col gap-y-2">
                            @php $totalAmount = 0; @endphp

                            @foreach($activity->tickets as $ticket)
                            @php
                            $qty = $quantities[$ticket->id] ?? 0;
                            $subtotal = $qty * $ticket->price;
                            $totalAmount += $subtotal;
                            @endphp

                            @if($qty > 0)
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-primary italic">
                                    {{ $qty }} × {{ $ticket->name }}
                                </p>
                                <p class="text-sm font-semibold">
                                    Rs {{ number_format($subtotal) }}
                                </p>
                            </div>
                            @endif
                            @endforeach

                            @if($this->totalTickets === 0)
                            <p class="text-sm text-gray-500 italic py-2">No tickets selected yet</p>
                            @endif
                        </div>

                        <div class="bg-[#9EA2AC] w-full h-[0.05rem]"></div>

                        <div class="flex justify-end">
                            <h5 class="italic font-semibold text-lg">
                                Total: Rs {{ number_format($this->grandTotal) }}
                            </h5>
                        </div>
                    </div>

                    @error('tickets')
                    <p class="text-red-500 text-sm text-center">{{ $message }}</p>
                    @enderror

                    <!-- Buy Ticket Button with Loading Effect -->
                    <button wire:click="proceedToCheckout" wire:loading.attr="disabled" wire:target="proceedToCheckout"
                        @if($this->grandTotal == 0)
                        disabled
                        @endif
                        class="text-white rounded-lg text-center p-4 font-semibold uppercase transition-all flex
                        items-center justify-center gap-2 w-full
                        {{ $this->grandTotal == 0
                        ? 'bg-gray-400 cursor-not-allowed'
                        : 'bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] hover:brightness-110' }}">

                        <!-- Spinner -->
                        <svg wire:loading wire:target="proceedToCheckout" class="animate-spin h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>

                        <!-- Button Text -->
                        <span wire:loading.remove wire:target="proceedToCheckout">
                            Buy Ticket{{ $this->totalTickets !== 1 ? 's' : '' }}
                        </span>

                        <span wire:loading wire:target="proceedToCheckout">
                            Processing...
                        </span>
                    </button>



                </div>

                <div class="flex flex-col gap-y-8" id="venue">

                    <div class="accordions flex flex-col gap-y-8">
                        <div class="accordion-item rounded-lg border border-gray-200 bg-white overflow-hidden">
                            <button
                                class="accordion-trigger cursor-pointer flex w-full items-center justify-between px-6 py-5 text-left font-medium "
                                aria-expanded="false">
                                <span class="text-lg">Frequently Asked Questions</span>
                                <svg class="h-5 w-5 transform transition-transform duration-300" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div class="accordion-content max-h-0 overflow-hidden px-6">
                                @forelse($activity->faqs as $faq)
                                <div class="flex flex-col border-t py-3 border-gray-300">
                                    <h6 class="text-sm font-semibold">{{ $faq->title }}</h6>
                                    <p class="text-xs">{{ $faq->description }}</p>
                                </div>
                                @empty
                                <div class="flex flex-col border-t py-3 border-gray-300">
                                    <p class="text-xs">No frequently asked questions available.</p>
                                </div>
                                @endforelse

                            </div>
                        </div>
                        <div class="accordion-item rounded-lg border border-gray-200 bg-white overflow-hidden">
                            <button
                                class="accordion-trigger cursor-pointer flex w-full items-center justify-between px-6 py-5 text-left font-medium "
                                aria-expanded="false">
                                <span class="text-lg">Terms & Conditions</span>
                                <svg class="h-5 w-5 transform transition-transform duration-300" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div class="accordion-content max-h-0 overflow-hidden px-6">
                                @forelse($activity->tocs as $term)
                                <div class="flex flex-col border-t py-3 border-gray-300">
                                    <h6 class="text-sm font-semibold">{{ $term->title }}</h6>
                                    <p class="text-xs">{{ $term->description }}</p>
                                </div>
                                @empty
                                <div class="flex flex-col border-t py-3 border-gray-300">
                                    <p class="text-xs">No terms and conditions available.</p>
                                </div>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-col col-span-2 xl:col-span-3 hidden xl:block">
                <div class="flex flex-col gap-y-6 bg-white rounded" id="right-sticky-col">

                    <!-- Select Ticket Type -->
                    <div class="border border-gray-300 rounded-lg p-4 flex flex-col gap-y-6">
                        <h5 class="font-bold text-xl text-secondary">Select Ticket Type</h5>

                        @foreach($activity->tickets as $ticket)
                        <div class="flex justify-between items-center">
                            <div class="flex flex-col">
                                <p class="text-xs text-primary italic">{{ $ticket->name }}</p>
                                <h5 class="font-bold text-lg md:text-xl text-secondary">
                                    Rs {{ number_format($ticket->price) }}/person
                                </h5>
                                <p class="text-xs text-primary italic">View Details</p>
                            </div>

                            <div class="flex items-center gap-x-3">
                                @if($ticket->is_sold_out) {{-- You can add a sold_out column or logic later --}}
                                <button
                                    class="text-white rounded text-center px-4 py-2 text-xs font-semibold uppercase bg-gray-400 cursor-not-allowed"
                                    disabled>
                                    Sold Out
                                </button>
                                @else
                                <div class="flex items-center border border-gray-300 rounded-lg">
                                    <button wire:click="decrement({{ $ticket->id }})"
                                        class="w-8 h-8 flex items-center justify-center cursor-pointer text-lg font-medium hover:bg-gray-100 transition-colors">-</button>

                                    <span class="w-10 text-center font-semibold">{{ $quantities[$ticket->id] ?? 0
                                        }}</span>

                                    <button wire:click="increment({{ $ticket->id }})"
                                        class="w-8 h-8 flex items-center justify-center cursor-pointer text-lg font-medium hover:bg-gray-100 transition-colors">+</button>
                                </div>
                                @endif
                            </div>
                        </div>

                        @if(!$loop->last)
                        <div class="bg-[#9EA2AC] w-full h-[0.05rem]"></div>
                        @endif
                        @endforeach
                    </div>

                    <!-- Total Tickets Summary -->
                    <div class="border border-gray-300 rounded-lg p-4 flex flex-col gap-y-6">
                        <div class="flex gap-x-4 items-center">
                            <h5 class="font-bold text-xl text-secondary">Total Tickets</h5>
                            <span
                                class="bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] rounded px-4 py-2 text-xs text-white">
                                {{ collect($quantities)->sum() }}X
                            </span>
                        </div>

                        <div class="flex flex-col gap-y-2">
                            @php
                            $totalAmount = 0;
                            @endphp

                            @foreach($activity->tickets as $ticket)
                            @php
                            $qty = $quantities[$ticket->id] ?? 0;
                            $subtotal = $qty * $ticket->price;
                            $totalAmount += $subtotal;
                            @endphp

                            @if($qty > 0)
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-primary italic">
                                    {{ $qty }} × {{ $ticket->name }}
                                </p>
                                <p class="text-sm font-semibold">
                                    Rs {{ number_format($subtotal) }}
                                </p>
                            </div>
                            @endif
                            @endforeach

                            @if(collect($quantities)->sum() === 0)
                            <p class="text-sm text-gray-500 italic">No tickets selected yet</p>
                            @endif
                        </div>

                        <div class="bg-[#9EA2AC] w-full h-[0.05rem]"></div>

                        <div class="flex justify-end">
                            <h5 class="italic font-semibold text-lg">
                                Total: Rs {{ number_format($totalAmount) }}
                            </h5>
                        </div>
                    </div>


                    @error('tickets')
                    <p class="text-red-500 text-sm text-center">{{ $message }}</p>
                    @enderror

                    <button wire:click="proceedToCheckout" wire:loading.attr="disabled" wire:target="proceedToCheckout"
                        @if($this->grandTotal == 0)
                        disabled
                        @endif
                        class="text-white cursor-pointer rounded-lg text-center p-4 font-semibold uppercase
                        transition-all flex
                        items-center justify-center gap-2 w-full
                        {{ $this->grandTotal == 0
                        ? 'bg-gray-400 cursor-not-allowed'
                        : 'bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] hover:brightness-110' }}">

                        <!-- Spinner -->
                        <svg wire:loading wire:target="proceedToCheckout" class="animate-spin h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>

                        <!-- Button Text -->
                        <span wire:loading.remove wire:target="proceedToCheckout">
                            Buy Ticket{{ $this->totalTickets !== 1 ? 's' : '' }}
                        </span>

                        <span wire:loading wire:target="proceedToCheckout">
                            Processing...
                        </span>
                    </button>


                </div>
            </div>

        </div>
        <!-- details container -->
    </div>
    <livewire:pages.featured-section />
    <livewire:pages.partner-section />
    <livewire:pages.footer />
</section>