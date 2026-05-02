<?php

namespace App\Imports;

use App\Models\Nota;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NotasImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Nota([
            'dni' => $row['dni'],
            'nombre' => $row['nombre'],
            'aspecto1' => $row['nota_aspecto_1'],
            'aspecto2' => $row['nota_aspecto_2'],
            'aspecto3' => $row['nota_aspecto_3'],
            'aspecto4' => $row['nota_aspecto_4'],   
        ]);
    }
}
