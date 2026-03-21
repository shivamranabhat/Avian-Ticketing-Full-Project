<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Create Partner</div>
            <a href="{{ route('partner.index') }}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
        </div>

        <form class="card-body" wire:submit="save" enctype="multipart/form-data">
            <div class="row g-3">

           
                <!-- Main Image + Alt Text -->
                <div class="col-md-6">
                    <label class="form-label">Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" wire:model="image" accept="image/*">
                    @error('image') <span class="text-danger fs-12 d-block mt-1">{{ $message }}</span> @enderror

                    @if($image)
                    <div class="mt-3">
                        <img src="{{ $image->temporaryUrl() }}" alt="Image preview"
                             style="max-width:220px; max-height:180px; object-fit:cover; border-radius:8px; border:1px solid #dee2e6;">
                    </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <label class="form-label">Image Alt Text (SEO)</label>
                    <input type="text" class="form-control" wire:model="img_alt">
                    @error('img_alt') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>

            </div>

            <div class="border-top px-4 py-3 mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('partner.index') }}" class="btn btn-secondary">Cancel</a>
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