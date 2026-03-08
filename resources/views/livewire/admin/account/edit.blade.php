<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Edit Account</div>
            <a href="{{ route('account.index') }}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
                Back
            </a>
        </div>

        <form class="card-body" wire:submit.prevent="update">
            <div class="row g-3">


                <!-- Name -->
                <div class="col-md-6">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           wire:model.live.debounce.500ms="name"
                           placeholder="John Doe"
                           autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           wire:model.live.debounce.500ms="email"
                           placeholder="example@domain.com"
                           autocomplete="email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="col-12">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text"
                           class="form-control @error('phone') is-invalid @enderror"
                           wire:model.live.debounce.500ms="phone"
                           placeholder="+1234567890 or 123456789"
                           autocomplete="tel">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- New Password (optional on edit) -->
                <div class="col-md-6">
                    <label for="password" class="form-label">New Password <small class="text-muted">(leave blank to keep current)</small></label>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           wire:model="password"
                           placeholder="••••••••"
                           autocomplete="new-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           wire:model="password_confirmation"
                           placeholder="••••••••"
                           autocomplete="new-password">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <!-- Is VIP? Dropdown -->
            <div class="col-12 mt-2">
                <label for="is_vip" class="form-label">Is VIP? <span class="text-danger">*</span></label>
                <select 
                    class="form-select @error('is_vip') is-invalid @enderror"
                    wire:model.live="is_vip"
                    id="is_vip">
                    <option value="" disabled selected>Select option</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
                @error('is_vip')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="border-top px-4 py-4 mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('account.index') }}" class="btn btn-secondary">Cancel</a>
                
                <button type="submit" 
                        class="btn btn-primary d-flex align-items-center gap-2"
                        wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="update">
                        <i class="bi bi-save"></i> Save
                    </span>
                    <span wire:loading wire:target="update">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Saving...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>