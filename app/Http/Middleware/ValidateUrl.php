<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateUrl
{
    public function handle(Request $request, Closure $next)
    {
        if (isset($request->post()["url"])) {
            $url = $request->post()["url"];
            if (is_null($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
                return redirect('/error/url');
            }
        }
        return $next($request);
    }

}