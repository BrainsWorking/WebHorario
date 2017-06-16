<?php 
namespace App\Http\Middleware;

use Closure;
use App\Models\Turno;

class TurnoMissing{


    function handle($request, Closure $next, $guard = null){
        if(Turno::all()->count() == 0){
            return redirect()->back()->withError("É necessário cadastrar um Turno antes");
        }

        return $next($request);
    }
}