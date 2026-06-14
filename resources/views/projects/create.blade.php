@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Create Project</h2>
            <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-medium">Project Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Start Date <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control" required value="{{ old('start_date') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">End Date <span class="text-danger">*</span></label>
                            <input type="date" name="end_date" class="form-control" required value="{{ old('end_date') }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-medium">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="Planning" {{ old('status') == 'Planning' ? 'selected' : '' }}>Planning</option>
                            <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Save Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
