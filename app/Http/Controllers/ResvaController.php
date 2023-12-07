<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use Illuminate\Support\Facades\Auth;

class ResvaController extends Controller
{
    public function index_add_resva()
    {
        if (Auth::check() === false ) {
            return redirect()->route('login');
        }

        $postes = Poste::all();
        return view('add.res-va', ['postes' => $postes]);
    }

}
