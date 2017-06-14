<?php 
namespace App\Http\Middleware;

use Closure;
use App\Models\Curso;

class CursoMissing{


    function handle($request, Closure $next, $guard = null){
        if(Curso::all()->count() == 0){
            return redirect()->back()->withError("É necessário cadastrar um Curso antes");
        }

        return $next($request);
    }
}