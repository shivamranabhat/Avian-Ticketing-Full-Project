<section>
    <div class="flex flex-col gap-y-8 px-6 py-2 sm:px-8 md:px-14 xl:px-24">
        <livewire:pages.navbar />
    </div>
    <!-- bottom container -->
    @if($featured->count()>0)
    <div class="bottom-container pb-10 bg-[url(./main/images/bottom-container.png)] bg-no-repeat object-cover w-full h-full hidden md:flex items-center justify-center"
        wire:ignore>
        <div class="owl-carousel banner-slider owl-theme" id="banner-slider">
            @foreach($featured as $event)
            <div class="flex justify-center items-center">
                <div class="left flex flex-col gap-4 p-10 xl:p-16">
                    <p class="text-sm font-semibold"> {{ \Carbon\Carbon::parse($event->event->start_date)->format('D, d
                        M, h:i A') }}</p>
                    <h2 class="text-4xl font-bold"> @php
                        $words = explode(' ', trim($event->event->name));
                        $firstFour = array_slice($words, 0, 4);
                        $remaining = array_slice($words, 4);
                        @endphp

                        {{ implode(' ', $firstFour) }}
                        @if(count($remaining) > 0)
                        <br>{{ implode(' ', $remaining) }}
                        @endif
                    </h2>
                    <h5 class="text-xl font-bold"> {{ $event->event->location }}</h5>
                    <p class="text-sm font-semibold">NRs.{{ number_format($event->event->tickets->min('price') ?? 0,
                        0) }} onwards</p>
                    <a href="{{route('ticket.details',$event->event->slug)}}"
                        class="bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] px-6 py-3 rounded-lg text-white w-fit text-sm">Buy
                        tickets</a>
                </div>
                <div class="p-10 xl:p-16">
                    <img src="{{asset('storage/'.$event->event->main_image)}}"
                        class="rounded-lg w-full object-cover h-[25rem]" alt="{{$event->event->img_alt}}">
                </div>
            </div>
            @endforeach

        </div>
    </div>
    @endif
    <!-- featured events mobile view -->
    @if($featured->count()>0)
    <div class="flex flex-col gap-y-4 my-4 md:hidden">
        <div class="owl-carousel featured-slider z-10">
            @foreach($featured as $event)
            <div class="item border border-gray-300 rounded-lg overflow-hidden">
                <a class="flex flex-col gap-y-4" href="{{route('ticket.details',$event->event->slug)}}">
                    <img src="{{asset('storage/'.$event->event->main_image)}}"
                        class="w-full h-full rounded-t-lg object-cover" alt="{{$event->event->img_alt}}">
                    <div class="flex flex-col px-3 pb-3">
                        <p class="text-xs">{{ \Carbon\Carbon::parse($event->event->start_date)->format('D, d M, h:i A') }}</p>
                        <h5 class="text-base font-semibold">
                           {{ $event->event->name }}
                        </h5>
                        <p class="text-primary text-xs">
                            {{ $event->event->location }}
                        </p>
                        <h6 class="mt-2 text-xs">NRs.{{ number_format($event->event->tickets->min('price') ?? 0, 0) }} onwards</h6>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
    @endif
    <!-- featured events mobile view -->
    <!-- event section -->
    <div class="flex flex-col gap-y-4 px-6 py-2 sm:px-8 md:px-14 xl:px-24 mt-6 md:mt-10">
        <h2 class="text-2xl md:text-3xl font-semibold mt-3">All events</h2>
        <div class="flex gap-x-4 overflow-x-auto pb-4">
            <button wire:click="filterByCategory(null)"
                class="px-4 py-2  cursor-pointer text-sm rounded-lg hover:bg-active transition-all duration-300 hover:ease-in-out
                   {{ $selectedCategory === null ? 'bg-[#C22C9F] text-white border-[#C22C9F]' : 'border border-gray-400' }}">
                All Events
            </button>
            @forelse($categories as $category)
            <button wire:click="filterByCategory({{ $category->id }})"
                class="px-4 py-2 {{ $selectedCategory === $category->id ? 'bg-[#C22C9F] text-white border-[#C22C9F]' : 'border border-gray-400' }} cursor-pointer text-sm rounded-lg hover:bg-active transition-all duration-300 hover:ease-in-out">
                {{$category->name}}

            </button>
            @empty
            @endforelse


        </div>
        @if($events->count()>0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($events as $event)
            <div class="item border border-gray-300 rounded-lg overflow-hidden">
                <a class="flex flex-col gap-y-4" href="{{route('ticket.details',$event->slug)}}">
                    <img src="{{asset('storage/'.$event->main_image)}}" class="w-full h-full rounded-t-lg object-cover"
                        alt="{{$event->image_alt}}">
                    <div class="flex flex-col px-3 pb-3">
                        <p class="text-xs">
                            {{ \Carbon\Carbon::parse($event->start_date)->format('D, d M, h:i A') }}
                        </p>
                        <h5 class="text-base font-semibold">
                            {{ $event->name }}
                        </h5>
                        <p class="text-primary text-xs">
                            {{ $event->venue }}
                        </p>
                        <h6 class="mt-2 text-xs">NRs.{{ number_format($event->tickets->min('price') ?? 0, 0) }}
                            onwards</h6>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        {{-- <div class="p-10 rounded-lg border border-gray-300 flex items-center justify-center">
            <h5 class="text-xl font-semibold">No events found.</h5>
        </div> --}}
        <div
            class="p-12 rounded-2xl border border-dashed border-gray-300 flex flex-col items-center justify-center text-center">
            <p class="text-2xl">😕</p>
            <h5 class="text-xl font-semibold mt-3">No events found</h5>
            <p class="text-gray-500 mt-2">Try selecting a different category</p>
        </div>
        @endif
    </div>
    <livewire:pages.partner-section />
    <livewire:pages.footer />
</section>