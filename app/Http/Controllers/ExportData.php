<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataTmpl1ExportBaru;

class ExportData extends Controller
{
    public function showDownloadData()
    {
        return view('data.downloadExcel');
    }

    public function downloadData(Request $request)
    {
        return Excel::download(new DataTmpl1Export, 'data.xlsx');
    }
}
