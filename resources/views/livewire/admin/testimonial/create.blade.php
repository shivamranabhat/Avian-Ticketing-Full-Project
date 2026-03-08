<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Create New Testimonial</div>
            <a href="{{ route('testimonial.index') }}" class="btn btn-primary btn-sm">
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

                <!-- Name -->
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input class="form-control" wire:model.defer="name" />
                </div>

                <!-- Role -->
                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <input type="text" class="form-control" wire:model.defer="role">
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


                <!-- Description -->
                <div class="col-12 mt-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" wire:model.defer="description"></textarea>
                </div>

            </div>

            <div class="border-top px-4 py-4 mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('testimonial.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </form>
    </div>
</div>