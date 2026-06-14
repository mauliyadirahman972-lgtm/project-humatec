@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ url('/') }}" class="btn btn-light border shadow-sm rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 40px; height: 40px;" title="Kembali ke Dashboard">
            <svg class="w-50 h-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h2 class="fw-bold m-0">Employees</h2>
    </div>
    <div class="d-flex gap-2">
        <form action="{{ route('employees.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search employees..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </form>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            + Create New Employee
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
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <td class="px-4 py-3 align-middle">{{ $employee->id }}</td>
                        <td class="px-4 py-3 align-middle fw-medium">{{ $employee->name }}</td>
                        <td class="px-4 py-3 align-middle text-muted">{{ $employee->email }}</td>
                        <td class="px-4 py-3 align-middle">
                            <span class="badge bg-secondary">{{ $employee->role ?? 'N/A' }}</span>
                        </td>
                        <td class="px-4 py-3 align-middle text-end">
                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this employee?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Data karyawan tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top">
            {{ $employees->links() }}
        </div>
    </div>
</div>
@endsection
