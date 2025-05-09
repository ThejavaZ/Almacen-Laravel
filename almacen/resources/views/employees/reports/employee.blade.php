<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte del empleado {{ $employee->name }}</title>
</head>
<body>
    <h1>Reporte del empleado {{ $employee->name }}</h1>
    <h2>Fecha de creación: {{ now() }}</h2>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #f2f2f2;">
            <tr style="text-align: left;">
                <th style="width: 50px;">ID</th>
                <th style="width: 50px;">Nombre</th>
                <th style="width: 50px;">Dirección</th>
                <th style="width: 50px;">Email</th>
                <th style="width: 50px;">Celular</th>
                <th style="width: 50px;">Puesto</th>
                <th style="width: 50px;">Activo</th>
            </tr>

        </thead>
        <tbody>
                <tr style="text-align: justify;">
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->position->name }}</td>
                    <td>{{ $employee->active ? 'Sí' : 'No' }}</td>
                </tr>
        </tbody>
    </table>
   
</body>
</html>