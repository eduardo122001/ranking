<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $query = Log::with([
            'autor',
            'accion'
        ]);

        // filtro por autor
        if ($request->filled('autor')) {

            $query->whereHas('autor', function ($q) use ($request) {

                $q->where(
                    'name',
                    'like',
                    '%' . $request->autor . '%'
                );

            });
        }

        // fecha desde
        if ($request->filled('fecha_desde')) {

            $query->whereDate(
                'created_at',
                '>=',
                $request->fecha_desde
            );
        }

        // fecha hasta
        if ($request->filled('fecha_hasta')) {

            $query->whereDate(
                'created_at',
                '<=',
                $request->fecha_hasta
            );
        }

        $logs = $query
            ->latest()
            ->paginate(20);

        return view(
            'reportes',
            compact('logs')
        );
    }
}