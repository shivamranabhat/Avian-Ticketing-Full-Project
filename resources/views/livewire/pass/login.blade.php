<div class="bg-white md:bg-[#F3E4E4] min-h-screen py-8 md:py-18 flex flex-col gap-y-8">

    <livewire:pass.navbar />

    <div class="handles px-6 sm:px-16 lg:px-24 xl:px-44 flex flex-col gap-y-2 mt-10 w-full sm:w-[80%] md:w-[70%] lg:w-[60%] mx-auto">

        <h1 class="text-4xl font-bold">Welcome to your Digital Card.</h1>

        <div class="form">

            <!-- Section Title -->
            <h3 class="mt-10 text-3xl font-bold text-gray-800 mb-2">
                Sign in
            </h3>

            <span class="text-primary">
                Don't have an account?
                <a href="#" class="underline text-orange-600 hover:text-orange-700">
                    Create now
                </a>
            </span>

            <!-- Flash / General Error -->
            @if (session('status'))
                <div class="mt-4 p-3 bg-green-100 text-green-800 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            @if ($message)
                <div class="mt-4 p-3 bg-red-100 text-red-800 rounded-lg">
                    {{ $message }}
                </div>
            @endif

            <!-- Form -->
            <form wire:submit="login" class="mt-6 space-y-6">

                <!-- Email Address -->
                <div>
                    <label class="block text-sm text-gray-600 mb-2">
                        Email Address
                    </label>
                    <input type="email"
                           wire:model.live.debounce.500ms="email"
                           placeholder="someone@gmail.com"
                           class="w-full bg-[#F7FAFC] border {{ $errors->has('email') ? 'border-red-500' : 'border-[#CBD5E0]' }} rounded-lg px-4 py-3 placeholder:text-primary focus:outline-none focus:ring-2 focus:ring-purple-400 transition"
                           autocomplete="email">

                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm text-gray-600 mb-2">
                        Password
                    </label>
                    <input type="password"
                           wire:model.live="password"
                           placeholder="@#$%^Z&"
                           class="w-full bg-[#F7FAFC] border {{ $errors->has('password') ? 'border-red-500' : 'border-[#CBD5E0]' }} rounded-lg px-4 py-3 placeholder:text-primary focus:outline-none focus:ring-2 focus:ring-purple-400 transition"
                           autocomplete="current-password">

                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" wire:model="remember" id="remember"
                           class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Remember me
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        wire:loading.attr="disabled"
                        class="text-white flex items-center gap-x-4 rounded-lg bg-gradient-to-r from-purple-600 to-pink-500 hover:opacity-90 transition w-full cursor-pointer py-3 font-medium justify-center">

                    <span wire:loading.remove wire:target="login">Sign In</span>

                    <span class="flex items-center gap-x-4" wire:loading wire:target="login">
                        <svg class="animate-spin h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Signing in...
                    </span>
                </button>

            </form>

            <!-- Forgot Password Link (optional) -->
            <div class="mt-4 text-center text-sm text-gray-600">
                <a href="#" class="text-orange-600 hover:underline">
                    Forgot your password?
                </a>
            </div>

        </div>
    </div>
</div>