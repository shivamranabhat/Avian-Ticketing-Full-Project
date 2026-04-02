<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Create OpenGraph</div>
            <a href="{{ route('graph.index') }}" class="btn btn-primary btn-sm">
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
                    @error('page_id') <span class="text-danger">Please select a page.</span> @enderror
                </div>

                <!-- Tag Name -->
                <div class="col-12">
                    <label class="form-label">Tag Name</label>
                    <input class="form-control" wire:model.defer="tag_name" />  
                    @error('tag_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Title -->
                <div class="col-12">
                    <label class="form-label">Title</label>
                    <input class="form-control" wire:model.defer="title" />  
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
              
                <!--  Description -->
                <div class="col-12">
                    <label class="form-label"> Description</label>
                    <textarea class="form-control" wire:model.defer="description"></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Image -->
                <div class="col-12" x-data="{
                    previewUrl: null,
                    fileName: '',
                    init() {
                        this.$watch('$wire.image', (value) => {
                            if (!value) {
                                this.previewUrl = null;
                                this.fileName = '';
                            }
                        });
                    }
                }">
                    <label class="form-label">Image</label>

                    <input type="file" class="form-control" wire:model.live="image" accept="image/*" @change="
                        if ($event.target.files[0]) {
                            previewUrl = URL.createObjectURL($event.target.files[0]);
                            fileName = $event.target.files[0].name;
                        }
                    ">

                    <div class="mt-3" x-show="previewUrl" x-transition>
                        <img :src="previewUrl" alt="Preview" class="img-fluid rounded border shadow-sm"
                            style="max-height: 240px; object-fit: contain; background: #f8f9fa;">
                        

                    @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Url -->
                <div class="col-12 mt-3">
                    <label class="form-label">Url</label>
                    <input class="form-control" wire:model.defer="url" />
                    @error('url') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- type -->
                <div class="col-12 mt-3">
                    <label class="form-label">Type</label>
                    <input class="form-control" wire:model.defer="type" />
                    @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Site name -->
                <div class="col-12 mt-3">
                    <label class="form-label">Site Name</label>
                    <input class="form-control" wire:model.defer="site_name" />
                    @error('site_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

            </div>

            <div class="border-top px-4 py-4 mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('tag.index') }}" class="btn btn-secondary">
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