<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Edit Event</div>
            <a href="{{ route('event.index') }}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
        </div>

        <form class="card-body" wire:submit="save" enctype="multipart/form-data">

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Event Name</label>
                    <input type="text" class="form-control" wire:model="name" placeholder="Enter event name">
                    @error('name') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date & Time</label>
                    <input type="datetime-local" class="form-control" wire:model="date">
                    @error('date') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Location</label>
                    <input type="text" class="form-control" wire:model="location" placeholder="City, Venue">
                    @error('location') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Organizer</label>
                    <input type="text" class="form-control" wire:model="organizer"
                        placeholder="Organizer name / company">
                    @error('organizer') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select wire:model="event_category_id" class="form-select">
                        <option value="">Select a Category</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $event_category_id==$cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('event_category_id') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Venue Details</label>
                    <input type="text" class="form-control" wire:model="venue"
                        placeholder="Full venue address or hall name">
                    @error('venue') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">About Event</label>
                    <textarea class="form-control" rows="4" wire:model="about" placeholder="Description..."></textarea>
                    @error('about') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Event Images (existing + new)</label>

                    <!-- Existing images -->
                    @if(!empty($existingImages))
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @foreach($existingImages as $idx => $img)
                        <div class="position-relative">
                            <img src="{{ Storage::url($img) }}" alt="existing image"
                                style="width:100px; height:100px; object-fit:cover; border-radius:6px;">
                            <button type="button"
                                class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle"
                                wire:click="removeExistingImage({{ $idx }})">×</button>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- New uploaded images preview -->
                    @if(!empty($images) && is_countable($images) && count($images) > 0)
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @foreach($images as $key => $image)
                        <div class="position-relative">
                            <img src="{{ $image->temporaryUrl() }}" alt="new preview"
                                style="width:100px; height:100px; object-fit:cover; border-radius:6px;">
                            <button type="button"
                                class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle"
                                wire:click="removeNewImage({{ $key }})">×</button>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <input type="file" class="form-control" wire:model="images" multiple accept="image/*">
                    @error('images.*') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>

                <!-- Artists -->
                <div class="col-12 mt-4">
                    <h5 class="mb-3">Artists / Performers</h5>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto">
                            <label class="form-label mb-0">Number of artists</label>
                        </div>
                        <div class="col-auto">
                            <input type="number" min="0" class="form-control form-control-sm w-100px"
                                wire:model.debounce.500ms="artistCount">
                        </div>
                    </div>

                    @if($artistCount > 0)
                    @foreach($artists as $index => $artist)
                    <div class="border  rounded p-3 mb-3 bg-light">
                        <div class="row g-3 d-flex align-items-end">
                            <div class="col-md-6">
                                <label class="form-label">Artist Name {{ $index + 1 }}</label>
                                <input type="text" class="form-control" wire:model="artists.{{ $index }}.name">
                                @error("artists.$index.name") <span class="text-danger fs-12">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Artist Image</label>
                                <!-- Preview logic -->
                                @if(!empty($artist['image']) && is_object($artist['image']) &&
                                method_exists($artist['image'], 'temporaryUrl'))
                                <div class="mt-2">
                                    <img src="{{ $artist['image']->temporaryUrl() }}" alt="new artist preview"
                                        style="width:50px; height:50px; object-fit:cover; border-radius:6px;">
                                </div>
                                @elseif(!empty($artist['existing_image']))
                                <div class="mt-2">
                                    <img src="{{ Storage::url($artist['existing_image']) }}" alt="existing artist"
                                        style="width:50px; height:50px; object-fit:cover; border-radius:6px;">
                                </div>
                                @endif
                                <input type="file" class="form-control" wire:model="artists.{{ $index }}.image"
                                    accept="image/*">



                                @error("artists.$index.image") <span class="text-danger fs-12">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                <!-- Tickets -->
                <div class="col-12 mt-4">
                    <h5 class="mb-3">Ticket Types</h5>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto">
                            <label class="form-label mb-0">Number of ticket types</label>
                        </div>
                        <div class="col-auto">
                            <input type="number" min="0" class="form-control form-control-sm w-100px"
                                wire:model.debounce.500ms="ticketCount">
                        </div>
                    </div>

                    @if($ticketCount > 0)
                    @foreach($tickets as $index => $ticket)
                    <div class="border rounded p-3 mb-3 bg-light">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Ticket Name {{ $index + 1 }} (e.g. VIP, Early Bird)</label>
                                <input type="text" class="form-control" wire:model="tickets.{{ $index }}.name">
                                @error("tickets.$index.name") <span class="text-danger fs-12">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Price (£)</label>
                                <input type="number" step="0.01" class="form-control"
                                    wire:model="tickets.{{ $index }}.price">
                                @error("tickets.$index.price") <span class="text-danger fs-12">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

            </div>

            <div class="border-top px-4 py-3 mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('event.index') }}" class="btn btn-secondary">Cancel</a>
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