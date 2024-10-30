<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FechasExport implements FromView, WithStyles
{
    public function view(): View
    {
        return view('plantilla');
    }

    public function styles(Worksheet $sheet)
    {
        // Estilo para el encabezado (primera fila)
        $sheet->getStyle('A1:M1')->getFont()->setBold(true); // Negrita
        $sheet->getStyle('A1:M1')->getFont()->getColor()->setARGB('FFFFFF'); // Color de letra blanco
        $sheet->getStyle('A1:M1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:M1')->getFill()->getStartColor()->setARGB('FF28A745'); // Color de fondo verde

        // Configurar bordes para el encabezado
        $sheet->getStyle('A1:M1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Configurar alineación del texto en el encabezado
        $sheet->getStyle('A1:M1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    }
}
