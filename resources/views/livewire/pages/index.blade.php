<section>
    <div class="flex flex-col gap-y-8 px-6 py-2 sm:px-8 md:px-14 xl:px-24">
        <livewire:pages.navbar />
        <!-- banner section -->
        <div
            class="banner bg-gradient-to-r from-[#303ace] via-[#9206fa] to-[#e85aa4] text-white hidden md:flex justify-center px-4 py-3 rounded gap-6 items-center bg-pink-100">
            <h5 class="uppercase">
                List your event <span class="text-sm normal-case">- it's almost free to sell your event ticket
                    here.</span>
            </h5>
            <a href="#" class="bg-black text-white text-sm p-2 rounded"> Try it out</a>
        </div>
        <!-- banner section -->
        <!-- hero section -->
        <div class="grid grid-cols-2 lg:grid-cols-9 gap-x-0 gap-y-6 lg:gap-y-0 lg:gap-x-6">
            <div
                class="col-span-2 md:col-span-6 xl:col-span-7 bg-[url(./main/images/banner.png)] relative h-[20rem] bg-cover bg-center rounded-lg">
                <div
                    class="flex flex-col justify-center text-white gap-y-6 p-4 sm:p-8 h-full absolute w-full md:w-[70%] xl:w-1/2">
                    <h1 class="italic font-bold text-3xl lg:text-4xl xl:text-5xl">BOOK THE
                        <br>SAFE RIDE
                    </h1>
                    <h5 class="text-base xl:text-lg">Verified vehicles and trusted drivers, matched instantly for
                        concerts,
                        nightlife, tours, and airport
                        rides. No calls. No bargaining.</h5>
                    <p>Find My Ride</p>
                </div>
            </div>
            <div
                class="col-span-2 md:col-span-3 xl:col-span-2 h-full w-full rounded-2xl border border-gray-400 flex flex-col p-6 gap-y-4">
                <div class="price-box">
                    <p class="text-xs">From</p>
                    <h5 class="text-xl font-semibold">$5.50 <span class="text-primary text-sm">/hour</span></h5>
                </div>
                <div class="flex flex-col gap-y-3 mt-2">
                    <div class="flex gap-x-2 items-center">
                        <img src="{{asset('main/images/downloads.svg')}}" class="w-6 sm:w-5" alt="downloads icon">
                        <p class="text-primary text-sm sm:text-xs">
                            Unlimited stock downloads
                        </p>
                    </div>
                    <div class="flex gap-x-2 items-center">
                        <img src="{{asset('main/images/cert.svg')}}" class="w-6 sm:w-5" alt="cert icon">
                        <p class="text-primary text-sm sm:text-xs">
                            26+ million premium assets
                        </p>
                    </div>
                    <div class="flex gap-x-2 items-center">
                        <img src="{{asset('main/images/check.svg')}}" class="w-6 sm:w-5" alt="check icon">
                        <p class="text-primary text-sm sm:text-xs">
                            Lifetime commercial license
                        </p>
                    </div>
                    <div class="flex gap-x-2 items-center">
                        <img src="{{asset('main/images/logout.svg')}}" class="w-6 sm:w-5" alt="logout icon">
                        <p class="text-primary text-sm sm:text-xs">
                            Easy cancelation
                        </p>
                    </div>
                </div>
                <a href="#"
                    class="text-center mt-4 bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] text-sm text-white rounded px-4 py-2">Show
                    Offers!</a>
            </div>
        </div>
        <!-- hero section -->

        <!-- event section -->
        <div class="flex flex-col gap-y-4 mt-3 md:mt-6 lg:mt-10">
            <h2 class="text-2xl md:text-3xl font-semibold mt-3">All events</h2>
            <div class="flex gap-x-4 overflow-x-auto pb-4">
                <button
                    class="px-4 py-2 border border-gray-400 cursor-pointer text-sm rounded-lg hover:bg-active transition-all duration-300 hover:ease-in-out flex gap-x-2 items-center">
                    <img src="{{asset('main/images/filter.svg')}}" alt="filter">
                    Filters
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>

                </button>
                @forelse($eventCategories as $category)
                <button
                    class="px-4 py-2 border border-gray-400 cursor-pointer text-sm rounded-lg hover:bg-active transition-all duration-300 hover:ease-in-out">
                    {{ Str::replaceLast(' ', '&nbsp;', $category->name) }}
                </button>
                @empty
                <p>No event categories found.</p>
                @endforelse
            </div>
            @if($events)
            <div class="relative">
                <div class="owl-carousel event-slider z-10">
                    @foreach($events as $event)
                    <div class="item border border-gray-300 rounded-lg overflow-hidden">
                        <a class="flex flex-col gap-y-4" href="{{route('ticket.details',$event->event->slug)}}">
                            <img src="{{asset('storage/'.$event->event->main_image)}}"
                                class="w-full h-full rounded-t-lg object-cover" alt="{{$event->event->image_alt}}">
                            <div class="flex flex-col px-3 pb-3">
                                <p class="text-xs">
                                    {{ \Carbon\Carbon::parse($event->event->start_date)->format('D, d M, h:i A') }}
                                </p>
                                <h5 class="text-base font-semibold">
                                    {{ $event->event->name }}
                                </h5>
                                <p class="text-primary text-xs">
                                    {{ $event->event->venue }}
                                </p>
                                <h6 class="mt-2 text-xs">NRs.{{ number_format($event->event->tickets->min('price') ?? 0,
                                    0) }} onwards</h6>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>


                <button
                    class="absolute cursor-pointer top-1/2 translate-y-1/2 right-[-3rem] shadow-box p-1 hidden md:flex justify-center z-10 lg:z-0 rounded-full"
                    id="slideNext">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#9D00FF" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
            @else
            <div class="p-10 rounded-lg border border-gray-300 flex items-center justify-center">
                <h5 class="text-xl font-semibold">No events found.</h5>
            </div>
            @endif
        </div>
        <div class="h-px bg-gray-300"></div>
        <!-- event section -->
        <div class="flex flex-col gap-y-4 mt-3 md:mt-6 lg:mt-10">
            <h2 class="text-2xl md:text-3xl font-semibold mt-3">Discover the Top Activities in While You are In Pokhara
            </h2>
            <div class="flex gap-x-4 overflow-x-auto pb-4">
                <button
                    class="px-4 py-2 border border-gray-400 cursor-pointer text-sm rounded-lg hover:bg-active transition-all duration-300 hover:ease-in-out flex gap-x-2 items-center">
                    <img src="{{asset('main/images/filter.svg')}}" alt="filter">
                    Filters
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>

                </button>
                <button
                    class="px-4 py-2 border border-gray-400 cursor-pointer text-sm rounded-lg hover:bg-active transition-all duration-300 hover:ease-in-out">
                    Today

                </button>
                <button
                    class="px-4 py-2 border border-gray-400 cursor-pointer text-sm rounded-lg hover:bg-active transition-all duration-300 hover:ease-in-out">
                    Tommorow

                </button>
                <button
                    class="px-4 py-2 border border-gray-400 cursor-pointer text-sm rounded-lg hover:bg-active transition-all duration-300 hover:ease-in-out">
                    This&nbsp;Weekend

                </button>
                <button
                    class="px-4 py-2 border border-gray-400 cursor-pointer text-sm rounded-lg hover:bg-active transition-all duration-300 hover:ease-in-out">
                    Under&nbsp;10km

                </button>
                <button
                    class="px-4 py-2 border border-gray-400 cursor-pointer text-sm rounded-lg hover:bg-active transition-all duration-300 hover:ease-in-out">
                    Comedy

                </button>

            </div>
            <div class="relative">
                <div class="owl-carousel activity-slider z-10">
                    <div class="item border border-gray-300 rounded-lg overflow-hidden">
                        <a class="flex flex-col gap-y-4" href="details.html">
                            <img src="https://media.insider.in/image/upload/c_crop,g_custom/v1765797308/piyxlscoubr2t9vtbswt.png"
                                class="w-full h-full rounded-t-lg object-cover" alt="">
                            <div class="flex flex-col px-3 pb-3">
                                <p class="text-xs">Sat, 28 Feb, 6:00 PM</p>
                                <h5 class="text-base font-semibold">
                                    Karan Aujla P-Pop Culture India Tour
                                    - Delhi
                                </h5>
                                <p class="text-primary text-xs">
                                    Jawaharlal Nehru Stadium, Delhi/NCR
                                </p>
                                <h6 class="mt-2 text-xs">₹5999 onwards</h6>
                            </div>
                        </a>
                    </div>
                    <div class="item border border-gray-300 rounded-lg overflow-hidden">
                        <a class="flex flex-col gap-y-4" href="details.html">
                            <img src="https://media.insider.in/image/upload/c_crop,g_custom/v1767962984/brdnesmhdcmf1jifgzgs.png"
                                class="w-full h-full rounded-t-lg object-cover" alt="">
                            <div class="flex flex-col px-3 pb-3">
                                <p class="text-xs">Sat, 28 Feb, 6:00 PM</p>
                                <h5 class="text-base font-semibold">
                                    Karan Aujla P-Pop Culture India Tour
                                    - Delhi
                                </h5>
                                <p class="text-primary text-xs">
                                    Jawaharlal Nehru Stadium, Delhi/NCR
                                </p>
                                <h6 class="mt-2 text-xs">₹5999 onwards</h6>
                            </div>
                        </a>
                    </div>
                    <div class="item border border-gray-300 rounded-lg overflow-hidden">
                        <a class="flex flex-col gap-y-4" href="details.html">
                            <img src="https://media.insider.in/image/upload/c_crop,g_custom/v1768713205/bfikxlzq8kooqvtdcznu.jpg"
                                class="w-full h-full rounded-t-lg object-cover" alt="">
                            <div class="flex flex-col px-3 pb-3">
                                <p class="text-xs">Sat, 28 Feb, 6:00 PM</p>
                                <h5 class="text-base font-semibold">
                                    Karan Aujla P-Pop Culture India Tour
                                    - Delhi
                                </h5>
                                <p class="text-primary text-xs">
                                    Jawaharlal Nehru Stadium, Delhi/NCR
                                </p>
                                <h6 class="mt-2 text-xs">₹5999 onwards</h6>
                            </div>
                        </a>
                    </div>
                    <div class="item flex flex-col gap-y-4 border border-gray-300 rounded-lg overflow-hidden">
                        <a class="flex flex-col gap-y-4" href="details.html">
                            <img src="https://media.insider.in/image/upload/c_crop,g_custom/v1749453618/menszqwcm1r9ofqdpajr.png"
                                class="w-full h-full rounded-t-lg object-cover" alt="">
                            <div class="flex flex-col px-3 pb-3">
                                <p class="text-xs">Sat, 28 Feb, 6:00 PM</p>
                                <h5 class="text-base font-semibold">
                                    Karan Aujla P-Pop Culture India Tour
                                    - Delhi
                                </h5>
                                <p class="text-primary text-xs">
                                    Jawaharlal Nehru Stadium, Delhi/NCR
                                </p>
                                <h6 class="mt-2 text-xs">₹5999 onwards</h6>
                            </div>
                        </a>
                    </div>
                </div>


                <button
                    class="absolute cursor-pointer top-1/2 translate-y-1/2 right-[-3rem] shadow-box p-1 hidden md:flex justify-center z-10 lg:z-0 rounded-full"
                    id="activitySlideNext">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#9D00FF" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- event section -->
    </div>
    <livewire:pages.featured-section />
    <livewire:pages.partner-section />
    <livewire:pages.footer />
</section>