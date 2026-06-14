@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="row align-items-center py-5 mb-5">
    <div class="col-md-6 text-center text-md-start pe-md-5">
        <h1 class="display-4 fw-bold mb-4">
            Kelola <span class="text-gradient">Manajemen Proyek</span> Lebih Mudah
        </h1>
        <p class="lead text-muted mb-5" style="line-height: 1.8;">
            Tingkatkan produktivitas tim Anda. Kelola proyek, tugas, karyawan, dan label Anda secara efisien dalam satu dasbor yang dinamis dan terpadu.
        </p>
        <div class="d-grid gap-3 d-md-flex justify-content-md-start">
            <a href="{{ route('projects.index') }}" class="btn btn-primary btn-lg px-5 shadow-sm">Mulai Sekarang</a>
            <a href="{{ route('tasks.index') }}" class="btn btn-light btn-lg px-5 border shadow-sm">Lihat Tugas</a>
        </div>
    </div>
    <div class="col-md-6 d-none d-md-block text-center position-relative">
        <div class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="background: radial-gradient(circle, rgba(79,70,229,0.1) 0%, transparent 70%); z-index: -1;"></div>
        <div class="p-5 bg-white bg-opacity-50 rounded-circle shadow-lg d-inline-block" style="width: 320px; height: 320px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.8);">
            <svg class="w-100 h-100" style="color: var(--primary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
        </div>
    </div>
</div>

<!-- Features / Cards Section -->
<div class="row pt-4 mb-5">
    <div class="col-md-3 mb-4">
        <div class="card h-100 text-center p-4">
            <div class="mb-4 mt-2">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle" style="width: 64px; height: 64px;">
                    <svg class="w-50 h-50" style="color: var(--primary-color);" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
            <h5 class="card-title fw-bold">Karyawan</h5>
            <p class="card-text text-muted small mb-4">Kelola anggota tim, perbarui profil, dan tentukan peran mereka dengan mudah.</p>
            <a href="{{ route('employees.index') }}" class="btn btn-sm btn-outline-primary mt-auto rounded-pill px-4">Kelola Karyawan</a>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card h-100 text-center p-4">
            <div class="mb-4 mt-2">
                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle" style="width: 64px; height: 64px;">
                    <svg class="w-50 h-50 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
            </div>
            <h5 class="card-title fw-bold">Proyek</h5>
            <p class="card-text text-muted small mb-4">Lacak jadwal, status, dan pencapaian proyek secara real-time.</p>
            <a href="{{ route('projects.index') }}" class="btn btn-sm btn-outline-success mt-auto rounded-pill px-4">Lihat Proyek</a>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card h-100 text-center p-4">
            <div class="mb-4 mt-2">
                <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-circle" style="width: 64px; height: 64px;">
                    <svg class="w-50 h-50 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
            </div>
            <h5 class="card-title fw-bold">Tugas</h5>
            <p class="card-text text-muted small mb-4">Bagikan tugas ke tim, tetapkan tenggat waktu, dan tinjau kemajuan.</p>
            <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-warning mt-auto rounded-pill px-4">Cek Tugas</a>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card h-100 text-center p-4">
            <div class="mb-4 mt-2">
                <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 rounded-circle" style="width: 64px; height: 64px;">
                    <svg class="w-50 h-50 text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
            </div>
            <h5 class="card-title fw-bold">Label</h5>
            <p class="card-text text-muted small mb-4">Kategorikan berbagai entitas dengan rapi untuk pencarian yang lebih mudah.</p>
            <a href="{{ route('labels.index') }}" class="btn btn-sm btn-outline-danger mt-auto rounded-pill px-4">Atur Label</a>
        </div>
    </div>
    <div class="col-md-3 mb=4">
        <div class="card h-100 text-center p-4">
            <div class="mb-4 mt-2">
                <!-- Ikon dibalut warna biru muda (info) -->
                <div class="d-inline-flex align-items-center justify-content-center bg-info bg-opacity-10 rounded-circle" style="width: 64px; height: 64px;">
                    <svg class="w-50 h-50 text-info" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <!-- Ini bentuk icon untuk penugasan (clipboard check) -->
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
            </div>
            <h5 class="card-title fw-bold">Penugasan</h5>
            <p class="card-text text-muted small mb-4">Atur pembagian kerja, hubungan tugas dengan karyawan secara mendetail.</p>
            <a href="{{ route('task_assignments.index') }}" class="btn btn-sm btn-outline-info mt-auto rounded-pill px-4">Cek Penugasan</a>
        </div>
</div>
@endsection
