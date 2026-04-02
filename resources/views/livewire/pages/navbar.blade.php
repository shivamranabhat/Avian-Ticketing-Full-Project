<div>
    <nav class="navbar flex gap-x-0 lg:gap-x-20 justify-between lg:justify-start">
        <a href="/">
            <img src="{{asset('main/images/logo.png')}}" class="logo w-30 object-cover" alt="logo">
        </a>
        <ul class="hidden lg:flex gap-10 items-center text-primary font-medium">
            <li><a href="{{route('ticket.foryou')}}" class="hover:text-purple transition-all duration-300 hover:ease-in-out {{request()->segment(1) == 'foryou' ? 'active' : ''}}">For you</a></li>
            <li><a href="#" class="hover:text-purple transition-all duration-300 hover:ease-in-out">Events</a></li>
            <li><a href="{{route('ticket.activities')}}" class="hover:text-purple transition-all duration-300 hover:ease-in-out {{request()->segment(1) == 'activities' ? 'active' : ''}}">Activities</a>
            </li>
            <li><a href="#" class="hover:text-purple transition-all duration-300 hover:ease-in-out">Vehicle
                    Rental</a></li>
            <li><a href="#" class="hover:text-purple transition-all duration-300 hover:ease-in-out">Stores</a></li>
        </ul>
        <button class="lg:hidden focus:outline-none text-gray-800" aria-label="Toggle mobile menu" id="menu-toggle">
            <svg id="menu-icon" class="w-9 h-9 transition-all duration-300" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" stroke-width="2">
                <path class="line-1" stroke-linecap="round" d="M4 6h16" />
                <path class="line-2" stroke-linecap="round" d="M4 12h16" />
                <path class="line-3" stroke-linecap="round" d="M4 18h16" />
            </svg>
        </button>
    </nav>
    <!-- Mobile Menu Overlay + Slide Panel -->
    <div id="mobile-menu" class="fixed inset-0 lg:hidden z-[1000] pointer-events-none">
        <!-- Backdrop (fades in/out) -->
        <div id="menu-backdrop"
            class="absolute inset-0 bg-black/50 transition-opacity duration-400 ease-in-out opacity-0"></div>

        <!-- Sliding Panel (white content) -->
        <div id="menu-panel"
            class="relative flex flex-col h-full w-full bg-white shadow-2xl transform -translate-x-full transition-transform duration-400 ease-out">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-5 border-b">
                <a href="/">
                    <img src="{{asset('main/images/logo.png')}}" class="w-32 object-contain" alt="Company Logo" />
                </a>
                <button id="close-menu" class="text-gray-800 focus:outline-none" aria-label="Close menu">
                    <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Menu Links – centered vertically for better full-screen feel -->
            <div class="mt-20 flex items-center justify-center">
                <ul class="flex flex-col items-center gap-10 md:gap-12 text-2xl md:text-3xl font-medium text-gray-800">
                    <li><a href="{{route('ticket.foryou')}}" class="hover:text-purple-600 transition-colors {{request()->segment(1) == 'foryou' ? 'text-purple-600' : ''}}">For you</a></li>
                    <li><a href="#" class="hover:text-purple-600 transition-colors">Events</a></li>
                    <li><a href="{{route('ticket.activities')}}" class="hover:text-purple-600 transition-colors {{request()->segment(1) == 'activities' ? 'text-purple-600' : ''}}">Activities</a></li>
                    <li><a href="#" class="hover:text-purple-600 transition-colors">Vehicle Rental</a></li>
                    <li><a href="#" class="hover:text-purple-600 transition-colors">Stores</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>