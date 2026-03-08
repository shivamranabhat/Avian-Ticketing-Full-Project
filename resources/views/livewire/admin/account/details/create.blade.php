<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Create New Account</div>
            <a href="{{ route('account.details.index') }}" class="btn btn-primary btn-sm">
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

                <!-- User Dropdown -->
                <div class="col-md-6">
                    <label class="form-label">Select User *</label>
                    <select class="form-control @error('user_id') is-invalid @enderror" wire:model="user_id">
                        <option value="">-- Select User --</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                        @endforeach
                    </select>

                    @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                    <input type="file" class="form-control" wire:model="profile_pic">
                </div>

                <!-- Cover Pic -->
                <div class="col-md-6">
                    <label class="form-label">Cover Picture</label>
                    <input type="file" class="form-control" wire:model="cover_pic">
                </div>

                <!-- Side Pic -->
                <div class="col-md-6">
                    <label class="form-label">Side Picture</label>
                    <input type="file" class="form-control" wire:model="side_pic">
                </div>

                <!-- CV -->
                <div class="col-md-6">
                    <label class="form-label">CV</label>
                    <input type="file" class="form-control" wire:model="cv">
                </div>

            </div>

            <div class="border-top px-4 py-4 mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('account.index') }}" class="btn btn-secondary">
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