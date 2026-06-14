@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ url('/') }}" class="btn btn-light border shadow-sm rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 40px; height: 40px;" title="Kembali ke Dashboard">
            <svg class="w-50 h-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h2 class="fw-bold m-0">Projects</h2>
    </div>
    <div class="d-flex gap-2">
        <form action="{{ route('projects.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search projects..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </form>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            + Create New Project
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
                        <th class="px-4 py-3">Dates</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Tasks</th>
                        <th class="px-4 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                    <tr>
                        <td class="px-4 py-3 align-middle">{{ $project->id }}</td>
                        <td class="px-4 py-3 align-middle fw-medium">{{ $project->name }}</td>
                        <td class="px-4 py-3 align-middle text-muted small">
                            {{ $project->start_date }} <br>to<br> {{ $project->end_date }}
                        </td>
                        <td class="px-4 py-3 align-middle">
                            @if($project->status == 'Completed')
                                <span class="badge bg-success">Completed</span>
                            @elseif($project->status == 'In Progress')
                                <span class="badge bg-warning text-dark">In Progress</span>
                            @else
                                <span class="badge bg-secondary">Planning</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 align-middle text-center">
                            <span class="badge rounded-pill bg-info text-dark">{{ $project->tasks->count() }}</span>
                        </td>
                        <td class="px-4 py-3 align-middle text-end">
                            <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this project?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Data proyek tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top">
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection
