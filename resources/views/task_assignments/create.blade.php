@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('task_assignments.index') }}" class="btn btn-light border shadow-sm rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 40px; height: 40px;" title="Back to Task Assignments">
        <svg class="w-50 h-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </a>
    <h2 class="fw-bold m-0">Create Task Assignment</h2>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('task_assignments.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="task_id" class="form-label fw-medium">Task</label>
                <select name="task_id" id="task_id" class="form-select" required>
                    <option value="" disabled selected>Select a Task</option>
                    @foreach($tasks as $task)
                        <option value="{{ $task->id }}">{{ $task->title }} ({{ $task->project->name ?? 'No Project' }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="employee_id" class="form-label fw-medium">Employee</label>
                <select name="employee_id" id="employee_id" class="form-select" required>
                    <option value="" disabled selected>Select an Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }} - {{ $employee->role ?? 'No Role' }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('task_assignments.index') }}" class="btn btn-light border">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Assignment</button>
            </div>
        </form>
    </div>
</div>
@endsection
