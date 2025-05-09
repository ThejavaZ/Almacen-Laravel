<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ $employee->name }} - Carta de Recomendación
    </title>
</head>
<body>
    
    <div class="d-flex justify-content-center">
        <img src="./logo.png" alt="logo" width="100" height="100">
        <h2>
        Almacen S.A de C.V<br>
        </h2>
    </div>
    <h1>
        CARTA DE RECOMENDACIÓN LABORAL
    </h1>

    <h2>
        LUGAR Y FECHA:<br/> Hermosillo, Sonora a {{ now()->format('d - M - Y') }}
    <h2/>

    <h3>
        A quien corresponda:
    </h3>
    <p>
        Me complace recomendar a <strong>{{ $employee->name}}</strong>, quien ha sido un valioso miembro de nuestro equipo en <strong>Almacen S.A de C.V</strong> durante <strong>{{ now()->diff($employee->created_at)->format('%d dias %M meses y %Y años') }}</strong>. Durante su tiempo con nosotros, <strong>{{ $employee->name }}</strong> ha demostrado consistentemente un alto nivel de profesionalismo, dedicación y habilidad en su rol como <strong>{{ $employee->position->name}}</strong>.

        <strong>{{ $employee->name}}</strong> destaca por su excelente desempeño, siempre mostrando una actitud amigable y profesional. Su capacidad para manejar tareas múltiples y resolver problemas de manera efectiva ha sido fundamental para el funcionamiento eficiente de almacen.

        Estoy seguro de que <strong>{{ $employee->name}}</strong> será un gran activo para su organización. Su experiencia y habilidades lo convierten en un candidato ideal para cualquier puesto en su empresa.

        Si necesita más información, no dude en contactarme.
    </p>

    <h3>
        Atentamente,
    </h3>
    <p>
        Javier Armando Sarmiento Gil<br>
        Gerente principal <br>
        Almacen S.A de C.V <br>
        6622037327 <br>
        jsdash10000@gmail.com
    </p>
    <h3>
        Firma:
    </h3>
    <p>
        <img src="./Firma.png" alt="firma" width="200" height="100">
        <br>
        _____________________________
    </p>
</body>
</html>
<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 20px;
    }
    h1, h2, h3 {
        color: #333;
    }
    p {
        font-size: 20px;
        text-align: justify;
    }
    h1 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }
    h2 {
        text-align: right;
        font-size: 20px;
        margin-bottom: 10px;
    }
    h3 {
        text-align: left;
        font-size: 18px;
        margin-bottom: 10px;
    }
    p {
        font-size: 16px;
        margin-bottom: 10px;
    }
</style>