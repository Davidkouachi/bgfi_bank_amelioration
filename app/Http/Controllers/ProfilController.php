<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProfilController extends Controller
{
    public function index_profil() 
    {
        return view('user.profil');
    }

}
