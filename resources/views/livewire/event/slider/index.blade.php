<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">sliders</div>
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
                        <a href="{{ route('slider.create') }}" class="btn btn-sm btn-primary">
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
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $index => $slider)
                        <tr>
                            <td>{{ $sliders->firstItem() + $index }}</td>
                            <td>
                                @if($slider->image)
                                <img src="{{ asset('storage/'.$slider->image) }}" width="80" class="rounded">
                                @else
                                —
                                @endif
                            </td>
                            <td>{{ $slider->title }}</td>
                            <td>{{ $slider->created_at->format('d M Y H:i') }}</td>
                            <td x-data="{ openModal: false }">
                                <div class="hstack gap-2">
                                    <a href="{{ route('slider.edit', $slider->slug) }}" class="btn btn-icon btn-info-transparent rounded-pill">
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
                                            Are you sure you want to delete this slider?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cancel" @click="openModal = false">Cancel</button>
                                            <button class="btn btn-delete" wire:click="delete({{ $slider->id }})" @click="openModal = false">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted">No sliders found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                        Showing {{ $sliders->firstItem() }} to {{ $sliders->lastItem() }} of {{ $sliders->total() }} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end">
                        {{ $sliders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>