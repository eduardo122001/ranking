<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Obtener las notas ordenadas desde la más reciente
        $historial = $user->registros()
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($registro) {
                
                // Pesos por defecto asignados por el sistema (35%, 35%, 15%, 15%)
                $w1 = 0.35;
                $w2 = 0.35;
                $w3 = 0.15;
                $w4 = 0.15;

                // Calcular el Score Final ponderado
                $finalScore = ($registro->rendimiento * $w1) 
                            + ($registro->comportamiento * $w2) 
                            + ($registro->pagos * $w3) 
                            + ($registro->referente * $w4);

                $registro->final_score = $finalScore;
                
                return $registro;
            });

        // 2. Calcular el Promedio Histórico General
        $promedioHistorico = $historial->count() > 0 
            ? $historial->avg('final_score') 
            : 0;

        // 3. CÁLCULO DINÁMICO: Comparativa vs Periodo Anterior
        $diferenciaPeriodoAnterior = "0.0%"; // Fallback si no hay suficientes semestres

        if ($historial->count() >= 2) {
            $ultimoScore = $historial->get(0)->final_score;   // Elemento más reciente
            $anteriorScore = $historial->get(1)->final_score; // Elemento penúltimo

            if ($anteriorScore > 0) {
                // Aplicamos la fórmula matemática de incremento/decremento
                $variacion = (($ultimoScore - $anteriorScore) / $anteriorScore) * 100;
                
                // Formateamos el texto con el signo correspondiente (+ o -)
                $signo = $variacion >= 0 ? '+' : '';
                $diferenciaPeriodoAnterior = $signo . number_format($variacion, 1) . '%';
            }
        } elseif ($historial->count() === 1) {
            // Si es su primer semestre en la plataforma, la base de comparación es el mismo score
            $diferenciaPeriodoAnterior = "+0.0%";
        }

        return view('historial', compact('historial', 'promedioHistorico', 'diferenciaPeriodoAnterior'));
    }
}