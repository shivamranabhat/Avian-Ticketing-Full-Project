<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Events</div>
        </div>

        <div class="card-body">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length">
                        <label style="display:inline-flex; gap:0.5rem; align-items:center">
                            Show
                            <select wire:model.live="perPage" class="form-select form-select-sm w-auto">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            entries
                        </label>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_filter d-flex justify-content-end align-items-center gap-2">
                        <label>
                            <input type="search" class="form-control form-control-sm" placeholder="Search..." wire:model.live="search">
                        </label>
                        <a href="{{ route('event.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle"></i> New
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead class="table-primary">
                        <tr>
                            <th>S.N.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Location</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $index => $event)
                        <tr>
                            <td>{{ $events->firstItem() + $index }}</td>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->date->format('d M Y H:i') }}</td>
                            <td>{{ $event->location }}</td>
                            <td x-data="{ openModal: false }">
                                <div class="hstack gap-2">
                                    <a href="{{ route('event.edit', $event->slug) }}" class="btn btn-icon btn-info-transparent rounded-pill">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    <button type="button" @click="openModal = true" class="btn btn-icon btn-danger-transparent rounded-pill">
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
                                            Are you sure you want to delete this event?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cancel" @click="openModal = false">Cancel</button>
                                            <button class="btn btn-delete" wire:click="delete({{ $event->id }})" @click="openModal = false">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted">No events found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                        Showing {{ $events->firstItem() }} to {{ $events->lastItem() }} of {{ $events->total() }} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>