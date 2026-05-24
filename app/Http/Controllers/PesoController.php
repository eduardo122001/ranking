<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peso;

class PesoController extends Controller
{
    public function index()
    {
        //$peso = Peso::first();
        $peso = Peso::latest('id')->first();


        /*if (!$peso) {

            $peso = Peso::create([
                'semestre_id' => 1,
                'rendimiento' => 0.35,
                'comportamiento' => 0.35,
                'pagos' => 0.15,
                'referente' => 0.15
            ]);
        }*/

        $peso->rendimiento = $peso->rendimiento * 100;
        $peso->comportamiento = $peso->comportamiento * 100;
        $peso->pagos = $peso->pagos * 100;
        $peso->referente = $peso->referente * 100;

        $total =
            $peso->rendimiento +
            $peso->comportamiento +
            $peso->pagos +
            $peso->referente;

        return view('pesos', compact('peso', 'total'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'rendimiento' => 'required|numeric|min:0|max:100',
            'comportamiento' => 'required|numeric|min:0|max:100',
            'pagos' => 'required|numeric|min:0|max:100',
            'referente' => 'required|numeric|min:0|max:100',
        ]);

        $total =
            $request->rendimiento +
            $request->comportamiento +
            $request->pagos +
            $request->referente;

        if ($total != 100) {
            return back()->with('error', 'La suma total debe ser 100%');
        }

        Peso::create([

            'semestre_id' => 1,

            'rendimiento' => $request->rendimiento / 100,

            'comportamiento' => $request->comportamiento / 100,

            'pagos' => $request->pagos / 100,

            'referente' => $request->referente / 100,
        ]);


        return back()->with('success', 'Pesos actualizados correctamente');
    }
}
