<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Content</div>
            <a href="{{ route('content.index') }}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
                Back
            </a>
        </div>

        <form class="card-body" wire:submit.prevent="save">

            <div class="row g-3">
                <!-- Page -->
                <div class="col-12">
                    <label class="form-label">Position</label>
                    <select class="form-control" wire:model.live="position">
                        <option value="">Select Position</option>
                        <option value="Header">Header Banner</option>
                        <option value="Footer">Footer</option>
                        <option value="Rspv">Rspv</option>
                    </select>
                    @error('position') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @if($position === 'Header')
                <div class="col-12">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" wire:model="title" placeholder="Enter title">
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Subtitle</label>
                    <input type="text" class="form-control" wire:model="subtitle" placeholder="Enter subtitle">
                    @error('subtitle') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Button Text</label>
                    <input type="text" class="form-control" wire:model="btn_txt" placeholder="Enter button text">
                    @error('btn_txt') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Button Link</label>
                    <input type="text" class="form-control" wire:model="btn_link" placeholder="Enter button link">
                    @error('btn_link') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @endif
                @if($position === 'Footer')
                <div class="col-12">
                    <label class="form-label">Content</label>
                    <textarea class="form-control" wire:model="content" placeholder="Enter content"></textarea>
                    @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @endif
                @if($position === 'Rsvp')
                <div class="col-12">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" wire:model="title" placeholder="Enter title">
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Whatsapp Link</label>
                    <input type="text" class="form-control" wire:model="btn_link" placeholder="Enter whatsapp link">
                    @error('btn_link') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Whatsapp Number</label>
                    <input type="text" class="form-control" wire:model="whatsapp_number"
                        placeholder="Enter whatsapp number">
                    @error('whatsapp_number') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @endif

            </div>

            <div class="border-top px-4 py-4 mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('content.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary d-flex align-items-center gap-2"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">
                        <i class="bi bi-save"></i> Save
                    </span>
                    <span wire:loading wire:target="save">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Saving...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>