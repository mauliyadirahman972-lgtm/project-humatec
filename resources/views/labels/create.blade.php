@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Create Label</h2>
            <a href="{{ route('labels.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('labels.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-medium">Label Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-medium">Color</label>
                        <input type="color" name="color" class="form-control form-control-color w-100" value="{{ old('color', '#3b82f6') }}" title="Choose your color">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Save Label</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
