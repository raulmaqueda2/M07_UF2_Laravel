<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Include any additional stylesheets or scripts here -->
</head>

<body class="container">

    @include('cabezera')
    <h1 class="mt-4">Lista de Peliculas</h1>
    <ul>
        <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
        <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
        <li><a href=/filmout/films>Pelis</a></li>
        <li><a href=/filmout/Drama>Pelis countFilms</a></li>
        <li><a href=/filmout/filmsByYear/2022>Pelis filtrado por Año</a></li>

        <li><a href=/filmout/filmsByGenre/Drama>Pelis filtrado por drama</a></li>
        <li><a href=/filmout/countFilms>Pelis countFilms</a></li>

    </ul>
    <h1 class="mt-4">Añadir Pelicula</h1>
    @if(isset($status))
        <h1>{{$status}}</h1>
    @endif
    <form action="/filmin/createFilm" method="post">
        @csrf
        <div>Nombre: <input type="text" name="nombre" id=""></div>
        <div>Año: <input type="number" name="año" id=""></div>
        <div>Genero: <input type="text" name="genero" id=""></div>
        <div>Pais: <input type="text" name="pais" id=""></div>
        <div>Duracion: <input type="number" name="duracion" id=""></div>
        <div>Imagen URL: <input type="text" name="url" id=""></div>
        <button type="send">Enviar</button>
    </form>

    @include('piePagina')


    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->

</body>

</html>