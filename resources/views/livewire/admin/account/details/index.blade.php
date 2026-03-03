<div class="col-xl-12">
    <div class="card custom-card">

        <div class="card-header justify-content-between">
            <div class="card-title">Account Details</div>
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

                    <a href="{{ route('account.details.create') }}" class="btn btn-sm btn-primary">
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
                            <th>Profile Pic</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Created</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($accounts as $index => $account)
                        <tr>
                            <td>{{ $accounts->firstItem() + $index }}</td>

                            <td>
                                @if($account->profile_pic)
                                <img src="{{ asset('storage/'.$account->profile_pic) }}" width="40" class="rounded">
                                @else
                                —
                                @endif
                            </td>

                            <td>{{ $account->user->name ?? '—' }}</td>
                            <td>{{ $account->user->email ?? '—' }}</td>

                            <td>{{ $account->location ?? '—' }}</td>


                            <td>
                                {{ $account->created_at->format('d M Y') }}
                            </td>

                            <td>
                                <div class="hstack gap-2">
                                    <a href="{{ route('account.details.edit', $account->slug) }}"
                                        class="btn btn-icon btn-info-transparent rounded-pill">
                                        <i class="ri-edit-line"></i>
                                    </a>

                                    <button class="btn btn-icon btn-danger-transparent rounded-pill"
                                        wire:click="delete({{ $account->id }})"
                                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                No details found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($accounts->hasPages())
            <div class="row mt-4">
                <div class="col-md-5">
                    Showing {{ $accounts->firstItem() }}
                    to {{ $accounts->lastItem() }}
                    of {{ $accounts->total() }} entries
                </div>
                <div class="col-md-7 text-end">
                    {{ $accounts->links() }}
                </div>
            </div>
            @endif

        </div>
    </div>
</div>