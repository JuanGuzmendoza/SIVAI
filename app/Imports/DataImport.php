<?php

namespace App\Imports;

use App\Models\Inventario;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
class DataImport implements ToCollection, WithHeadingRow
{
    protected $profesor_id;

    public function __construct($profesor_id)
    {
        $this->profesor_id = $profesor_id;
    }
    public function collection(Collection $rows)
    {

        foreach($rows as $row){
        //   dd($row);

          $valores = array_values($row->toArray()); // Convierte a array y obtiene los valores
          $fechaAdquisicion = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($valores[10])->format('Y-m-d');
          
          Inventario::create([
            'R' => $valores[0], // Primer valor
            'centro' => $valores[1], // Segundo valor
            'modelo' => $valores[2], // Tercer valor
            'consec' => $valores[3], // Cuarto valor
            'desc' => $valores[4], // Quinto valor
            'descripcion_actual' => $valores[5], // Sexto valor
            'tipo' => $valores[6], // Séptimo valor
            'mod' => $valores[7], // Octavo valor
            'placa' => $valores[8], // Noveno valor
            'atributos' => $valores[9], // Décimo valor
            'fecha_adquisicion' => $fechaAdquisicion, // Usar la fecha convertida
            'valor_ingreso' => $valores[11], // Duodécimo valor
            'ambiente_id' => $valores[12], // Decimotercer valor
            'profesor_id' => $this->profesor_id,
        ]);
    }

    }
}
