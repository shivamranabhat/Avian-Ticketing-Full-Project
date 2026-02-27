<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Edit Featured Event</h5>
        <a href="{{ route('featured-events.index') }}" class="btn btn-sm btn-secondary">Back to List</a>
    </div>

    <div class="card-body">
        <form wire:submit="update">

            <div class="mb-4">
                <label class="form-label fw-bold">Event</label>
                <select wire:model="event_id" class="form-select">
                    <option value="">Choose a different event</option>
                    @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ $event->id == $event_id ? 'selected' : '' }}>
                        {{ $event->name }}
                    </option>
                    @endforeach
                </select>
                @error('event_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                <small class="text-muted d-block mt-1">
                    Changing this will replace the currently featured event.
                </small>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('featured-events.index') }}" class="btn btn-outline-secondary">Cancel</a>
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