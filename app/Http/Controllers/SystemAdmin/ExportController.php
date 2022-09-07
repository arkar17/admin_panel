<?php

namespace App\Http\Controllers\SystemAdmin;

use Illuminate\Routing\Controller;
use PDF;
use App\Models\Agent;
use App\Models\Referee;
use App\Exports\DataExport;
use App\Models\Twodsalelist;
use Illuminate\Http\Request;
use App\Exports\RefereeExport;
use App\Models\Lonepyine;
use App\Models\Lonepyinesalelist;
use App\Models\Threedsalelist;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
         return Excel::download(new RefereeExport, 'referee.xlsx');
    }

    public function createPDF () {

        //$pdf = PDF::loadView('front.cars.pdfExport', compact('group_arr'));
        $referees = Referee::all();
        $pdf = PDF::loadView('system_admin.referee.show',compact('referees'));
        return $pdf->download('invoice.pdf');

    }

    public function customer_export()
    {
         return Excel::download(new DataExport, 'customer_data.xlsx');
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
