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

                    <!-- Profile Header -->
                    <livewire:pass.profile-card />

                    <!-- Section Title -->
                    <h3 class="mt-10 text-lg font-semibold text-gray-800">
                        Set New Password
                    </h3>

                    <!-- Form Fields -->
                    <div class="mt-6 space-y-6">

                        <!-- Show success / error messages -->
                        @if (session('status'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('status') }}</span>
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- PASSWORD CHANGE FORM -->
                        <form wire:submit.prevent="updatePassword" class="space-y-6" x-data="{ 
          showCurrent: false, 
          showNew: false, 
          showConfirm: false 
      }">

                            <!-- Current Password -->
                            <div class="relative">
                                <input :type="showCurrent ? 'text' : 'password'" wire:model.live="current_password"
                                    placeholder="Current Password"
                                    class="w-full bg-[#F7FAFC] border {{ $errors->has('current_password') ? 'border-red-500' : 'border-[#CBD5E0]' }} rounded-lg px-4 py-3 pr-10 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <button type="button" @click="showCurrent = !showCurrent"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none"
                                    aria-label="Toggle current password visibility">
                                    <!-- Eye (closed = hidden) -->
                                    <svg x-show="!showCurrent" class="size-5 cursor-pointer" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>

                                    <!-- Eye-slash (open = visible) -->
                                    <svg x-show="showCurrent" class="size-5 cursor-pointer" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                                @error('current_password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="relative">
                                <input :type="showNew ? 'text' : 'password'" wire:model.live="password"
                                    placeholder="New Password"
                                    class="w-full bg-[#F7FAFC] border {{ $errors->has('password') ? 'border-red-500' : 'border-[#CBD5E0]' }} rounded-lg px-4 py-3 pr-10 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <button type="button" @click="showNew = !showNew"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none"
                                    aria-label="Toggle new password visibility">
                                    <svg x-show="!showNew" class="size-5 cursor-pointer" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <svg x-show="showNew" class="size-5 cursor-pointer" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                                @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div class="relative">
                                <input :type="showConfirm ? 'text' : 'password'" wire:model.live="password_confirmation"
                                    placeholder="Confirm New Password"
                                    class="w-full bg-[#F7FAFC] border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-[#CBD5E0]' }} rounded-lg px-4 py-3 pr-10 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <button type="button" @click="showConfirm = !showConfirm"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none"
                                    aria-label="Toggle confirm password visibility">
                                    <svg x-show="!showConfirm" class="size-5 cursor-pointer" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <svg x-show="showConfirm" class="size-5 cursor-pointer" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                                @error('password_confirmation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="text-white rounded-lg bg-gradient-to-r from-purple-600 to-pink-500 hover:opacity-90 transition w-full cursor-pointer py-3 font-medium">
                                Save Password
                            </button>
                        </form>

                    </div>
                </div>

            </div>

        </div>
        <livewire:pass.side-img />
    </div>
</div>