<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class ExportController extends Controller
{
    public function export()
    {
        $timestamp = Carbon::now()->timestamp;
        $file_name = 'data_' . $timestamp . '.xlsx';
        return Excel::download(new DataExport, $file_name);
    }
}
