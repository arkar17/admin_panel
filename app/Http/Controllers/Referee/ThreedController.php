<?php

namespace App\Http\Controllers\Referee;
use App\Http\Controllers\Controller;

use App\Models\Threed_Sales_list;
use App\Models\Threedsalelist;
use Illuminate\Http\Request;

class ThreedController extends Controller
{
    public function threeDSaleList(){
        $threeDSaleList = Threedsalelist::select('threedsalelists.id','threedsalelists.threed_id','threedsalelists.sale_amount',
        'threedsalelists.customer_name','users.name','threeds.number')
        ->where('threedsalelists.status',1)
        ->orderBy('threedsalelists.id','desc')
        ->join('threeds','threeds.id','threedsalelists.threed_id')
        ->join('agents','agents.id','threedsalelists.agent_id')
        ->join('users','users.id','agents.user_id')
        ->get();
        //dd($threeDSaleList->toArray());
        return view('RefereeManagement.threedsalelist')->with(['threeDSaleList'=>$threeDSaleList]);
    }

    public function searchthreeddagent(Request $request){
        $data = Threedsalelist::select('threedsalelists.id','threedsalelists.threed_id','threedsalelists.sale_amount',
        'threedsalelists.customer_name','users.name','threeds.number')
        ->where('threedsalelists.status',1)
        ->where('users.name','like','%'.$request->searchagent.'%')
        ->join('threeds','threeds.id','threedsalelists.threed_id')
        ->join('agents','agents.id','threedsalelists.agent_id')
        ->join('users','users.id','agents.user_id')
        ->get();

        return view('RefereeManagement.threedsalelist')->with(['threeDSaleList'=>$data]);
    }
}
