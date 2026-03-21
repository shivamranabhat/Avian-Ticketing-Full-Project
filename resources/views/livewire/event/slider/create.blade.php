<div class="col-xl-12">
    <div class="card custom-card">

        <div class="card-header justify-content-between">
            <div class="card-title">Create Slider</div>
            <a href="{{ route('slider.index') }}" class="btn btn-primary btn-sm">← Back</a>
        </div>

        <form class="card-body" wire:submit.prevent="save" enctype="multipart/form-data">

            <div class="row g-3">

                <!-- Title -->
                <div class="col-md-6">
                    <label>Title </label>
                    <input type="text" class="form-control" wire:model="title">
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Subtitle -->
                <div class="col-md-6">
                    <label>Subtitle</label>
                    <input type="text" class="form-control" wire:model="subtitle">
                </div>

                <!-- Image -->
                <div class="col-md-6">
                    <label>Image </label>
                    <input type="file" class="form-control" wire:model="image">
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror

                    @if($image)
                    <img src="{{ $image->temporaryUrl() }}" width="150" class="mt-2">
                    @endif
                </div>

                <!-- Alt -->
                <div class="col-md-6">
                    <label>Image Alt</label>
                    <input type="text" class="form-control" wire:model="img_alt">
                </div>

                <!-- Left Button -->
                <div class="col-md-6">
                    <label>Left Button Text</label>
                    <input type="text" class="form-control" wire:model="left_btn_txt">
                </div>

                <div class="col-md-6">
                    <label>Left Button Link</label>
                    <input type="text" class="form-control" wire:model="left_btn_link">
                </div>

                <!-- Right Button -->
                <div class="col-md-6">
                    <label>Right Button Text</label>
                    <input type="text" class="form-control" wire:model="right_btn_txt">
                </div>

                <div class="col-md-6">
                    <label>Right Button Link</label>
                    <input type="text" class="form-control" wire:model="right_btn_link">
                </div>

                <!-- Price -->
                <div class="col-md-6">
                    <label>Starting Price</label>
                    <input type="text" class="form-control" wire:model="starting_price">
                </div>

            </div>

            <!-- 🔥 Slider Features -->
            <div class="col-12 mt-4">
                <h5>Slider Features</h5>

                <div class="row mb-3 align-items-center">
                    <div class="col-auto">
                        <label class="form-label">Number of Items</label>
                    </div>
                    <div class="col-6">
                        <input type="number" min="0" class="form-control w-20" wire:model.live="listCount">
                    </div>
                </div>

                @if($listCount > 0)
                @foreach(range(0, $listCount - 1) as $index)
                <div class="border rounded p-3 mb-3 bg-light">
                    <div class="row g-3">

                        <!-- Title -->
                        <div class="col-md-6">
                            <label>Title {{ $index + 1 }}</label>
                            <input type="text" class="form-control" wire:model="lists.{{ $index }}.title">

                            @error("lists.{$index}.title")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div class="col-md-6">
                            <label>Icon Image</label>
                            <input type="file" class="form-control" wire:model="lists.{{ $index }}.icon">

                            <!-- ✅ Preview -->
                            <div class="mt-2">
                                @if(isset($lists[$index]['icon']) && $lists[$index]['icon'] instanceof
                                \Livewire\TemporaryUploadedFile)

                                @php
                                $mime = $lists[$index]['icon']->getMimeType();
                                @endphp

                                @if(str_contains($mime, 'svg'))
                                <span class="text-muted">SVG selected (preview not supported)</span>
                                @else
                                <img src="{{ $lists[$index]['icon']->temporaryUrl() }}" width="80"
                                    class="rounded border">
                                @endif

                                @endif
                            </div>

                            @error("lists.{$index}.icon")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <!-- Footer -->
            <div class="border-top px-4 py-3 mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('slider.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary d-flex align-items-center gap-1"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">Save</span>
                    <span wire:loading wire:target="save">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span>Saving…</span>
                    </span>
                </button>
            </div>

        </form>
    </div>
</div>