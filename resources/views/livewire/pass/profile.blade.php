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
                <div class="form">

                    <livewire:pass.profile-card />

                    <!-- Section Title -->
                    <h3 class="mt-10 text-lg font-semibold text-gray-800">
                        Edit Your Personal Information
                    </h3>

                    <form wire:submit.prevent="save">

                        <div class="mt-6 space-y-6">

                            <!-- Display Bio -->
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">Display Bio</label>
                                <input type="text" wire:model="bio"
                                    class="w-full bg-[#F7FAFC] border border-[#CBD5E0] rounded-lg px-4 py-3 text-gray-700 focus:outline-none">

                                @error('bio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Full Name -->
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">Full Name</label>
                                <input type="text" wire:model="name"
                                    class="w-full bg-[#F7FAFC] border border-[#CBD5E0] rounded-lg px-4 py-3 text-gray-700 focus:outline-none">

                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">Email Address</label>
                                <input type="email" wire:model="email"
                                    class="w-full bg-[#F7FAFC] border border-[#CBD5E0] rounded-lg px-4 py-3 text-gray-700 focus:outline-none">

                                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">Phone Number</label>
                                <input type="text" wire:model="phone"
                                    class="w-full bg-[#F7FAFC] border border-[#CBD5E0] rounded-lg px-4 py-3 text-gray-700 focus:outline-none">

                                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Address -->
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">Address</label>
                                <input type="text" wire:model="location"
                                    class="w-full bg-[#F7FAFC] border border-[#CBD5E0] rounded-lg px-4 py-3 text-gray-700 focus:outline-none">

                                @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" wire:loading.attr="disabled" wire:target="save" class="text-white flex items-center gap-x-4 rounded-lg 
           bg-gradient-to-r from-purple-600 to-pink-500 
           hover:opacity-90 transition w-full cursor-pointer 
           py-3 font-medium justify-center">

                                <!-- Normal State -->
                                <span wire:loading.remove wire:target="save">
                                    Save
                                </span>

                                <!-- Loading State -->
                                <span wire:loading wire:target="save"
                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap">

                                    <svg class="animate-spin h-5 w-5 text-white shrink-0 inline"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>

                                    <span>Saving...</span>
                                </span>

                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <livewire:pass.side-img />
    </div>
</div>