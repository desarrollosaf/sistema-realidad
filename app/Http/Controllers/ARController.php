<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ARController extends Controller
{
    public function murales($idioma){
        return view("ar.murales", compact("idioma"));
    }

    public function muralesQR(){
        return view("ar.qr");
    }
}
