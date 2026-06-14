@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Create Task</h2>
            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-medium">Task Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Project <span class="text-danger">*</span></label>
                            <select name="project_id" class="form-select" required>
                                <option value="">-- Select Project --</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Label</label>
                            <select name="label_id" class="form-select">
                                <option value="">-- No Label --</option>
                                @foreach($labels as $label)
                                    <option value="{{ $label->id }}" {{ old('label_id') == $label->id ? 'selected' : '' }}>
                                        {{ $label->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="To Do" {{ old('status') == 'To Do' ? 'selected' : '' }}>To Do</option>
                                <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Review" {{ old('status') == 'Review' ? 'selected' : '' }}>Review</option>
                                <option value="Done" {{ old('status') == 'Done' ? 'selected' : '' }}>Done</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Due Date</label>
                            <input type="date" name="due_date" class="form-control" value="{{ old('due_date') }}">
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Save Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
