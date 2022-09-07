<?php

namespace App\Http\Controllers\Referee;
use App\Models\Twodsalelist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TwodController extends Controller
{
    public function twoDSaleList(){
        $twoDSaleList = Twodsalelist::select('twodsalelists.id','twodsalelists.twod_id','twodsalelists.sale_amount',
        'twodsalelists.customer_name','users.name','twods.number')
        ->where('twodsalelists.status',1)
        ->orderBy('twodsalelists.id','desc')
        ->join('agents','agents.id','twodsalelists.agent_id')
        ->join('users','users.id','agents.user_id')
        ->join('twods','twods.id','twodsalelists.twod_id')
        ->get();
        //dd($twoDSaleList->toArray());
        return view('RefereeManagement.twodsalelist')->with(['twoDSaleList'=>$twoDSaleList]);
    }
    public function searchthwodagent(Request $request){
        $data = Twodsalelist::select('twodsalelists.id','twodsalelists.twod_id','twodsalelists.sale_amount',
        'twodsalelists.customer_name','users.name','twods.number')
        ->where('twodsalelists.status',1)
        ->where('users.name','like','%'.$request->searchagent.'%')
        ->join('agents','agents.id','twodsalelists.agent_id')
        ->join('users','users.id','agents.user_id')
        ->join('twods','twods.id','twodsalelists.twod_id')
        ->get();
        //dd($data->toArray());
        return view('RefereeManagement.twodsalelist')->with(['twoDSaleList'=>$data]);
    }

}
