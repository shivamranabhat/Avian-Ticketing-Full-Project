<div class="col-xl-12">
    <div class="card custom-card">

        <div class="card-header justify-content-between">
            <div class="card-title">Edit Slider</div>
            <a href="{{ route('slider.index') }}" class="btn btn-primary btn-sm">← Back</a>
        </div>

        <form class="card-body" wire:submit.prevent="save" enctype="multipart/form-data">

            <div class="row g-3">

                <!-- Title -->
                <div class="col-md-6">
                    <label>Title </label>
                    <input type="text" class="form-control" wire:model="title">
                </div>

                <!-- Subtitle -->
                <div class="col-md-6">
                    <label>Subtitle</label>
                    <input type="text" class="form-control" wire:model="subtitle">
                </div>

                <!-- Image -->
                <div class="col-md-6">
                    <label>Image</label>
                    <input type="file" class="form-control" wire:model="image">

                    @if($image)
                    <img src="{{ $image->temporaryUrl() }}" width="150" class="mt-2">
                    @elseif($oldImage)
                    <img src="{{ asset('storage/'.$oldImage) }}" width="150" class="mt-2">
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



            </div>

            <!-- 🔥 Slider List -->
            <div class="col-12 mt-4">
                <h5>Slider Features</h5>

                <input type="number" min="0" class="form-control mb-3 w-25" wire:model.live="listCount">

                @if($listCount > 0)
                @foreach(range(0, $listCount - 1) as $index)
                <div class="border rounded p-3 mb-3 bg-light">
                    <div class="row g-3">

                        <!-- Title -->
                        <div class="col-md-6">
                            <label>Title {{ $index + 1 }}</label>
                            <input type="text" class="form-control" wire:model="lists.{{ $index }}.title">

                            @error("lists.$index.title")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Icon Image -->
                        <div class="col-md-6">
                            <label>Icon Image</label>
                            <input type="file" class="form-control" wire:model="lists.{{ $index }}.icon">

                            @error("lists.$index.icon")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <!-- Preview -->
                            <div class="mt-2">
                                @if(isset($lists[$index]['icon']) && is_object($lists[$index]['icon']))
                                {{-- New uploaded image --}}
                                <img src="{{ $lists[$index]['icon']->temporaryUrl() }}" width="80"
                                    class="rounded border">
                                @elseif(isset($lists[$index]['icon']) && is_string($lists[$index]['icon']))
                                {{-- Existing image (edit mode) --}}
                                <img src="{{ asset('storage/'.$lists[$index]['icon']) }}" width="80"
                                    class="rounded border">
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
                @endif
            </div>

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