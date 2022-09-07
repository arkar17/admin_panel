<?php

namespace App\Http\Controllers\Referee;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Lonepyinesalelist;

class LonePyineController extends Controller
{

    public function lonepyineSaleList(){
        $lonepyineSaleList = Lonepyinesalelist::select('lonepyinesalelists.id','lonepyinesalelists.lonepyine_id','lonepyinesalelists.sale_amount',
        'lonepyinesalelists.customer_name','users.name','lonepyines.number')
        ->where('lonepyinesalelists.status',1)
        ->join('agents','agents.id','lonepyinesalelists.agent_id')
        ->join('users','users.id','agents.user_id')
        ->join('lonepyines','lonepyines.id','lonepyinesalelists.lonepyine_id')
        ->get();

        //dd($lonepyineSaleList->toArray());
        return view('RefereeManagement.lonepyinesalelist')->with(['lonepyineSaleList'=>$lonepyineSaleList]);
    }
    public function searchlonepyineagent(Request $request){
        $data =  Lonepyinesalelist::select('lonepyinesalelists.id','lonepyinesalelists.lonepyine_id','lonepyinesalelists.sale_amount',
        'lonepyinesalelists.customer_name','users.name','lonepyines.number')
        ->where('lonepyinesalelists.status',1)
        ->where('users.name','like','%'.$request->searchagent.'%')
        ->join('agents','agents.id','lonepyinesalelists.agent_id')
        ->join('users','users.id','agents.user_id')
        ->join('lonepyines','lonepyines.id','lonepyinesalelists.lonepyine_id')
        ->get();
        return view('RefereeManagement.lonepyinesalelist')->with(['lonepyineSaleList'=>$data]);
    }
}
