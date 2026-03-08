<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">Accounts</div>
        </div>

        <div class="card-body">
            <div class="row mb-3">
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
                            <input type="search" class="form-control form-control-sm"
                                placeholder="Search by email, phone or slug..." wire:model.live.debounce.500ms="search">
                        </label>
                        <a href="{{ route('account.create') }}" class="btn btn-sm btn-primary">
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Link</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody wire:poll.keep-alive>
                        @forelse($accounts as $index => $account)
                        <tr>
                            <td>{{ $accounts->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span>{{ $account->name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span>{{ $account->email }}</span>
                                </div>
                            </td>
                            <td>{{ $account->phone ?? '—' }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span id="slug-{{ $account->id }}" class="text-primary">
                                        vip.avianpass.com/{{ $account->slug }}
                                    </span>

                                    <button type="button" class="btn btn-sm btn-light"
                                        onclick="copySlug('slug-{{ $account->id }}')" title="Copy Link">
                                        <i class="ri-file-copy-line"></i>
                                    </button>
                                </div>
                            </td>

                            <td>{{ $account->created_at->format('d M Y') }}</td>
                            <td x-data="{ openModal: false }">
                                <div class="hstack gap-2 fs-5">
                                    <a href="{{ route('account.edit', $account->slug) }}"
                                        class="btn btn-icon btn-info-transparent rounded-pill" title="Edit">
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
                                            Are you sure you want to delete this account?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cancel" @click="openModal = false">Cancel</button>
                                            <button class="btn btn-delete" wire:click="delete({{ $account->id }})"
                                                @click="openModal = false">Delete</button>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No accounts found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                        Showing {{ $accounts->firstItem() }} to {{ $accounts->lastItem() }}
                        of {{ $accounts->total() }} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end">
                        {{ $accounts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="copyToast" style="position:fixed;bottom:20px;right:20px;background:#28a745;color:white;
    padding:10px 16px;border-radius:6px;font-size:14px;display:none;
    box-shadow:0 4px 12px rgba(0,0,0,0.15);z-index:9999;">
        Link copied to clipboard
    </div>
    <script>
        function copySlug(id) {
    const text = document.getElementById(id).innerText;

    navigator.clipboard.writeText(text).then(() => {
        const toast = document.getElementById("copyToast");
        toast.style.display = "block";

        setTimeout(() => {
            toast.style.display = "none";
        }, 2000);
    }).catch(err => {
        console.error("Copy failed", err);
    });
}
    </script>
</div>