<div class="flex flex-col gap-y-8">
    <div class="relative banner-section lg:px-24 xl:px-44  hidden md:block" >
        <!-- Banner -->
        <div class="relative w-full h-[40vh] sm:h-[60vh] md:h-[70vh] overflow-hidden md:rounded-xl">
            <img src="{{auth()->user()->details && auth()->user()->details->cover_pic ? asset('storage/' . auth()->user()->details->cover_pic) : asset('assets/pass/images/blank-cover.jpg')}}"
                class="w-full h-full object-cover object-center" alt="" wire:poll.keep-alive>

            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/50"></div>

            <!-- Desktop Center Text -->
            <div class="absolute inset-0 hidden md:flex items-center justify-center text-center">
                <h5 class="text-white text-2xl font-semibold">
                   
                    {{auth()->user()->details->bio ?? 'No bio available'}}
                </h5>
            </div>
        </div>
    </div>

    <div class="profile hidden md:flex items-center justify-between px-6 sm:px-16 lg:px-24 xl:px-44">
        <div class="flex items-center gap-x-6">
            <div class="img">
                <img src="{{auth()->user()->details && auth()->user()->details->profile_pic ? asset('storage/' . auth()->user()->details->profile_pic) : asset('assets/pass/images/blank-user.png')}}"
                    class="w-24 h-24 object-cover rounded-full" alt="" wire:poll.keep-alive>
            </div>
            <div class="flex flex-col">
                <h5 class="text-lg text-[#1E2330] font-bold">{{auth()->user()->name ?? 'XXXXXX'}}</h5>
                <p class="flex gap-x-6"> {{auth()->user()->details->bio ?? 'No bio available'}}</p>
                <a href="#" class="flex gap-x-6"> {{auth()->user()->phone ?? 'No phone available'}} <span> {{auth()->user()->details->location ?? 'No location available'}}</span></a>
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

</div>