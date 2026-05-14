<?php

namespace App\Http\Controllers;

use App\Models\VisitCounter;
use Illuminate\Http\Request;

class VisitCounterController extends Controller
{
    public function registrar(Request $request)
    {
        $ruta = $request->input('ruta', '/');

        $registro = VisitCounter::firstOrCreate(
            ['ruta' => $ruta],
            ['contador' => 0]
        );

        $registro->increment('contador');

        return response()->json(['contador' => $registro->fresh()->contador]);
    }
}
