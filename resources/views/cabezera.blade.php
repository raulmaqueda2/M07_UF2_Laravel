<?php
use App\Http\Controllers\FilmController;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<header class="fixed-top" style="background-color:#caf0f8;">
    <div class="container">
        <nav class="nav-fixed row">
            <ul class="nav-fixed d-flex col-10">
                <li class="nav-item">
                    <a href="/">Menu principal</a>
                </li>
                <li class="nav-item">
                    <a href="/filmout/films">Peliculas</a>
                </li>
                <li class="nav-item">
                    <a href="/filmout/newFilms">Peliculas Nuevas</a>
                </li>
                <li class="nav-item">
                    <a href="/filmout/oldFilms">Peliculas Antiguas</a>
                </li>
            </ul>
            <ul class="nav col-2 offset-md-12 nav-fixed-jail">
                <p>{{(new FilmController)->countFilmsValue()}}</p>
            </ul>
    </div>
    </nav>
    <style>
        .nav-fixed>li {
            margin-top: 10px;
            margin-left: 20px;
            list-style: none;
        }

        .nav-fixed>li {
            margin-top: 10px;
            margin-left: 20px;
            list-style: none;
            padding: 20px;

        }

        .nav-fixed-jail>p {
            margin-top: 5px;
            border: 2px solid black;
            font-size: 3vw;
            border-radius: 10px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .nav-fixed>li:hover {
            background-color: #ade8f4;
        }
    </style>
</header>