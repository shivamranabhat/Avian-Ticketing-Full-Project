<section>
    <div class="flex flex-col gap-y-8 px-6 py-2 sm:px-8 md:px-14 xl:px-24">
        <livewire:pages.navbar />

        <div class="details grid grid-cols-2 xl:grid-cols-9 gap-10">
            <div class="left-col col-span-2 xl:col-span-6 flex flex-col gap-y-8">

                <!-- Main Image -->
                <img src="{{ $event ? asset('storage/'.$event->main_image) : asset('main/images/blank.png') }}"
                     class="w-full h-[20rem] md:h-[32rem] object-cover rounded-lg"
                     alt="{{ $event->image_alt ?? 'details-image' }}">

                <!-- Event Details -->
                <div class="flex flex-col gap-y-4">
                    <h1 class="text-2xl font-bold">{{ $event->title }}</h1>
                    <div class="flex flex-col md:flex-row gap-y-4 md:gap-y-0 gap-x-0 md:gap-x-8">
                        <div class="organizer flex items-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#545459" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <p class="text-primary text-sm">{{ $event->organizer }}</p>
                        </div>

                        <div class="date flex items-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#545459" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            <p class="text-primary text-sm">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('D, d M, h:i A') }}
                            </p>
                        </div>

                        <div class="location flex items-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#545459" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <p class="text-primary text-sm">{{ $event->location }}</p>
                        </div>
                    </div>
                </div>

                <div class="rspv bg-black text-white rounded-lg p-4">
                    <p class="text-sm italic">FOR TABLE BOOKING, PLEASE CONTACT OR WHATSAPP: 9704554051</p>
                </div>

                <!-- ====================== MOBILE FORM ====================== -->
                <div class="flex xl:hidden flex-col gap-y-4 bg-white rounded">
                    <div class="border border-gray-300 rounded-lg p-4 flex flex-col gap-y-6">
                        <h5 class="font-bold text-xl text-secondary">Personal Details</h5>

                        <form wire:submit="confirmBooking" class="flex flex-col gap-y-4">

                            <div class="input flex flex-col">
                                <label class="text-sm text-primary italic">Full Name <span class="text-red-400">*</span></label>
                                <input type="text" wire:model="name" class="border-b border-gray-400 px-1 py-2 focus:outline-none focus:border-pink">
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="input flex flex-col">
                                <label class="text-sm text-primary italic">Phone Number <span class="text-red-400">*</span></label>
                                <input type="text" wire:model="phone" class="border-b border-gray-400 px-1 py-2 focus:outline-none focus:border-pink">
                                @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="input flex flex-col">
                                <label class="text-sm text-primary italic">Email Address <span class="text-red-400">*</span></label>
                                <input type="email" wire:model="email" class="border-b border-gray-400 px-1 py-2 focus:outline-none focus:border-pink">
                                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <p class="text-primary mt-2">Select Payment Method</p>
                            <div class="radio flex gap-x-6 items-center">
                                <div class="option flex gap-x-2 items-center">
                                    <input type="radio" wire:model="pay_method" value="esewa" id="esewa" class="w-4 h-4 accent-pink cursor-pointer">
                                    <label for="esewa" class="text-sm text-secondary italic flex items-center gap-x-1">
                                        <img src="https://cdn.esewa.com.np/ui/images/logos/esewa-icon-large.png" alt="esewa" class="w-6"> eSewa
                                    </label>
                                </div>

                                <div class="option flex gap-x-2 items-center">
                                    <input type="radio" wire:model="pay_method" value="khalti" id="khalti" class="w-4 h-4 accent-pink cursor-pointer">
                                    <label for="khalti" class="text-sm text-secondary italic flex items-center gap-x-1">
                                        <img src="https://cdn.aptoide.com/imgs/b/2/c/b2c3c82e2890203b7a4b0cfb188b3f71_icon.png" alt="khalti" class="w-8"> Khalti
                                    </label>
                                </div>
                                @error('pay_method') 
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
                                @enderror
                            </div>

                            <!-- Fixed Spinner Button -->
                            <button 
                                type="submit" 
                                wire:loading.attr="disabled"
                                wire:target="confirmBooking"
                                class="text-white rounded-lg cursor-pointer text-center p-3 font-semibold uppercase transition-all hover:brightness-110 bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] w-full mt-4 flex items-center justify-center gap-x-3 disabled:opacity-80">

                                <svg wire:loading wire:target="confirmBooking" 
                                     class="animate-spin h-5 w-5 text-white" 
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>

                                <span wire:loading.remove wire:target="confirmBooking">Proceed to Pay</span>
                                <span wire:loading wire:target="confirmBooking">Processing...</span>
                            </button>
                        </form>
                    </div>

                    <div class="flex items-center gap-x-2 text-xs">
                        <p class="text-primary italic">Your payment is Encrypted.</p>
                        <a href="#" class="text-purple-500 underline italic">Read Terms and Conditions</a>
                    </div>
                </div>

                <!-- Total Tickets Summary -->
                <div class="border border-gray-300 rounded-lg p-4 flex flex-col gap-y-6" id="venue">
                    <div class="flex gap-x-4 items-center">
                        <h5 class="font-bold text-xl text-secondary">Total Tickets</h5>
                        <span class="bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] rounded px-4 py-2 text-xs text-white font-medium">
                            {{ $totalTickets }}X
                        </span>
                    </div>

                    <div class="flex flex-col gap-y-3">
                        @forelse($selectedTickets as $item)
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-primary italic">
                                    {{ $item['qty'] }} × {{ $item['name'] }}
                                </p>
                                <p class="text-sm font-semibold">
                                    Rs {{ number_format($item['subtotal'], 0) }}
                                </p>
                            </div>
                        @empty
                            <p class="text-gray-400 text-center py-4">No tickets selected</p>
                        @endforelse
                    </div>

                    <div class="bg-[#9EA2AC] w-full h-[0.05rem]"></div>

                    <div class="flex justify-end">
                        <h5 class="italic font-semibold text-xl">
                            Total: Rs {{ number_format($grandTotal, 0) }}
                        </h5>
                    </div>
                </div>
            </div>

            <!-- ====================== DESKTOP RIGHT COLUMN ====================== -->
            <div class="right-col col-span-2 xl:col-span-3 hidden xl:block">
                <div class="flex flex-col gap-y-4 bg-white rounded" id="right-sticky-col">
                    <div class="border border-gray-300 rounded-lg p-4 flex flex-col gap-y-6">
                        <h5 class="font-bold text-xl text-secondary">Personal Details</h5>

                        <form wire:submit="confirmBooking" class="flex flex-col gap-y-4">

                            <div class="input flex flex-col">
                                <label class="text-sm text-primary italic">Full Name <span class="text-red-400">*</span></label>
                                <input type="text" wire:model="name" class="border-b border-gray-400 px-1 py-2 focus:outline-none focus:border-pink">
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="input flex flex-col">
                                <label class="text-sm text-primary italic">Phone Number <span class="text-red-400">*</span></label>
                                <input type="text" wire:model="phone" class="border-b border-gray-400 px-1 py-2 focus:outline-none focus:border-pink">
                                @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="input flex flex-col">
                                <label class="text-sm text-primary italic">Email Address <span class="text-red-400">*</span></label>
                                <input type="email" wire:model="email" class="border-b border-gray-400 px-1 py-2 focus:outline-none focus:border-pink">
                                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <p class="text-primary mt-2">Select Payment Method</p>
                            <div class="radio flex gap-x-6 items-center">
                                <div class="option flex gap-x-2 items-center">
                                    <input type="radio" wire:model="pay_method" value="esewa" id="esewa" class="w-4 h-4 accent-pink cursor-pointer">
                                    <label for="esewa" class="text-sm text-secondary italic flex items-center gap-x-1">
                                        <img src="https://cdn.esewa.com.np/ui/images/logos/esewa-icon-large.png" alt="esewa" class="w-6"> eSewa
                                    </label>
                                </div>

                                <div class="option flex gap-x-2 items-center">
                                    <input type="radio" wire:model="pay_method" value="khalti" id="khalti" class="w-4 h-4 accent-pink cursor-pointer">
                                    <label for="khalti" class="text-sm text-secondary italic flex items-center gap-x-1">
                                        <img src="https://cdn.aptoide.com/imgs/b/2/c/b2c3c82e2890203b7a4b0cfb188b3f71_icon.png" alt="khalti" class="w-8"> Khalti
                                    </label>
                                </div>
                                @error('pay_method') 
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
                                @enderror
                            </div>

                            <!-- Desktop Spinner Button -->
                            <button 
                                type="submit" 
                                wire:loading.attr="disabled"
                                wire:target="confirmBooking"
                                class="text-white rounded-lg cursor-pointer text-center p-3 font-semibold uppercase transition-all hover:brightness-110 bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] w-full mt-4 flex items-center justify-center gap-x-3 disabled:opacity-80">

                                <svg wire:loading wire:target="confirmBooking" 
                                     class="animate-spin h-5 w-5 text-white" 
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>

                                <span wire:loading.remove wire:target="confirmBooking">Proceed to Pay</span>
                                <span wire:loading wire:target="confirmBooking">Processing...</span>
                            </button>
                        </form>
                    </div>

                    <div class="flex items-center gap-x-2 text-xs">
                        <p class="text-primary italic">Your payment is Encrypted.</p>
                        <a href="#" class="text-purple-500 underline italic">Read Terms and Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:pages.featured-section />
    <livewire:pages.partner-section />
    <livewire:pages.footer />
</section>