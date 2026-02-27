<div class="bg-white md:bg-[#F3E4E4] py-8 md:py-18 flex flex-col gap-y-8">
    <livewire:pass.navbar />
    <livewire:pass.topcard />

    <div class="handles grid grid-cols-1 lg:grid-cols-2 gap-6 px-6 sm:px-16 lg:px-24 xl:px-44">
        <div class="flex flex-col gap-y-6">
            <div class="bg-white md:bg-[#fbf3f3] rounded-lg flex flex-col gap-y-6 p-0 md:p-8">

                <div class="flex justify-between">
                    <h5 class="font-bold text-2xl">My Profile</h5>
                    <a href="{{ route('pass.dashboard') }}">
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
                        Upload your CV
                    </h3>


                    @if ($uploadStatus)
                    <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ $uploadStatus }}
                    </div>
                    @endif

                    @error('cv')
                    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ $message }}
                    </div>
                    @enderror

                    @if ($currentCvPath)
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-800">Current CV</p>
                                <a href="{{ asset('storage/' . $currentCvPath) }}" target="_blank"
                                    class="text-purple-600 hover:underline text-sm">
                                    View / Download
                                </a>
                            </div>

                            <button wire:click="removeCv" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                Remove
                            </button>
                        </div>
                    </div>
                    @endif


                    <!-- FORM START -->
                    <form wire:submit.prevent="save" class="mt-6">

                        <div x-data="{ uploading: false, progress: 0 }"
                            x-on:livewire-upload-start="uploading = true; progress = 0"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <!-- Hidden File Input -->
                            <input type="file" wire:model="cv" id="cvUpload" class="hidden" accept=".pdf,.doc,.docx">

                            <!-- Styled Label -->
                            <label for="cvUpload" class="flex items-center justify-between bg-[#F7FAFC]
                                       border {{ $errors->has('cv') ? 'border-red-500' : 'border-[#CBD5E0]' }}
                                       cursor-pointer px-5 py-4 rounded-lg hover:bg-gray-50 transition"
                                :class="{ 'opacity-60 cursor-not-allowed': uploading }">

                                <span class="text-gray-700 font-medium">
                                    {{ $cv ? $cv->getClientOriginalName() : 'Choose CV file (PDF, DOC, DOCX)' }}
                                </span>

                                <span class="text-purple-600 font-medium"
                                    x-text="uploading ? 'Uploading...' : 'Browse'">
                                </span>
                            </label>

                            <!-- Progress Bar -->
                            <div x-show="uploading" class="mt-4">
                                <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                                    <div class="bg-gradient-to-r from-purple-600 to-pink-500
                                                h-2.5 rounded-full transition-all duration-300"
                                        :style="'width: ' + progress + '%'">
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">
                                    Uploading...
                                    <strong x-text="progress + '%'"></strong>
                                </p>
                            </div>

                            <!-- Save Button -->
                            <button type="submit" class="mt-6 text-white rounded-lg cursor-pointer
                                       bg-gradient-to-r from-purple-600 to-pink-500
                                       hover:opacity-90 transition w-full py-3" wire:loading.attr="disabled">

                                <span wire:loading.remove wire:target="save">
                                    Save
                                </span>

                                <span wire:loading wire:target="save">
                                    Saving...
                                </span>
                            </button>

                        </div>
                    </form>
                    <!-- FORM END -->

                </div>
            </div>
        </div>

        <livewire:pass.side-img />
    </div>
</div>