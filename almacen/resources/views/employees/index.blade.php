@extends('layout.main')

@section('top-title', 'Empleados')

@section('title')
    <h1 class="mt-4">Empleados</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
        Empleados
    </li>

@endsection

@section('content')

    <div class="mb-3 d-flex justify-content-around">
        <a class="btn btn-outline-danger" href="{{ route('employees.report.pdf') }}">
            <i class="fas fa-file-pdf"></i>
        </a>

        <a class="btn btn-outline-primary" href="{{ route('employees.report.word') }}">
            <i class="fas fa-file-word"></i>
        </a>

        <a class="btn btn-outline-success" href="{{ route('employees.report.excel') }}">
            <i class="fas fa-file-excel"></i>
        </a>

        <a class="btn btn-outline-warning" href="{{ route('employees.create') }}">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user"></i>
            Empleados
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>nombre</th>
                        <th>dirrección</th>
                        <th>email</th>
                        <th>celular</th>
                        <th>puesto</th>
                        <th>activo</th>
                        <th>Creado hace</th>
                        <th>Creado</th>
                        <th>Actualizado hace</th>
                        <th>Actualizado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>nombre</th>
                        <th>dirrección</th>
                        <th>email</th>
                        <th>celular</th>
                        <th>puesto</th>
                        <th>activo</th>
                        <th>Creado hace</th>
                        <th>Creado</th>
                        <th>Actualizado hace</th>
                        <th>Actualizado</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id}}</td>
                            <td>{{ $employee->name}}</td>
                            <td>{{ $employee->address}}</td>
                            <td>{{ $employee->email}}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->position->name}}</td>
                            <td>
                                @if ($employee->active == 'S')
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-danger">Inactivo</span>
                                @endif
                            </td>
                            <td>{{ $employee->created_at->diffForHumans()}}</td>
                            <td>{{ $employee->created_at->format('d-M-Y h:i:s')}}</td>
                            <td>{{ $employee->updated_at->diffForHumans()}}</td>
                            <td>{{ $employee->updated_at->format('d-M-Y h:i:s')}}</td>
                            <td>
                                <a class="btn btn-outline-info -mt-2" href="{{ route('employees.show', $employee->id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a class="btn btn-outline-warning -mt-2" href=" {{ route('employees.edit', $employee->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-outline-danger -mt-2">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
