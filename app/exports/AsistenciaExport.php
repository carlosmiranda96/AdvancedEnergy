<?php

namespace App\Exports;

use App\Models\marcacionesempleados;
use DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AsistenciaExport implements FromArray,ShouldAutoSize
{
    protected $asistencia;
    /**
    * @return \Illuminate\Support\Collection
    */
    Public function __construct($asis = null)
    {
        $this->asistencia = $asis;
    }
    public function array():array
    {
         return $this->asistencia;
    }
}