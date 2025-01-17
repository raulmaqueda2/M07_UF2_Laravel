<?php

namespace App\Http\Controllers;
use App\Models\film;
use App\Repositories\FilmRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array
    {
        $films = Storage::json('/public/films.json');
        return $films;
    }
    public static function exisitFilms($name): bool
    {
        $films = FilmController::readFilms();
        foreach ($films as $key1 => $value1) {
            foreach ($films[$key1] as $key => $value) {
                if ($key == "name") {
                    if ($value == $name) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public static function addFilms($contenido): void
    {
        $actual = Storage::json('/public/films.json');
        $actual[count($actual)] = $contenido;
        Storage::put('/public/films.json', json_encode($actual));
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {
        $old_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */


    public function listFilmsByYear($year = null)
    {
        $films_filtered = [];
        $title = "";

        $films = FilmController::readFilms();
        foreach ($films as $film) {
            if (!is_null($year) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);

    }

    public function listFilmsByGenre($genre = null)
    {
        $films_filtered = [];
        $title = "";
        $films = FilmController::readFilms();
        foreach ($films as $film) {
            if (!is_null($genre) && strtolower($film['genre']) == strtolower($genre)) {
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);

    }
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        foreach ($films as $film) {
            if (!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    public function sortFilms()
    {
        $films = FilmController::readFilms();


        usort($films, function ($a, $b) {
            if ((int) $a['year'] == (int) $b['year']) {
                return 0;
            }
            return ((int) $a['year'] > (int) $b['year']) ? -1 : 1;
        });
        $title = "Listado de todas las pelis desde la mas nueva a la mas antigua";

        return view('films.list', ["films" => $films, "title" => $title]);

    }

    public function countFilms()
    {
        $films = ["Cantidad de peliculas" => count(FilmController::readFilms())];

        return view('films.list', ["films" => $films, "title" => "Todas las prliculas"]);
    }
    public function countFilmsValue(): int
    {

        return count(FilmController::readFilms());
    }

    //public function createFilm($nombre, $año, $genero, $pais, $duracion, $url)
    public function createFilm(Request $request)
    {
        $contenido = ["name" => $request->post()["nombre"], "year" => $request->post()["año"], "genre" => $request->post()["genero"], "country" => $request->post()["pais"], "duration" => $request->post()["duracion"], "img_url" => $request->post()["url"]];
        $this->addFilms($contenido);
        (new filmRepository)->saveFilm(new film("test", 200, "nose", "nose", 200, "test"));
        return $this->listFilms();

    }

}
