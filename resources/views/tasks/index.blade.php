@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ url('/') }}" class="btn btn-light border shadow-sm rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 40px; height: 40px;" title="Kembali ke Dashboard">
            <svg class="w-50 h-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h2 class="fw-bold m-0">Tasks</h2>
    </div>
    <div class="d-flex gap-2">
        <form action="{{ route('tasks.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search tasks..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </form>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            + Create New Task
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped m-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Project</th>
                        <th class="px-4 py-3">Label</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Due Date</th>
                        <th class="px-4 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                    <tr>
                        <td class="px-4 py-3 align-middle fw-medium">{{ $task->title }}</td>
                        <td class="px-4 py-3 align-middle">{{ $task->project->name ?? '-' }}</td>
                        <td class="px-4 py-3 align-middle">
                            @if($task->label)
                                <span class="badge rounded-pill" style="background-color: {{ $task->label->color }}; color: #fff;">
                                    {{ $task->label->name }}
                                </span>
                            @else
                                <span class="text-muted small">No Label</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 align-middle">
                            @php
                                $badgeClass = match($task->status) {
                                    'Done' => 'bg-success',
                                    'In Progress' => 'bg-warning text-dark',
                                    'Review' => 'bg-info text-dark',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $task->status }}</span>
                        </td>
                        <td class="px-4 py-3 align-middle text-muted small">
                            {{ $task->due_date ? date('M d, Y', strtotime($task->due_date)) : '-' }}
                        </td>
                        <td class="px-4 py-3 align-middle text-end">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this task?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Data tugas tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top">
            {{ $tasks->links() }}
        </div>
    </div>
</div>
@endsection
