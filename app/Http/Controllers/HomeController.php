<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth'); // XXX: Capaz de essa middleware ser quem impede alguns dos flashs de sessão
    }

    public function index(Request $request) {
        return view('welcome');
    }
}
