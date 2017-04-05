<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/home';

    public function __construct(){
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function index() {
        return view('login.index'); 
    }

    public function logar(Request $request) {
        return $this->login($request); 
    }

    public function deslogar(Request $request) {
        return $this->logout($request);
    }
}
