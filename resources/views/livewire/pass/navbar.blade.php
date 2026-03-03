<div class="px-6 sm:px-16 lg:px-24 xl:px-44">
        <nav
            class="bg-white border border-[#E9C0E9] md:border-none px-6 py-4 flex items-center justify-between rounded-full navbar">
            <div class="left-col flex gap-x-18 items-center">
                <a href="/"><img src="{{asset('assets/pass/images/logo.svg')}}" class="w-14 h-14" alt="logo"></a>
                
                <div class="links hidden lg:flex gap-x-10 items-center">
                    <a href="#">Templates</a>
                    <a href="#">Learn</a>
                    <a href="#">Pricing</a>
                </div>
            </div>
            <div class="right-col flex gap-x-6 items-center">
                @if (auth()->check())
                    <a href="{{ route('pass.dashboard') }}" class=" px-6 py-3 rounded-lg cursor-pointer">
                        <img src="{{auth()->user()->details && auth()->user()->details->profile_pic ? asset('storage/' . auth()->user()->details->profile_pic) : asset('assets/pass/images/blank-user.png')}}" class="w-10 h-10 rounded-full object-cover" alt="">
                    </a>
                @else
                    <a href="{{ route('pass.login') }}" class="bg-[#EFF0EC] px-6 py-3 rounded-lg">Login</a>
                    <a href="#" class="bg-[#1E2330] text-white rounded-3xl px-6 py-3 hidden lg:inline">Sign up free</a>
                @endif
                <button class="inline lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </nav>
    </div>