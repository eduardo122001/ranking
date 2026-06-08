<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $historial = $user->registros()
            ->with(['semestre.peso']) // Cargamos la relación para no hacer consultas de más (Eager Loading)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($registro) {
                
                // 1. EXTRAER PESOS DINÁMICOS DEL SEMESTRE (con valores por defecto si no existen)
                $pesoConfig = $registro->semestre->peso ?? null;

                $w1 = $pesoConfig ? $pesoConfig->rendimiento : 0.35; // Ej: 0.35
                $w2 = $pesoConfig ? $pesoConfig->comportamiento : 0.35;
                $w3 = $pesoConfig ? $pesoConfig->pagos : 0.15;
                $w4 = $pesoConfig ? $pesoConfig->referente : 0.15;

                // Guardamos los pesos dentro del registro para usarlos en la vista Blade
                $registro->peso_rendimiento = $w1 * 100; // Guardar como porcentaje (35%)
                $registro->peso_comportamiento = $w2 * 100;
                $registro->peso_pagos = $w3 * 100;
                $registro->peso_referente = $w4 * 100;

                // 2. CALCULAR SCORE FINAL (En base a 2000, sin dividir)
                $finalScore = ($registro->rendimiento * $w1) 
                            + ($registro->comportamiento * $w2) 
                            + ($registro->pagos * $w3) 
                            + ($registro->referente * $w4);

                $registro->final_score = $finalScore;

                // 3. CALCULAR PORCENTAJES DE LAS BARRAS (Nota actual / 2000 * 100)
                // Esto evitará los bugs de 10,000% en la interfaz
                $registro->pct_rendimiento = min(($registro->rendimiento / 2000) * 100, 100);
                $registro->pct_comportamiento = min(($registro->comportamiento / 2000) * 100, 100);
                $registro->pct_pagos = min(($registro->pagos / 2000) * 100, 100);
                $registro->pct_referente = min(($registro->referente / 2000) * 100, 100);
                
                return $registro;
            });

        // Promedio Histórico General (escala 2000)
        $promedioHistorico = $historial->count() > 0 
            ? $historial->avg('final_score') 
            : 0;

        // Cálculo de variación lineal simple entre periodos
        $diferenciaPeriodoAnterior = "0.0%";
        if ($historial->count() >= 2) {
            $ultimoScore = $historial->get(0)->final_score;
            $anteriorScore = $historial->get(1)->final_score;

            if ($anteriorScore > 0) {
                $variacion = (($ultimoScore - $anteriorScore) / $anteriorScore) * 100;
                $signo = $variacion >= 0 ? '+' : '';
                $diferenciaPeriodoAnterior = $signo . number_format($variacion, 1) . '%';
            }
        }

        return view('historial', compact('historial', 'promedioHistorico', 'diferenciaPeriodoAnterior'));
    }
}