<div class="bg-white md:bg-[#F3E4E4] py-8 md:py-18 flex flex-col gap-y-8">
    <livewire:pass.navbar />
    <livewire:pass.topcard />

   
    <div class="handles grid grid-cols-1 lg:grid-cols-2 gap-6 px-6 sm:px-16 lg:px-24 xl:px-44">
        <div class="flex flex-col gap-y-6">
            <div class="bg-white md:bg-[#fbf3f3] rounded-lg flex flex-col gap-y-6 p-0 md:p-8">
                <div class="flex justify-between">
                    <h5 class="font-bold text-2xl">My Profile</h5>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="size-7 bg-gradient-to-b from-[#C22C9F] to-[#AA02FF] text-white rounded-full">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </a>
                </div>
                <div class="flex flex-col gap-y-12">

                    <!-- Profile Header -->
                  <livewire:pass.profile-card />

                    <div class="flex flex-col gap-y-6 w-full sm:w-[90%] md:w-[80%]">
                        <div
                            class="flex justify-between items-center text-md hover:bg-gradient-to-b hover:from-[#C22C9F] hover:text-white hover:to-[#AA02FF] rounded-lg px-1 py-3 cursor-pointer">
                            <a href="{{route('pass.profile')}}" class="flex gap-x-10 items-center text-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                Edit Personal Details
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                        <div
                            class="flex justify-between items-center text-md hover:bg-gradient-to-b hover:from-[#C22C9F] hover:text-white hover:to-[#AA02FF] rounded-lg px-1 py-3 cursor-pointer">
                            <a href="{{route('pass.social')}}" class="flex gap-x-10 items-center text-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                </svg>
                                Add Social Link
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>

                        </div>
                        <div class="h-px w-full bg-[#CBCBCB]"></div>
                        <div
                            class="flex justify-between items-center text-md hover:bg-gradient-to-b hover:from-[#C22C9F] hover:text-white hover:to-[#AA02FF] rounded-lg px-1 py-3 cursor-pointer">
                            <a href="{{route('pass.cv')}}" class="flex gap-x-10 items-center text-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>

                                Upload Your CV
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>

                        </div>
                        <div
                            class="flex justify-between items-center text-md hover:bg-gradient-to-b hover:from-[#C22C9F] hover:text-white hover:to-[#AA02FF] rounded-lg px-1 py-3 cursor-pointer">
                            <a href="{{route('pass.business')}}" class="flex gap-x-10 items-center text-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                </svg>

                                Add Business Websites
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>

                        </div>
                        <div class="h-px w-full bg-[#CBCBCB]"></div>
                        <div
                            class="flex justify-between items-center text-md hover:bg-gradient-to-b hover:from-[#C22C9F] hover:text-white hover:to-[#AA02FF] rounded-lg px-1 py-3 cursor-pointer">
                            <a href="{{route('pass.reset')}}" class="flex gap-x-10 items-center text-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>

                                Change Password
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>

                        </div>
                        <div
                            class="flex justify-between items-center text-md hover:bg-gradient-to-b hover:from-[#C22C9F] hover:text-white hover:to-[#AA02FF] rounded-lg px-1 py-3 cursor-pointer">
                            <div class="flex gap-x-10 items-center text-md" wire:click='logout'>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>

                                Logout
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <livewire:pass.side-img />
    </div>
</div>