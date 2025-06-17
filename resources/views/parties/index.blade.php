@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Parties</h3>
                </div>
                <div class="card-body">
                    <!-- Filter Controls -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <form action="{{ route('parties.index') }}" method="GET" class="form-inline">
                                <div class="form-group mr-3">
                                    <label for="status" class="mr-2">Status:</label>
                                    <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="deactivated" {{ request('status') == 'deactivated' ? 'selected' : '' }}>Deactivated</option>
                                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Parties List -->
                    <div class="row">
                        @forelse($parties as $party)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    @if($party->logo)
                                        <img src="{{ asset('storage/' . $party->logo) }}" class="card-img-top" alt="{{ $party->name }} logo">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $party->name }}</h5>
                                        <p class="card-text">{{ $party->description }}</p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                Status: <span class="badge {{ $party->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                                    {{ ucfirst($party->status) }}
                                                </span>
                                            </small>
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                Leader: {{ $party->leader_firstname }} {{ $party->leader_infix }} {{ $party->leader_lastname }}
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">No parties found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
