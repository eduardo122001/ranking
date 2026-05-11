<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NotasImport;

class NotaController extends Controller //modificar esto o eliminarlo, esto funcionaba con mi bd de prueba chiquita
{
    public function form()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new NotasImport, $request->file('file'));

        return back()->with('success', 'Datos importados correctamente');
    }
}