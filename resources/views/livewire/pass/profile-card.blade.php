<div class="flex items-center gap-4">

    <!-- Avatar -->
    <!-- PROFILE AVATAR WITH CAMERA DROPDOWN -->
    <div class="relative" x-data="{ open: false }">
        <img src="{{ auth()->user()->details && auth()->user()->details->profile_pic 
            ? asset('storage/' . auth()->user()->details->profile_pic) 
            : asset('assets/pass/images/blank-user.png') }}" alt="Profile"
            class="w-20 h-20 rounded-full object-cover shadow-md">

        <!-- Camera Button -->
        <button @click="open = !open"
            class="absolute bottom-0 right-0 bg-white rounded-full p-1 shadow-md hover:shadow-lg hover:bg-gray-50 transition-all duration-200 cursor-pointer focus:outline-none"
            aria-label="Change pictures">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                stroke="currentColor" class="size-4 text-gray-700">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
            </svg>
        </button>

        <!-- Dropdown Menu -->
        <div x-show="open" @click.away="open = false" x-transition
            class="absolute right-[-8rem] md:right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl py-2 z-50 text-sm border border-gray-100"
            style="transform-origin: top right;">
            <div class="px-4 py-2 text-xs font-semibold text-gray-500 tracking-widest border-b">CHANGE PICTURE</div>

            <!-- Profile Picture -->
            <button @click="open = false; $nextTick(() => document.getElementById('profile-pic-upload').click())"
                class="w-full px-5 py-3 flex items-center gap-3 hover:bg-gray-50 text-left transition-colors cursor-pointer">
                <div class="w-8 h-8 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-5 text-purple-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975M12 3a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" />
                    </svg>
                </div>
                <span class="font-medium text-gray-700">Profile Picture</span>
            </button>

            <!-- Cover Picture -->
            <button @click="open = false; $nextTick(() => document.getElementById('cover-pic-upload').click())"
                class="w-full px-5 py-3 flex items-center gap-3 hover:bg-gray-50 text-left transition-colors cursor-pointer">
                <div class="w-8 h-8 bg-pink-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-5 text-pink-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 8.25V18a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V8.25m-18 0h18M3 8.25l6-6 6 6" />
                    </svg>
                </div>
                <span class="font-medium text-gray-700">Cover Picture</span>
            </button>

            <!-- Side Picture -->
            <button @click="open = false; $nextTick(() => document.getElementById('side-pic-upload').click())"
                class="w-full px-5 py-3 flex items-center gap-3 hover:bg-gray-50 text-left transition-colors cursor-pointer">
                <div class="w-8 h-8 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-5 text-amber-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v-9a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v9m-18 0h18" />
                    </svg>
                </div>
                <span class="font-medium text-gray-700">Side Picture</span>
            </button>
        </div>
    </div>

    <!-- HIDDEN FILE INPUTS (place anywhere in your dashboard.blade.php, e.g. at the bottom) -->
    <input id="profile-pic-upload" type="file" wire:model="profilePic" class="hidden" accept="image/*">
    <input id="cover-pic-upload" type="file" wire:model="coverPic" class="hidden" accept="image/*">
    <input id="side-pic-upload" type="file" wire:model="sidePic" class="hidden" accept="image/*">

    <!-- Name + Email + Button -->
    <div>
        <h2 class="text-2xl font-semibold text-gray-900">
            {{auth()->user()->name ?? 'XXXXXXX'}}
        </h2>
        <p class="text-gray-600 text-base">
            {{auth()->user()->email}}
        </p>
    </div>
</div>