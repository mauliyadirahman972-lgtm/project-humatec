@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ url('/') }}" class="btn btn-light border shadow-sm rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 40px; height: 40px;" title="Kembali ke Dashboard">
            <svg class="w-50 h-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h2 class="fw-bold m-0">Labels</h2>
    </div>
    <div class="d-flex gap-2">
        <form action="{{ route('labels.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search labels..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </form>
        <a href="{{ route('labels.create') }}" class="btn btn-primary">
            + Create New Label
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped m-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Color Preview</th>
                        <th class="px-4 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($labels as $label)
                    <tr>
                        <td class="px-4 py-3 align-middle">{{ $label->id }}</td>
                        <td class="px-4 py-3 align-middle fw-medium">{{ $label->name }}</td>
                        <td class="px-4 py-3 align-middle">
                            <span class="badge rounded-pill" style="background-color: {{ $label->color }}; color: #fff; padding: 8px 12px; border: 1px solid rgba(0,0,0,0.1);">
                                {{ $label->color ?? 'None' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 align-middle text-end">
                            <a href="{{ route('labels.edit', $label) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('labels.destroy', $label) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this label?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Data label tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top">
            {{ $labels->links() }}
        </div>
    </div>
</div>
@endsection
