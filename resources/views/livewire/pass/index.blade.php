<section>
    <div class="bg-white md:bg-[#F3E4E4] py-8 md:py-18 flex flex-col gap-y-8">
       <livewire:pass.navbar />
        <div class="hero-section grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-6 px-2 md:px-8 lg:px-14 my-10">
            <div class="left flex flex-col gap-y-3 md:gap-y-4 justify-center text-center">
                <h1 class="font-extrabold text-3xl sm:text-4xl md:text-5xl">Your Digital Card.<br> All Important Links
                </h1>
                <h5 class="text-[#E4544C] font-extrabold text-2xl md:text-4xl">One Click Access</h5>
            </div>
            <div class="right bg-[#E9C0E9] p-6 sm:p-8 md:p-16 rounded-xl flex flex-col justify-center gap-y-6">
                <img src="{{ asset('assets/pass/images/pass-hero-img.png') }}" class="h-full w-full object-cover" alt="">
                <h5 class="font-semibold text-2xl md:text-3xl">Share every type of
                    content in limitless ways</h5>
            </div>
        </div>
        <div class="testimonial-section">
            <div class="testimonials owl-carousel">
                <div class="card flex flex-col gap-y-10 items-center">
                    <div class="img">
                        <img src="{{ asset('assets/pass/images/user.png') }}"
                            class="w-[12rem] h-[12rem] md:h-[18rem] object-cover rounded-full" alt="">
                    </div>
                    <div class="w-[90%] lg:w-[60%] text-center flex flex-col gap-y-8">
                        <h5 class="font-extrabold text-3xl md:text-4xl text-[#1E2330]">“Linktree simplifies the process
                            for
                            creators to share multiple parts of
                            themselves in one inclusive link.”</h5>
                        <div class="flex flex-col gap-y-1 text-[#676B5F]">
                            <p>Riley Lemon,</p>
                            <p>Youtuber, Content Creator</p>
                        </div>
                    </div>
                </div>
                <div class="card flex flex-col gap-y-10 items-center">
                    <div class="img">
                        <img src="{{ asset('assets/pass/images/user.png') }}"
                            class="w-[12rem] h-[12rem] md:h-[18rem] object-cover rounded-full" alt="">
                    </div>
                    <div class="w-[90%] lg:w-[60%] text-center flex flex-col gap-y-8">
                        <h5 class="font-extrabold text-3xl md:text-4xl text-[#1E2330]">“Linktree simplifies the process
                            for
                            creators to share multiple parts of
                            themselves in one inclusive link.”</h5>
                        <div class="flex flex-col gap-y-1 text-[#676B5F]">
                            <p>Riley Lemon,</p>
                            <p>Youtuber, Content Creator</p>
                        </div>
                    </div>
                </div>
                <div class="card flex flex-col gap-y-10 items-center">
                    <div class="img">
                        <img src="{{ asset('assets/pass/images/user.png') }}"
                            class="w-[12rem] h-[12rem] md:h-[18rem] object-cover rounded-full" alt="">
                    </div>
                    <div class="w-[90%] lg:w-[60%] text-center flex flex-col gap-y-8">
                        <h5 class="font-extrabold text-3xl md:text-4xl text-[#1E2330]">“Linktree simplifies the process
                            for
                            creators to share multiple parts of
                            themselves in one inclusive link.”</h5>
                        <div class="flex flex-col gap-y-1 text-[#676B5F]">
                            <p>Riley Lemon,</p>
                            <p>Youtuber, Content Creator</p>
                        </div>
                    </div>
                </div>
                <div class="card flex flex-col gap-y-10 items-center">
                    <div class="img">
                        <img src="{{ asset('assets/pass/images/user.png') }}"
                            class="w-[12rem] h-[12rem] md:h-[18rem] object-cover rounded-full" alt="">
                    </div>
                    <div class="w-[90%] lg:w-[60%] text-center flex flex-col gap-y-8">
                        <h5 class="font-extrabold text-3xl md:text-4xl text-[#1E2330]">“Linktree simplifies the process
                            for
                            creators to share multiple parts of
                            themselves in one inclusive link.”</h5>
                        <div class="flex flex-col gap-y-1 text-[#676B5F]">
                            <p>Riley Lemon,</p>
                            <p>Youtuber, Content Creator</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex gap-x-4 justify-center mt-6">
                <button class="border p-2 rounded cursor-pointer" id="prevBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                    </svg>

                </button>
                <button class="border p-2 rounded cursor-pointer" id="nextBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>

                </button>
            </div>
        </div>
    </div>
    <div
        class="bg-[#780016] flex flex-col gap-y-10 items-center px-6 sm:px-14 md:px-36 lg:px-44 py-10 sm:py-14 md:py-24">
        <h5 class="text-3xl md:text-5xl text-[#E9C0E9] font-bold">FAQs</h5>
        <div class="accordion-container flex flex-col gap-y-4 w-full md:w-[90%] lg:w-[70%] mx-auto">
            <div class="accordion flex flex-col overflow-hidden bg-[#52000f] rounded-2xl text-[#E9C0E9] p-6 sm:p-10">
                <div class="flex justify-between items-center toggle-accordion cursor-pointer select-none">
                    <h2 class="text-lg font-semibold">
                        Why should podcasters use Linktree?
                    </h2>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 arrow-icon transition-transform duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div class="accordion-content">
                    <p class="mt-4">
                        The best bike for mountain biking in Nepal is typically a full-suspension mountain bike from
                        top brands like Trek, Giant, Scott, or Specialized. These bikes handle rugged trails, steep
                        climbs, and downhill rides effectively in the Himalayan terrain.
                        The best bike for mountain biking in Nepal is typically a full-suspension mountain bike from
                        top brands like Trek, Giant, Scott, or Specialized. These bikes handle rugged trails, steep
                        climbs, and downhill rides effectively in the Himalayan terrain.
                        The best bike for mountain biking in Nepal is typically a full-suspension mountain bike from
                        top brands like Trek, Giant, Scott, or Specialized. These bikes handle rugged trails, steep
                        climbs, and downhill rides effectively in the Himalayan terrain.
                    </p>
                </div>
            </div>

            <div class="accordion flex flex-col overflow-hidden bg-[#52000f] rounded-2xl text-[#E9C0E9] p-6 sm:p-10">
                <div class="flex justify-between items-center toggle-accordion cursor-pointer select-none">
                    <h2 class="text-lg font-semibold">
                        Why should podcasters use Linktree?
                    </h2>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 arrow-icon transition-transform duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div class="accordion-content">
                    <p class="mt-4">
                        The best bike for mountain biking in Nepal is typically a full-suspension mountain bike from
                        top brands like Trek, Giant, Scott, or Specialized. These bikes handle rugged trails, steep
                        climbs, and downhill rides effectively in the Himalayan terrain.
                        The best bike for mountain biking in Nepal is typically a full-suspension mountain bike from
                        top brands like Trek, Giant, Scott, or Specialized. These bikes handle rugged trails, steep
                        climbs, and downhill rides effectively in the Himalayan terrain.
                        The best bike for mountain biking in Nepal is typically a full-suspension mountain bike from
                        top brands like Trek, Giant, Scott, or Specialized. These bikes handle rugged trails, steep
                        climbs, and downhill rides effectively in the Himalayan terrain.
                    </p>
                </div>
            </div>

            <div class="accordion flex flex-col overflow-hidden bg-[#52000f] rounded-2xl text-[#E9C0E9] p-6 sm:p-10">
                <div class="flex justify-between items-center toggle-accordion cursor-pointer select-none">
                    <h2 class="text-lg font-semibold">
                        Why should podcasters use Linktree?
                    </h2>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 arrow-icon transition-transform duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div class="accordion-content">
                    <p class="mt-4">
                        The best bike for mountain biking in Nepal is typically a full-suspension mountain bike from
                        top brands like Trek, Giant, Scott, or Specialized. These bikes handle rugged trails, steep
                        climbs, and downhill rides effectively in the Himalayan terrain.
                        The best bike for mountain biking in Nepal is typically a full-suspension mountain bike from
                        top brands like Trek, Giant, Scott, or Specialized. These bikes handle rugged trails, steep
                        climbs, and downhill rides effectively in the Himalayan terrain.
                        The best bike for mountain biking in Nepal is typically a full-suspension mountain bike from
                        top brands like Trek, Giant, Scott, or Specialized. These bikes handle rugged trails, steep
                        climbs, and downhill rides effectively in the Himalayan terrain.
                    </p>
                </div>
            </div>

            <div class="accordion flex flex-col overflow-hidden bg-[#52000f] rounded-2xl text-[#E9C0E9] p-6 sm:p-10">
                <div class="flex justify-between items-center toggle-accordion cursor-pointer select-none">
                    <h2 class="text-lg font-semibold">
                        Why should podcasters use Linktree?
                    </h2>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 arrow-icon transition-transform duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div class="accordion-content">
                    <p class="mt-4">
                        The best bike for mountain biking in Nepal is typically a full-suspension mountain bike from
                        top brands like Trek, Giant, Scott, or Specialized. These bikes handle rugged trails, steep
                        climbs, and downhill rides effectively in the Himalayan terrain.
                        The best bike for mountain biking in Nepal is typically a full-suspension mountain bike from
                        top brands like Trek, Giant, Scott, or Specialized. These bikes handle rugged trails, steep
                        climbs, and downhill rides effectively in the Himalayan terrain.
                        The best bike for mountain biking in Nepal is typically a full-suspension mountain bike from
                        top brands like Trek, Giant, Scott, or Specialized. These bikes handle rugged trails, steep
                        climbs, and downhill rides effectively in the Himalayan terrain.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>