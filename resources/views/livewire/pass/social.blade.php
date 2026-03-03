<div class="bg-white md:bg-[#F3E4E4] py-8 md:py-18 flex flex-col gap-y-8">
    <livewire:pass.navbar />
    <livewire:pass.topcard />



    <div class="handles grid grid-cols-1 lg:grid-cols-2 gap-6 px-6 sm:px-16 lg:px-24 xl:px-44">
        <div class="flex flex-col gap-y-6">
            <div class="bg-white md:bg-[#fbf3f3] rounded-lg flex flex-col gap-y-6 p-0 md:p-8">
                <div class="flex justify-between">
                    <h5 class="font-bold text-2xl">My Profile</h5>
                    <a href="{{route('pass.dashboard')}}">
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
                        Add Your Social Links
                    </h3>

                    <!-- Form Fields -->
                    <div class="mt-10 space-y-6">

                        @if (session('status'))
                        <div class="p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                            {{ session('status') }}
                        </div>
                        @endif

                        @error('links.*')
                        <div class="p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="space-y-8">
                            @foreach ($links as $index => $link)
                            <div class="flex flex-col gap-y-4 border-b pb-6 last:border-b-0">
                                <label class="block text-sm text-gray-600">
                                    Link {{ $index + 1 }}
                                </label>

                                <!-- Platform Name -->
                                <div class="relative">
                                    <input type="text" wire:model.live="links.{{ $index }}.name"
                                        placeholder="Social Media (e.g. Instagram, Twitter, LinkedIn)"
                                        class="w-full bg-[#F7FAFC] border {{ $errors->has(" links.$index.name")
                                        ? 'border-red-500' : 'border-[#CBD5E0]' }} rounded-lg px-4 py-3 pr-10
                                        placeholder:text-gray-500 focus:outline-none focus:ring-2
                                        focus:ring-purple-500">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </span>
                                    @error("links.$index.name") <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- URL -->
                                <div class="relative">
                                    <input type="url" wire:model.live="links.{{ $index }}.url"
                                        placeholder="https://www.instagram.com/yourusername"
                                        class="w-full bg-[#F7FAFC] border {{ $errors->has(" links.$index.url")
                                        ? 'border-red-500' : 'border-[#CBD5E0]' }} rounded-lg px-4 py-3 pr-10
                                        placeholder:text-gray-500 focus:outline-none focus:ring-2
                                        focus:ring-purple-500">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </span>
                                    @error("links.$index.url") <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Remove button (hide on first row if you want minimum 1) -->
                                @if (count($links) > 1)
                                <button type="button" wire:click="removeLink({{ $index }})"
                                    class="self-start cursor-pointer text-red-600 hover:text-red-800 text-sm font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Remove this link
                                </button>
                                @endif
                            </div>
                            @endforeach
                        </div>

                        <!-- Add more link -->
                        <span class="text-[#718096] text-sm sm:text-base">Do you want to add more? <button type="button"
                                wire:click="addLink" class="underline text-[#E65847] cursor-pointer">Add Another
                                Link</button></span>


                        <!-- Save Button -->
                        <button type="button" wire:click="saveLinks" class="mt-8 text-white rounded-lg bg-gradient-to-r from-purple-600 to-pink-500 
           hover:opacity-90 transition w-full cursor-pointer py-3 font-medium
           disabled:opacity-70 disabled:cursor-not-allowed" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="saveLinks">
                                Save
                            </span>

                            <span wire:loading wire:target="saveLinks" class="flex items-center justify-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Saving...
                            </span>
                        </button>
                    </div>
                </div>

            </div>

        </div>
        <livewire:pass.side-img />
    </div>
</div>