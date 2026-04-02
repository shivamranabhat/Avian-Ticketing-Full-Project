<section>
    <div class="flex flex-col gap-y-8 px-6 py-2 sm:px-8 md:px-14 xl:px-24">
        <livewire:pages.navbar />
        <!-- banner section -->
        @if($header)
        <div
            class="banner bg-gradient-to-r from-[#303ace] via-[#9206fa] to-[#e85aa4] text-white hidden md:flex justify-center px-4 py-3 rounded gap-6 items-center bg-pink-100">
            <h5 class="uppercase">
                {{$header->title}} <span class="text-sm normal-case">- {{$header->subtitle}}
                </span>
            </h5>
            <a href="{{$header->btn_link}}" class="bg-black text-white text-sm p-2 rounded">{{$header->btn_txt}}</a>
        </div>
        @endif
        <!-- banner section -->
        <!-- hero section -->
        <section class="owl-carousel hero-slider">
            <div class="grid grid-cols-2 lg:grid-cols-9 gap-x-0 gap-y-6 lg:gap-y-0 lg:gap-x-6">
                @forelse($sliders as $slider)
                <div
                    class="col-span-2 md:col-span-6 xl:col-span-7 relative h-[20rem] bg-cover bg-center rounded-lg" style="background-image: url('{{asset('storage/'.$slider->image)}}')">
                    <div
                        class="flex flex-col justify-center text-white gap-y-6 p-4 sm:p-8 h-full absolute w-full md:w-[70%] xl:w-1/2">
                        <h1 class="italic font-bold text-3xl lg:text-4xl xl:text-5xl">
                            {{ explode(' ', $slider->title, 2)[0] ?? '' }}<br>
                            {{ explode(' ', $slider->title, 2)[1] ?? '' }}
                        </h1>
                        <h5 class="text-base xl:text-lg">{{$slider->subtitle}}</h5>
                        <a href="{{$slider->left_btn_link}}" class="cursor-pointer">{{$slider->left_btn_txt}}</a>
                    </div>
                </div>
                <div
                    class="col-span-2 md:col-span-3 xl:col-span-2 h-full w-full rounded-2xl border border-gray-400 flex flex-col p-6 gap-y-4">
                    <div class="price-box">
                        <p class="text-xs">From</p>
                        <h5 class="text-xl font-semibold">NRs.{{number_format($slider->starting_price,0)}} <span class="text-primary text-sm">/hour</span></h5>
                    </div>
                    <div class="flex flex-col gap-y-3 mt-2">
                        @forelse($slider->sliderLists as $list)
                        <div class="flex gap-x-2 items-center">
                            <img src="{{asset('storage/'.$list->icon)}}" class="w-8 sm:w-5" alt="icon icon">
                            <p class="text-primary text-sm sm:text-xs">
                               {{$slider->title}}
                            </p>
                        </div>
                        @empty
                       @endforelse
                    </div>
                    <a href="{{$slider->right_btn_link}}"
                        class="text-center mt-4 bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] text-sm text-white rounded px-4 py-2">{{$slider->right_btn_txt}}</a>
                </div>
                @empty

                @endforelse
            </div>
        </section>
        <!-- hero section -->

        <!-- event section -->
        <div class="flex flex-col gap-y-4 mt-3 md:mt-6 lg:mt-10">
            <h2 class="text-2xl md:text-3xl font-semibold mt-3">All events</h2>

            @if($events->count()>0)
            <div class="relative">
                <div class="owl-carousel event-slider z-10">
                    @foreach($events as $event)
                    <div class="item border border-gray-300 rounded-lg overflow-hidden">
                        <a class="flex flex-col gap-y-4" href="{{route('ticket.details',$event->event->slug)}}">
                            <img src="{{asset('storage/'.$event->event->main_image)}}"
                                class="w-full h-full rounded-t-lg object-cover" alt="{{$event->event->image_alt}}">
                            <div class="flex flex-col px-3 pb-3">
                                <p class="text-xs">
                                    {{ \Carbon\Carbon::parse($event->event->date)->format('D, d M, h:i A') }}
                                </p>
                                <h5 class="text-base font-semibold">
                                    {{ $event->event->name }}
                                </h5>
                                <p class="text-primary text-xs">
                                    {{ $event->event->location }}
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
           @if($activities->count()>0)
            <div class="relative">
                <div class="owl-carousel activity-slider z-10">
                    @foreach($activities as $activity)
                    <div class="item border border-gray-300 rounded-lg overflow-hidden">
                        <a class="flex flex-col gap-y-4" href="{{route('activity.details',$activity->activity->slug)}}">
                            <img src="{{asset('storage/'.$activity->activity->main_image)}}"
                                class="w-full h-full rounded-t-lg object-cover" alt="{{$activity->activity->image_alt}}">
                            <div class="flex flex-col px-3 pb-3">
                               
                                <h5 class="text-base font-semibold">
                                    {{ $activity->activity->name }}
                                </h5>
                                <p class="text-primary text-xs">
                                    {{ $activity->activity->location }}
                                </p>
                                <h6 class="mt-2 text-xs">NRs.{{ number_format($activity->activity->tickets->min('price') ?? 0,
                                    0) }} onwards</h6>
                            </div>
                        </a>
                    </div>
                    @endforeach
                  
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
            @else
            <div class="p-10 rounded-lg border border-gray-300 flex items-center justify-center">
                <h5 class="text-xl font-semibold">No activity found.</h5>
            </div>
            @endif
        </div>
        <!-- event section -->
    </div>
    <livewire:pages.featured-section />
    <livewire:pages.partner-section />
    <livewire:pages.footer />
</section>