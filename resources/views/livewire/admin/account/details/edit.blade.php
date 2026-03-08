<div class="col-xl-12">
    <div class="card custom-card">

        <div class="card-header justify-content-between">
            <div class="card-title">
                Edit Details — {{ $details->user->name }}
            </div>

            <a href="{{ route('account.details.index') }}" class="btn btn-sm btn-secondary">
                Back
            </a>
        </div>

        <form wire:submit.prevent="update" enctype="multipart/form-data" class="card-body">

            <div class="row g-3">

                <!-- User (readonly) -->
                <div class="col-md-6">
                    <label class="form-label">User</label>
                    <input type="text" class="form-control"
                        value="{{ $details->user->name }} ({{ $details->user->email }})" disabled>
                </div>

                <!-- Bio -->
                <div class="col-12">
                    <label class="form-label">Bio</label>
                    <textarea class="form-control" wire:model.defer="bio"></textarea>
                </div>

                <!-- Location -->
                <div class="col-md-6">
                    <label class="form-label">Location</label>
                    <input type="text" class="form-control" wire:model.defer="location">
                </div>
                <!-- Extra Details -->
                <div class="col-md-6">
                    <label class="form-label">Extra Description</label>
                    <input type="text" class="form-control" wire:model.defer="extra_details">
                </div>

                <!-- Profile Pic -->
                <div class="col-md-6">
                    <label class="form-label">Profile Picture</label>

                    @if($existing_profile_pic)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$existing_profile_pic) }}" width="60" class="rounded">
                    </div>
                    @endif

                    <input type="file" class="form-control" wire:model="profile_pic">
                </div>

                <!-- Cover Pic -->
                <div class="col-md-6">
                    <label class="form-label">Cover Picture</label>

                    @if($existing_cover_pic)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$existing_cover_pic) }}" width="60" class="rounded">
                    </div>
                    @endif

                    <input type="file" class="form-control" wire:model="cover_pic">
                </div>

                <!-- Side Pic -->
                <div class="col-md-6">
                    <label class="form-label">Side Picture</label>

                    @if($existing_side_pic)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$existing_side_pic) }}" width="60" class="rounded">
                    </div>
                    @endif

                    <input type="file" class="form-control" wire:model="side_pic">
                </div>

                <!-- CV -->
                <div class="col-md-6">
                    <label class="form-label">CV</label>

                    @if($existing_cv)
                    <div class="mb-2">
                        <a href="{{ asset('storage/'.$existing_cv) }}" target="_blank"
                            class="btn btn-sm btn-outline-primary">
                            View Current CV
                        </a>
                    </div>
                    @endif

                    <input type="file" class="form-control" wire:model="cv">
                </div>

            </div>

            <div class="border-top mt-4 pt-3 text-end">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Update</span>
                    <span wire:loading>Updating...</span>
                </button>
            </div>

        </form>
    </div>
</div>