<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Edit Featured Activity</h5>
        <a href="{{route('activity.category.index')}}" class="btn btn-primary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg>
        </a>
    </div>

    <div class="card-body">
        <form wire:submit="update">

            <div class="mb-4">
                <label class="form-label fw-bold">Activity</label>
                <select wire:model="activity_id" class="form-select">
                    <option value="">Choose a different activity</option>
                    @foreach($activities as $activity)
                    <option value="{{ $activity->id }}" {{ $activity->id == $activity_id ? 'selected' : '' }}>
                        {{ $activity->name }}
                    </option>
                    @endforeach
                </select>
                @error('activity_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                <small class="text-muted d-block mt-1">
                    Changing this will replace the currently featured activity.
                </small>
            </div>
            <div class="border-top px-4 py-3 d-flex justify-content-end gap-2">
                <a href="{{ route('activity.featured.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="update">Save</span>
                    <span wire:loading wire:target="update">
                        <span class="spinner-border spinner-border-sm"></span> Saving...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>