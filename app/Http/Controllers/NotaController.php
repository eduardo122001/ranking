<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\NotasImport;

class NotaController extends Controller
{
    public function form()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        // Validar archivo
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        // Importar Excel
        Excel::import(
            new NotasImport,
            $request->file('file')
        );

        return back()->with(
            'success',
            'Datos importados correctamente'
        );
    }
}