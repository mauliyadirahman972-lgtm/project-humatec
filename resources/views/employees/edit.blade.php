@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Edit Employee</h2>
            <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('employees.update', $employee) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-medium">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name', $employee->name) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required value="{{ old('email', $employee->email) }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-medium">Role</label>
                        <input type="text" name="role" class="form-control" value="{{ old('role', $employee->role) }}">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Update Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
