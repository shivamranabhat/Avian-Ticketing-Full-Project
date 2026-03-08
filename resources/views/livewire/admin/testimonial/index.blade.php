<div class="col-xl-12">
    <div class="card custom-card">

        <div class="card-header justify-content-between">
            <div class="card-title">testimonial Details</div>
        </div>

        <div class="card-body">

            <!-- Controls -->
            <div class="row mb-3">
                <div class="col-md-6">
                    Show
                    <select wire:model.live="perPage" class="form-select form-select-sm w-auto d-inline-block">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    entries
                </div>

                <div class="col-md-6 text-end">
                    <input type="search" class="form-control form-control-sm w-auto d-inline-block"
                        placeholder="Search..." wire:model.live.debounce.500ms="search">

                    <a href="{{ route('testimonial.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-circle"></i> New
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead class="table-primary">
                        <tr>
                            <th>S.N.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($testimonials as $index => $testimonial)
                        <tr>
                            <td>{{ $testimonials->firstItem() + $index }}</td>

                            <td>
                                @if($testimonial->image)
                                <img src="{{ asset('storage/'.$testimonial->image) }}" width="40" class="rounded">
                                @else
                                —
                                @endif
                            </td>

                            <td>{{ $testimonial->name ?? '—' }}</td>
                            <td>{{ $testimonial->role ?? '—' }}</td>

                            <td>{{ $testimonial->created_at->format('d M Y') }}</td>


                            <td x-data="{ openModal: false }">
                                <div class="hstack gap-2">
                                    <a href="{{ route('testimonial.edit', $testimonial->slug) }}"
                                        class="btn btn-icon btn-info-transparent rounded-pill">
                                        <i class="ri-edit-line"></i>
                                    </a>

                                    <button type="button" @click="openModal = true"
                                        class="btn btn-icon btn-danger-transparent rounded-pill" title="Delete">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </div>
                                <div x-show="openModal" class="modal-backdrop" style="display:none;">
                                    <div class="modal-box">
                                        <div class="modal-header p-0">
                                            <div class="modal-title">Confirm Delete</div>
                                            <button class="close-btn" @click="openModal = false">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this testimonial?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cancel" @click="openModal = false">Cancel</button>
                                            <button class="btn btn-delete" wire:click="delete({{ $testimonial->id }})"
                                                @click="openModal = false">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No details found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($testimonials->hasPages())
            <div class="row mt-4">
                <div class="col-md-5">
                    Showing {{ $testimonials->firstItem() }}
                    to {{ $testimonials->lastItem() }}
                    of {{ $testimonials->total() }} entries
                </div>
                <div class="col-md-7 text-end">
                    {{ $testimonials->links() }}
                </div>
            </div>
            @endif

        </div>
    </div>
</div>