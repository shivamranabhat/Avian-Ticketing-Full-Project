<section>

    <div class="flex flex-col gap-y-8">
        <div class="px-6 py-2 sm:px-8 md:px-14 xl:px-24">
            <livewire:pages.navbar />
        </div>

        @if($featured->count()>0)
        <div class="bottom-container pb-10 hidden md:flex items-center justify-center  px-6 py-2 sm:px-8">
            <div class="owl-carousel banner-slider owl-theme" id="activity-banner-slider">
                @foreach($featured as $activity)
                <div class="rounded-xl grid grid-cols-2 gap-x-4 bg-[#FAF8F8] items-center">
                    <div class="left flex flex-col gap-4 p-8">
                        <h2 class="text-3xl lg:text-4xl font-bold text-primary">{{$activity->activity->name}}</h2>
                        <h5 class="text-lg lg:text-xl text-primary font-semibold">{{$activity->activity->location}}</h5>
                        <p class="text-sm font-semibold text-primary">
                            NRs.{{number_format($activity->activity->tickets->min('price') ?? 0)}} onwards</p>
                        <a href="#"
                            class="bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] px-6 py-3 rounded-lg text-white w-fit text-sm">Buy
                            Pass Now</a>
                    </div>
                    <div class="h-[55vh]">
                        <img src="{{asset('storage/'.$activity->activity->main_image)}}"
                            class="w-full rounded-r-lg h-full object-cover" alt="{{$activity->activity->img_alt}}">
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        <!-- featured activities mobile view -->
        <div class="flex flex-col gap-y-4 my-4 block md:hidden px-6 py-2 sm:px-8 md:px-14 xl:px-24">
            <div class="owl-carousel featured-slider z-10">
                @foreach($featured as $activity)
                <div class="item border border-gray-300 rounded-lg overflow-hidden">
                    <a class="flex flex-col gap-y-4" href="details.html">
                        <img src="{{asset('storage/'.$activity->activity->main_image)}}"
                            class="w-full h-full rounded-t-lg object-cover" alt="{{$activity->activity->img_alt}}">
                        <div class="flex flex-col px-3 pb-3">
                            <h5 class="text-base font-semibold">
                                {{$activity->activity->name}}
                            </h5>
                            <p class="text-primary text-xs">
                                {{$activity->activity->location}}
                            </p>
                            <h6 class="mt-2 text-xs">NRs.{{number_format($activity->activity->tickets->min('price') ??
                                0)}} onwards</h6>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @else
        @endif
        <!-- featured activities mobile view -->
        <!-- activity section -->
        <div class="flex flex-col gap-y-4 px-6 py-2 sm:px-8 md:px-14 xl:px-24 mt-4">
            <h2 class="text-2xl md:text-3xl font-semibold mt-3">All Activities</h2>
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

            @if($activities->count()>0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($activities as $activity)
                <div class="item border border-gray-300 rounded-lg overflow-hidden">
                    <a class="flex flex-col gap-y-4" href="details.html">
                        <img src="{{asset('storage/'.$activity->main_image)}}"
                            class="w-full h-full rounded-t-lg object-cover" alt="">
                        <div class="flex flex-col px-3 pb-3">
                            <h5 class="text-base font-semibold">
                                {{$activity->name}}
                            </h5>
                            <p class="text-primary text-xs">
                                {{$activity->location}}
                            </p>
                            <h6 class="mt-2 text-xs">NRs.{{ number_format($activity->tickets->min('price') ?? 0, 0) }}
                                onwards</h6>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <div
                class="p-12 rounded-2xl border border-dashed border-gray-300 flex flex-col items-center justify-center text-center">
                <p class="text-2xl">😕</p>
                <h5 class="text-xl font-semibold mt-3">No activity found</h5>
                <p class="text-gray-500 mt-2">Try selecting a different category</p>
            </div>
            @endif
        </div>
    </div>
    <livewire:pages.featured-section />
    <livewire:pages.partner-section />
    <livewire:pages.footer />
</section>