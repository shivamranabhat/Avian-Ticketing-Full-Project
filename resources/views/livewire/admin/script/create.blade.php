<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Create Script</div>
            <a href="{{ route('script.index') }}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
                Back
            </a>
        </div>

        <form class="card-body" wire:submit.prevent="save" enctype="multipart/form-data">

            <div class="row g-3">
                <!-- Page -->
                <div class="col-12">
                    <label class="form-label">Page</label>
                   <select class="form-control" wire:model.defer="page_id">
                        <option value="">Select Page</option>
                        @forelse($pages as $page)
                            <option value="{{ $page->id }}">{{ $page->name }}</option>
                        @empty
                            <option value="" disabled>No pages available</option>
                        @endforelse
                    </select>
                    @error('page_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Title -->
                <div class="col-12">
                    <label class="form-label">Title</label>
                    <input class="form-control" wire:model.defer="title" />  
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <!-- Position -->
                <div class="col-12">
                    <label class="form-label">Position</label>
                    <select class="form-control" wire:model.defer="position">
                        <option value="">Select Position</option>
                        <option value="header">Header</option>
                        <option value="footer">Footer</option>
                    </select>
                    @error('position') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <!-- Script -->
                <div class="col-12">
                    <label class="form-label">Script</label>
                    <textarea class="form-control" wire:model.defer="code"></textarea>
                    @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="border-top px-4 py-4 mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('script.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

                <button type="submit" 
                        class="btn btn-primary d-flex align-items-center gap-2"
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