<div class="bg-white md:bg-[#F3E4E4] py-8 md:py-18 flex flex-col gap-y-8">
    <livewire:pass.navbar />
    <div class="relative banner-section lg:px-24 xl:px-44">

        <!-- Banner -->
        <div class="relative w-full h-[40vh] sm:h-[60vh] md:h-[70vh] overflow-hidden md:rounded-xl">

            <img src="{{$details->cover_pic ? asset('storage/' . $details->cover_pic) : asset('assets/pass/images/blank-cover.jpg')}}"
                class="w-full h-full object-cover object-center" alt="" wire:poll.keep-alive>

            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/50"></div>

            <!-- Desktop Center Text -->
            <div class="absolute inset-0 hidden md:flex items-center justify-center text-center">
                <h5 class="text-white text-2xl font-semibold">
                    {{$details->bio ?? 'No bio available'}}
                </h5>
            </div>
        </div>

        <!-- Mobile Profile Card -->
        <div class="md:hidden relative mt-24 px-6">

            <div class="relative bg-gradient-to-r from-indigo-600 via-purple-600 to-orange-500
                    rounded-2xl pt-24 pb-10 px-8 text-center text-white shadow-xl">

                <!-- Avatar -->
                <div class="absolute -top-16 left-1/2 -translate-x-1/2">
                    <img src="{{ $details->profile_pic ? asset('storage/' . $details->profile_pic) : asset('assets/pass/images/blank-user.png')}}"
                        alt="Profile" class="w-32 h-32 object-cover rounded-full border-4 border-white"
                        wire:poll.keep-alive>
                </div>

                <!-- Name -->
                <h2 class="text-2xl font-bold">{{$details->name ?? 'XXXXXX'}}</h2>

                <!-- Title -->
                <p class="mt-2 text-lg italic text-white/90">
                    {{$details->bio ?? 'No bio available'}}
                </p>

                <!-- Divider -->
                <div class="w-34 h-px bg-white/40 mx-auto my-5"></div>

                <!-- Phone -->
                <a href="tel:{{$details->phone ?? 'XXXXXXXXXX'}}" class="text-lg font-medium">
                    {{$details->phone ?? 'XXXXXXXXXX'}}
                </a>

                <!-- Divider -->
                <div class="w-34 h-px bg-white/40 mx-auto my-5"></div>

                <!-- Location -->
                <p class="text-lg text-white/90">
                    {{$details->location ?? 'No location available'}}
                </p>

            </div>
        </div>

    </div>



    <div class="profile hidden md:flex items-center justify-between px-6 sm:px-16 lg:px-24 xl:px-44">
        <div class="flex items-center gap-x-6">
            <div class="img">
                <img src="{{ $details->profile_pic ? asset('storage/' . $details->profile_pic) : asset('assets/pass/images/blank-user.png') }}"
                    class="w-[6rem] h-[6rem] object-cover rounded-full" alt="" wire:poll.keep-alive>
            </div>
            <div class="flex flex-col">
                <h5 class="text-lg text-[#1E2330] font-bold">{{ $details->name ?? 'XXXXXX' }}</h5>
                <p class="flex gap-x-6">{{ $details->bio ?? 'No bio available' }}</p>
                <a href="tel:{{$details->phone ?? 'XXXXXXXXXX'}}" class="flex gap-x-6">{{$details->phone ??
                    'XXXXXXXXXX'}} <span>{{$details->details->location ?? 'No location available'}}</span></a>
            </div>
        </div>
        <a href="#"
            class="bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] text-white text-sm px-4 py-2 rounded flex items-center gap-x-1"><svg
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            Settings</a>
    </div>

    <div class="handles grid grid-cols-1 lg:grid-cols-2 gap-6 px-6 sm:px-16 lg:px-24 xl:px-44">
        <div class="flex flex-col gap-y-6">
            <div class="bg-[#fbf3f3] rounded-lg flex flex-col gap-y-6 p-8">
                <h5 class="font-bold text-2xl">Social Links</h5>
                <div class="links flex flex-col gap-y-4">
                    @forelse($details->socialLinks as $link)
                        <div class="child-link flex justify-between items-center">
                            <div class="flex flex-col">
                                <span class="italic">{{ ucfirst($link['name']) }}</span>
                                <h5 class="font-semibold">{{ $link['url'] }}</h5>
                            </div>
                            <a href="{{ $link['url'] }}" target="_blank"
                                class="bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] text-white text-sm px-4 py-2 rounded">Follow</a>
                        </div>
                        @if (!$loop->last)
                        <div class="w-full h-px bg-[#969695]"></div>
                        @endif
                    @empty
                    <p class="text-sm text-gray-500">No social links available.</p>
                    @endforelse
                   
                </div>
            </div>
            <div class="bg-[#fbf3f3] rounded-lg flex flex-col gap-y-6 p-8">
                <h5 class="font-bold text-2xl">Professional Bio</h5>
                <div class="links flex flex-col gap-y-4">
                    <div class="child-link flex justify-between items-center">
                        <div class="flex flex-col">
                            <span class="italic text-xs">Work Experience</span>
                            <h5 class="font-semibold">Download CV</h5>
                            <span class="italic text-xs">View Details</span>
                        </div>
                        <a href="{{asset('storage/' . $details->cv) }}" target="_blank"
                            class="bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] text-white text-sm px-4 py-2 rounded">Download</a>
                    </div>
                    <div class="w-full h-px bg-[#969695]"></div>
                    @forelse($details->businessLinks as $business)
                    <div class="child-link flex justify-between items-center">
                        <div class="flex flex-col">
                            <span class="italic text-xs">Business</span>
                            <h5 class="font-semibold">{{ $business->name }}</h5>
                            <span class="italic text-xs">View Details</span>
                        </div>
                        <a href="{{ $business->url }}" target="_blank"
                            class="bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] text-white text-sm px-4 py-2 rounded">Visit</a>
                    </div>
                    @if (!$loop->last)
                    <div class="w-full h-px bg-[#969695]"></div>
                    @endif
                    @empty
                    <p class="text-sm text-gray-500">No businesses available.</p>
                    @endforelse

                </div>
            </div>
            <div class="flex flex-col gap-y-4" id="extras">
                <div class="bg-[#fbf3f3] p-4 rounded-lg flex flex-col gap-y-1">
                    <h5 class="text-lg font-bold text-primary">
                        NSIC Exhibition Ground Gate 6
                    </h5>
                    <p class="text-sm text-[#45474D] font-semibold">
                        509/5, Ma Anandmayee Marg, Govind Puri, Giri Nagar, NSIC Estate, Okhla Phase III, Okhla
                        Industrial Estate, New Delhi, Delhi 110019, India
                    </p>
                </div>
                <div class="accordions flex flex-col gap-y-6">
                    <div class="accordion-item rounded-lg border border-gray-200 bg-[#fbf3f3] overflow-hidden">
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
                            <div class="flex flex-col border-t py-3 border-gray-300">
                                <h6 class="text-sm font-semibold">Is there an age restriction for the event?</h6>
                                <p class="text-xs">Entry is allowed for all ages. However, children aged 3 years and
                                    above require a valid ticket.</p>
                            </div>
                            <div class="flex flex-col border-t py-3 border-gray-300">
                                <h6 class="text-sm font-semibold">Is there an age restriction for the event?</h6>
                                <p class="text-xs">Entry is allowed for all ages. However, children aged 3 years and
                                    above require a valid ticket.</p>
                            </div>
                            <div class="flex flex-col border-t py-3 border-gray-300">
                                <h6 class="text-sm font-semibold">Is there an age restriction for the event?</h6>
                                <p class="text-xs">Entry is allowed for all ages. However, children aged 3 years and
                                    above require a valid ticket.</p>
                            </div>
                            <div class="flex flex-col border-t py-3 border-gray-300">
                                <h6 class="text-sm font-semibold">Is there an age restriction for the event?</h6>
                                <p class="text-xs">Entry is allowed for all ages. However, children aged 3 years and
                                    above require a valid ticket.</p>
                            </div>
                            <div class="flex flex-col border-t py-3 border-gray-300">
                                <h6 class="text-sm font-semibold">Is there an age restriction for the event?</h6>
                                <p class="text-xs">Entry is allowed for all ages. However, children aged 3 years and
                                    above require a valid ticket.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item rounded-lg border border-gray-200 bg-[#fbf3f3] overflow-hidden">
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
                            <div class="flex flex-col border-t py-3 border-gray-300">
                                <h6 class="text-sm font-semibold">Is there an age restriction for the event?</h6>
                                <p class="text-xs">Entry is allowed for all ages. However, children aged 3 years and
                                    above require a valid ticket.</p>
                            </div>
                            <div class="flex flex-col border-t py-3 border-gray-300">
                                <h6 class="text-sm font-semibold">Is there an age restriction for the event?</h6>
                                <p class="text-xs">Entry is allowed for all ages. However, children aged 3 years and
                                    above require a valid ticket.</p>
                            </div>
                            <div class="flex flex-col border-t py-3 border-gray-300">
                                <h6 class="text-sm font-semibold">Is there an age restriction for the event?</h6>
                                <p class="text-xs">Entry is allowed for all ages. However, children aged 3 years and
                                    above require a valid ticket.</p>
                            </div>
                            <div class="flex flex-col border-t py-3 border-gray-300">
                                <h6 class="text-sm font-semibold">Is there an age restriction for the event?</h6>
                                <p class="text-xs">Entry is allowed for all ages. However, children aged 3 years and
                                    above require a valid ticket.</p>
                            </div>
                            <div class="flex flex-col border-t py-3 border-gray-300">
                                <h6 class="text-sm font-semibold">Is there an age restriction for the event?</h6>
                                <p class="text-xs">Entry is allowed for all ages. However, children aged 3 years and
                                    above require a valid ticket.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="image hidden lg:flex ">
            <img src="{{ $details->side_pic ? asset('storage/'.$details->side_pic) : asset('assets/images/default-image.jpg') }}" class="w-full h-[70vh] object-cover rounded-lg" id="right-sticky-col"
                alt="">
        </div>
    </div>
</div>