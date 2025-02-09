<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Film;

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
    public static function addFilms($contenido): void
    {
        $actual = Storage::json('/public/films.json');
        $actual[count($actual)] = $contenido;
        Storage::put('/public/films.json', json_encode($actual));
    }


    public static function existFilms($name): bool
    {
        return Film::where('name', $name)->exists();
    }


    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {
        if (is_null($year)) {
            $year = 2000;
        }

        $title = "Listado de Pelis Antiguas (Antes de $year)";

        $films = Film::where('year', '<', $year)->get();

        return view('films.list', ["films" => $films, "title" => $title]);
    }

    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        if (is_null($year)) {
            $year = 2000;
        }

        $title = "Listado de Pelis Nuevas (Después de $year)";

        $films = Film::where('year', '>=', $year)->get();

        return view('films.list', ["films" => $films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */


    public function listFilmsByYear($year = null)
    {
        $title = "Listado de todas las pelis";

        $films = Film::when($year, function ($query, $year) {
            return $query->where('year', $year);
        })->get();

        if ($year) {
            $title = "Listado de todas las pelis filtradas por año";
        }

        return view("films.list", ["films" => $films, "title" => $title]);
    }

    public function listFilmsByGenre($genre = null)
    {
        $title = "Listado de todas las pelis";
        $films = Film::when($genre, function ($query, $genre) {
            return $query->whereRaw('LOWER(genre) = ?', [strtolower($genre)]);
        })->get();
        if ($genre) {
            $title = "Listado de todas las pelis filtradas por genero";
        }
        return view("films.list", ["films" => $films, "title" => $title]);
    }

    public function listFilms($year = null, $genre = null)
    {
        $query = Film::query();
        if (!is_null($year)) {
            $query->where('year', $year);
        }
        if (!is_null($genre)) {
            $query->where('genre', $genre);
        }
        $films = $query->get();
        $title = "Listado de todas las pelis";
        return view('films.list', ["films" => $films, "title" => $title]);
    }
    public function sortFilms()
    {
        //$films = FilmController::readFilms();
        $films = Film::select("*")->getQuery()->orderBy('year', 'desc')->get();
        $title = "Listado de todas las pelis desde la mas nueva a la mas antigua";

        return view('films.list', ["films" => $films, "title" => $title]);
    }

    public function countFilms()
    {
        $filmCount = Film::count();  // Contar las películas
        return view('films.list', ["filmCount" => $filmCount, "title" => "Todas las películas"]);
    }

    public function countFilmsValue(): int
    {

        return Film::select(['*'])->count();
    }

    //public function createFilm($nombre, $año, $genero, $pais, $duracion, $url)
    public function createFilm(Request $request)
    {
        //$contenido = ["name" => $request->post()["nombre"], "year" => $request->post()["año"], "genre" => $request->post()["genero"], "country" => $request->post()["pais"], "duration" => $request->post()["duracion"], "img_url" => $request->post()["url"]];
        //$this->addFilms($contenido);
        $peli = new Film([
            "name" => $request->post()["nombre"],
            "year" => $request->post()["año"],
            "genre" => $request->post()["genero"],
            "country" => $request->post()["pais"],
            "duration" => $request->post()["duracion"],
            "img_url" => $request->post()["url"]
        ]);
        $peli->save();
        return $this->listFilms();
    }
    public function edit($id)
    {
        $film = Film::find($id);
        if (!$film) {
            return view('error', ["error" => "pelicula no encontrada"]);
        }

        return view('films.edit', ['film' => $film, 'title' => 'Editar Película']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'genre' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'img_url' => 'required|url',
        ]);

        $film = Film::find($id);

        if (!$film) {
            return view('error', ["error" => "pelicula no encontrada"]);
        }

        $film->update([
            'name' => $request->name,
            'year' => $request->year,
            'genre' => $request->genre,
            'country' => $request->country,
            'duration' => $request->duration,
            'img_url' => $request->img_url,
        ]);

        return view('success', ["success" => "Pelicula actualizada"]);
    }
}
