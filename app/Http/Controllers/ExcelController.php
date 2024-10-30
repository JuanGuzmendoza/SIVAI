<?php

namespace App\Http\Controllers;

use App\Exports\FechasExport;
use App\Models\Ambiente;
use App\Models\Inventario;
use App\Models\Profesores;
use Illuminate\Http\Request;
use  App\Imports\DataImport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{

    public function form()
    {
        return view('formulario');
    }
    public function import(Request $request)
    {
        $file = $request->file('fileInput');
        Excel::import(new DataImport($request->profesor_id), $file);
        $Inventario=Inventario::all();
        $Profesores=Profesores::all();
        $Inventario=Inventario::all();
        $Ambientes=Ambiente::all();
        return view('dashboard',compact('Ambientes','Profesores','Inventario'));
    }

    public function export()
    {

        return Excel::download(new FechasExport(),'plantilla.xlsx');
    }
}

