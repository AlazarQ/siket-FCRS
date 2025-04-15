<?php

namespace App\Exports;

use App\Models\FCY_Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class FcyRequestExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FCY_Request::all();
    }
}
