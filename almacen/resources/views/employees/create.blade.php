@extends('layout.main')

@section('top-title', 'Crear Empleado')

@section('title')
    <h1 class="mt-4">Crear Empleado</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="{{ route('employees') }}">Empleados</a>
    </li>
    <li class="breadcrumb-item active">
        Crear
    </li>
@endsection

@section('content')

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user"></i>
            Crear Empleado
        </div>
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Dirección" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Celular</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Celular" required>
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Puesto</label>
                    <select class="form-select" id="position" name="position_id" required>
                        <option value="" selected disabled>Selecciona un puesto</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 d-flex justify-content-around -ml-px">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-floppy-disk"></i>
                    </button>
                    <a href="{{ route('employees') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                
            </form>
        </div>
    </div>

@endsection