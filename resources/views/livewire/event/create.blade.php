<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Create Event</div>
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

                <!-- Basic fields (unchanged) -->
                <div class="col-md-6">
                    <label class="form-label">Name</label>
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
                    <input type="text" class="form-control" wire:model="organizer" placeholder="Organizer name / company">
                    @error('organizer') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Sponsor</label>
                    <input type="text" class="form-control" wire:model="sponsor" placeholder="Sponsor name / company">
                    @error('sponsor') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select wire:model="event_category_id" class="form-select">
                        <option value="">Select a Category</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('event_category_id') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Venue Details</label>
                    <input type="text" class="form-control" wire:model="venue" placeholder="Full venue address or hall name">
                    @error('venue') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">About Event</label>
                    <textarea class="form-control" rows="4" wire:model="about" placeholder="Description..."></textarea>
                    @error('about') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>

                <!-- Main Image + Alt Text -->
                <div class="col-md-6">
                    <label class="form-label">Main / Featured Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" wire:model="main_image" accept="image/*">
                    @error('main_image') <span class="text-danger fs-12 d-block mt-1">{{ $message }}</span> @enderror

                    @if($main_image)
                    <div class="mt-3">
                        <img src="{{ $main_image->temporaryUrl() }}" alt="Main image preview"
                             style="max-width:220px; max-height:180px; object-fit:cover; border-radius:8px; border:1px solid #dee2e6;">
                    </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <label class="form-label">Image Alt Text (SEO)</label>
                    <input type="text" class="form-control" wire:model="image_alt" 
                           placeholder="e.g. Diwali Celebration 2025 - Grand Event">
                    @error('image_alt') <span class="text-danger fs-12">{{ $message }}</span> @enderror
                </div>
                
                <!-- Event Images -->
                <div class="col-12">
                    <label class="form-label">Event Images (multiple allowed)</label>
                    @if(!empty($images) && count($images) > 0)
                    <div class="d-flex flex-wrap gap-3 mb-3">
                        @foreach($images as $key => $img)
                        <div class="position-relative">
                            <img src="{{ $img->temporaryUrl() }}" alt="preview"
                                 style="width:120px; height:120px; object-fit:cover; border-radius:8px; border:1px solid #dee2e6;">
                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-0"
                                    style="width:24px;height:24px;font-size:14px;" wire:click="removeImage({{ $key }})">×</button>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <input type="file" class="form-control" wire:model="images" multiple accept="image/*">
                    @error('images.*') <span class="text-danger fs-12 d-block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Artists -->
                <div class="col-12 mt-4">
                    <h5 class="mb-3">Artists / Performers</h5>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto"><label class="form-label mb-0">Number of artists</label></div>
                        <div class="col-auto"><input type="number" min="0" class="form-control form-control-sm w-100px" wire:model.live="artistCount"></div>
                    </div>

                    @if($artistCount > 0)
                    @foreach(range(0, $artistCount - 1) as $index)
                    <div class="border rounded p-3 mb-3 bg-light">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Artist Name {{ $index + 1 }}</label>
                                <input type="text" class="form-control" wire:model="artists.{{ $index }}.name">
                                @error("artists.$index.name") <span class="text-danger fs-12">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Artist Image</label>
                                @if(isset($artists[$index]['image']) && $artists[$index]['image'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                                <div class="mt-2">
                                    <img src="{{ $artists[$index]['image']->temporaryUrl() }}" alt="preview"
                                         style="width:100px; height:100px; object-fit:cover; border-radius:6px;">
                                </div>
                                @endif
                                <input type="file" class="form-control mt-2" wire:model="artists.{{ $index }}.image">
                                @error("artists.$index.image") <span class="text-danger fs-12 d-block mt-1">{{ $message }}</span> @enderror
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
                        <div class="col-auto"><label class="form-label mb-0">Number of ticket types</label></div>
                        <div class="col-auto"><input type="number" min="0" class="form-control form-control-sm w-100px" wire:model.live="ticketCount"></div>
                    </div>

                    @if($ticketCount > 0)
                    @foreach(range(0, $ticketCount - 1) as $index)
                    <div class="border rounded p-3 mb-3 bg-light">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Ticket Name {{ $index + 1 }}</label>
                                <input type="text" class="form-control" wire:model="tickets.{{ $index }}.name">
                                @error("tickets.$index.name") <span class="text-danger fs-12">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Price (Rs)</label>
                                <input type="number" step="0.01" class="form-control" wire:model="tickets.{{ $index }}.price">
                                @error("tickets.$index.price") <span class="text-danger fs-12">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Total Seats</label>
                                <input type="number" step="0.01" class="form-control" wire:model="tickets.{{ $index }}.total_seat">
                                @error("tickets.$index.total_seat") <span class="text-danger fs-12">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                <!-- FAQ -->
                <div class="col-12 mt-4">
                    <h5 class="mb-3">Frequently Asked Questions (FAQ)</h5>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto"><label class="form-label mb-0">Number of FAQs</label></div>
                        <div class="col-auto"><input type="number" min="0" class="form-control form-control-sm w-100px" wire:model.live="faqCount"></div>
                    </div>

                    @if($faqCount > 0)
                    @foreach(range(0, $faqCount - 1) as $index)
                    <div class="border rounded p-3 mb-3 bg-light">
                        <div class="row g-3">
                            <div class="col-12">
                                <label>Title {{ $index + 1 }}</label>
                                <input type="text" class="form-control" wire:model="faqs.{{ $index }}.title" placeholder="e.g. Is parking available?">
                                @error("faqs.$index.title") <span class="text-danger fs-12">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" wire:model="faqs.{{ $index }}.description" placeholder="Detailed answer..."></textarea>
                                @error("faqs.$index.description") <span class="text-danger fs-12">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                <!-- TOC / Terms & Conditions -->
                <div class="col-12 mt-4">
                    <h5 class="mb-3">Terms & Conditions </h5>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto"><label class="form-label mb-0">Number of entries</label></div>
                        <div class="col-auto"><input type="number" min="0" class="form-control form-control-sm w-100px" wire:model.live="tocCount"></div>
                    </div>

                    @if($tocCount > 0)
                    @foreach(range(0, $tocCount - 1) as $index)
                    <div class="border rounded p-3 mb-3 bg-light">
                        <div class="row g-3">
                            <div class="col-12">
                                <label>Title {{ $index + 1 }}</label>
                                <input type="text" class="form-control" wire:model="tocs.{{ $index }}.title" placeholder="e.g. Refund Policy">
                                @error("tocs.$index.title") <span class="text-danger fs-12">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" wire:model="tocs.{{ $index }}.description" placeholder="Full terms or information..."></textarea>
                                @error("tocs.$index.description") <span class="text-danger fs-12">{{ $message }}</span> @enderror
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