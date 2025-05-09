@extends('layout.main')

@section('top-title', 'Empleado')
@section('title')
    <h1 class="mt-4">Empleado</h1>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="{{ route('employees') }}">Empleados</a>
    </li>
    <li class="breadcrumb-item active">
        {{ $employee->name }}
    </li>
@endsection

@section('content')

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user"></i>
            Empleado
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" disabled>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $employee->address }}" disabled>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}" disabled>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Celular</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $employee->phone }}" disabled>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Puesto</label>
                <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position->name }}" disabled>
            </div>
            <div class="mb-3">
                <label for="active" class="form-label">Activo</label>
                @if ($employee->active == 'S')
                    <input type="text" class="form-control" id="active" name="active" value="{{ $employee->active ? 'Sí' : 'No' }}" disabled>
                
                @else
                    <input type="text" class="form-control" id="active" name="active" value="{{ $employee->active ? 'No' : 'Si' }}" disabled>
                @endif

            </div>
            <div class="mb-3">
                <label for="created_at" class="form-label">Creado hace</label>
                <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $employee->created_at->diffForHumans() }}" disabled>
            </div>
            <div class="mb-3">
                <label for="created_at" class="form-label">Creado</label>
                <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $employee->created_at }}" disabled>
            </div>
            <div class="mb-3">
                <label for="updated_at" class="form-label">Actualizado hace</label>
                <input type="text" class="form-control" id="updated_at" name="updated_at" value="{{ $employee->updated_at->diffForHumans() }}" disabled>
            </div>
            <div class="mb-3">
                <label for="updated_at" class="form-label">Actualizado</label>
                <input type="text" class="form-control" id="updated_at" name="updated_at" value="{{ $employee->updated_at }}" disabled>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('storage/' . $employee->photo) }}" alt="Foto de {{ $employee->name }}" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">

            <a class="btn btn-danger" href=" {{ route('employees.pdf', $employee->id) }}">
                <i class="fas fa-file-pdf"></i>
            </a>

            <a class="btn btn-info" href="{{ route('employees.card', $employee->id) }}">
                <i class="fas fa-envelope"></i>
            </a>

            <a class="btn btn-primary" href="{{ route('employees.doc', $employee->id) }}">
                <i class="fas fa-file-word"></i>
            </a>

            <a class="btn btn-success" href="{{ route('employees.xlsx', $employee->id) }}">
                <i class="fas fa-file-excel"></i>
            </a>
            
            <a href="{{ route('employees') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>
@endsection