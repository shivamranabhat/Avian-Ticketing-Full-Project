<div class="col-xl-12">
    <div class="card custom-card">

        <div class="card-header justify-content-between">
            <div class="card-title">Contents</div>
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

                    <a href="{{ route('content.create') }}" class="btn btn-sm btn-primary">
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
                            <th>Position</th>
                            <th>Create at</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($contents as $index => $content)
                        <tr>
                            <td>{{ $contents->firstItem() + $index }}</td>

                            <td>
                                {{ $content->position ?? 'N/A' }}
                            </td>
                           

                            <td>
                                {{ $content->created_at->format('d M Y') }}
                            </td>

                            <td x-data="{ openModal: false }">
                                <div class="hstack gap-2">
                                    <a href="{{ route('content.edit', $content->slug) }}"
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
                                            Are you sure you want to delete this content?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cancel" @click="openModal = false">Cancel</button>
                                            <button class="btn btn-delete" wire:click="delete({{ $content->id }})"
                                                @click="openModal = false">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                No content found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($contents->hasPages())
            <div class="row mt-4">
                <div class="col-md-5">
                    Showing {{ $contents->firstItem() }}
                    to {{ $contents->lastItem() }}
                    of {{ $contents->total() }} entries
                </div>
                <div class="col-md-7 text-end">
                    {{ $contents->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>