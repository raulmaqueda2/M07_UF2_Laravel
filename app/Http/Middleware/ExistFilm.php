<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\FilmController;
class ExistFilm
{
    public function handle(Request $request, Closure $next)
    {
        if (isset($request->post()["nombre"])) {
            $nombre = $request->post()["nombre"];
            if (FilmController::exisitFilms($nombre)) {
                return redirect('/error/filmExist');
            }
        }
        return $next($request);
    }

}