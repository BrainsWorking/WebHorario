<?php

namespace  App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function __construct(){ $this->middleware('guest', ['except' => 'deslogar']); }

    public function index() { return view('auth.login'); }

    public function logar(LoginRequest $request) { 
        if(Auth::attempt($request->only('prontuario', 'password'))){
            return redirect()->intended(route('home')); 
        } else {
            return redirect()->route('login')
                ->withInput($request->only('prontuario'))
                ->withError('Prontuário ou senha incorretos');
        }
    }

    public function deslogar(Request $request) {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('login');
    }

}
