<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ARController extends Controller
{
    public function murales($idioma){
        return view("ar.murales", compact("idioma"));
    }

    public function muralesQR(){
        $idioma = 1;
        return view("ar.qr", compact("idioma"));
    }

    public function muralesVD($idioma){
        return view("ar.video", compact("idioma"));
    }

    public function muralesRA(){
        return view("ar.ra");
    }
}
