<?php

namespace  App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct(){
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function index() {
        return view('auth.login'); 
    }

    public function logar(Request $request) {
        $this->login($request); 
        return redirect('home');
    }

    public function deslogar(Request $request) {
        $this->logout($request);
        return redirect('home');
    }

    protected function sendFailedLoginResponse(Request $request) {
        $errors = [$this->username() => trans('auth.failed')];
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()->route('home')
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

}
