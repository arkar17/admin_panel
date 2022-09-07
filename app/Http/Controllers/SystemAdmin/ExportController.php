<?php

namespace App\Http\Controllers\SystemAdmin;

use PDF;
use App\Models\Agent;
use App\Models\Referee;
use App\Models\Lonepyine;
use App\Exports\DataExport;
use App\Exports\ExportData;
use App\Models\Twodsalelist;
use Illuminate\Http\Request;
use App\Exports\RefereeExport;
use App\Models\Threedsalelist;
use App\Models\Lonepyinesalelist;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        //  return Excel::download(new RefereeExport, 'referee.xlsx');
         return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

    public function createPDF () {

        //$pdf = PDF::loadView('front.cars.pdfExport', compact('group_arr'));
        $referees = Referee::all();
        $pdf = PDF::loadView('system_admin.referee.show',compact('referees'));
        return $pdf->download('invoice.pdf');

    }

    public function customer_export(Request $request)
    {
        //  return Excel::download(new DataExport, 'customer_data.xlsx');
        return Excel::download(new ExportData($request->id), 'customer_data.xlsx');
    }

    public function customer_createPDF (Request $request) {

        //$pdf = PDF::loadView('front.cars.pdfExport', compact('group_arr'));
        $twodsalelists = Twodsalelist::all();
        $threedsalelists = Threedsalelist::all();
        $lonepyinesalelists = Lonepyinesalelist::all();
        $agent=Agent::findOrFail($request->id);
        $pdf = PDF::loadView('system_admin.referee.show',compact('twodsalelists','threedsalelists','lonepyinesalelists','agent'));
        return $pdf->download('customer_data.pdf');

    }
}
