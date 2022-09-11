<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Pusher\Pusher;

use App\Models\Twod;

use App\Models\Agent;
use App\Models\Threed;
use App\Models\Referee;
use App\Models\Lonepyine;
use App\Models\Twodsalelist;
use Illuminate\Http\Request;
use App\Models\Threedsalelist;
use App\Models\Lonepyinesalelist;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TwodThreeDController extends Controller
{
    //  2d numbers For AM
    public function getTwoDsAM()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $user = auth()->user();

        $current_date = Carbon::now('Asia/Yangon')->toDateString();

        if ($user) {
            $agent = Agent::where('user_id', $user->id)->first();
            $twods = Twod::where('referee_id', $agent->referee_id)
                ->where('round', 'morning')->where('date', $current_date)->latest()->take(100)->get();

            $pusher->trigger('notify-channel', 'App\\Events\\Notify', $twods);
            return response()->json([
                'status' => 200,
                'twods' => $twods
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized user!'
            ]);
        }
    }

    //  2d numbers For PM
    public function getTwoDsPM()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();

        if ($user) {
            $agent = Agent::where('user_id', $user->id)->first();
            $twods = Twod::where('referee_id', $agent->referee_id)
                ->where('round', 'evening')->where('date', $current_date)->latest()->take(100)->get();

            $pusher->trigger('notify-channel', 'App\\Events\\Notify', $twods);
            return response()->json([
                'status' => 200,
                'twods' => $twods
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized user!'
            ]);
        }
    }

    // 3d numbers
    public function getThreeDs()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();

        if ($user) {
            $agent = Agent::where('user_id', $user->id)->first();
            $threeds = Threed::where('referee_id', $agent->referee_id)->where('date', $current_date)->latest()->take(100)->get();
            $pusher->trigger('notify-channel', 'App\\Events\\Notify', $threeds);
            return response()->json([
                'status' => 200,
                'threeds' => $threeds
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized user!'
            ]);
        }
    }

    // Lonepyaing numbers For AM
    public function getLonePyaingsAM()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();

        if ($user) {
            $agent = Agent::where('user_id', $user->id)->first();
            $lonepyines = Lonepyine::where('referee_id', $agent->referee_id)
                ->where('round', 'morning')->where('date', $current_date)->latest()->take(100)->get();;

            $pusher->trigger('notify-channel', 'App\\Events\\Notify', $lonepyines);
            return response()->json([
                'status' => 200,
                'lonepyaings' => $lonepyines
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized user!'
            ]);
        }
    }

    // Lonepyaing numbers For PM
    public function getLonePyaingsPM()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();

        if ($user) {
            $agent = Agent::where('user_id', $user->id)->first();
            $lonepyines = Lonepyine::where('referee_id', $agent->referee_id)
                ->where('round', 'evening')->where('date', $current_date)->latest()->take(100)->get();;

            $pusher->trigger('notify-channel', 'App\\Events\\Notify', $lonepyines);
            return response()->json([
                'status' => 200,
                'lonepyines' => $lonepyines
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized user!'
            ]);
        }
    }

    // Store 2D Sale List
    public function twoDSale(Request $request)
    {

        $user = auth()->user();
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        if ($user) {
            $agent = Agent::where('user_id', $user->id)->with('referee')->first();
            $referee = Referee::where('user_id', $agent->referee->user_id)->with('user')->first();
            $sale_lists = $request->all(); // json string
            $sale_lists =  json_decode(json_encode($sale_lists));  // change to json object from json string

            foreach ($sale_lists->twoDSalesList as $sale) {
                $twod_sale_list = new Twodsalelist();
                $twod_sale_list->twod_id = $sale->twod_id;
                $twod_sale_list->agent_id = $sale->agent_id;
                $twod_sale_list->sale_amount = $sale->sale_amount;
                $twod_sale_list->customer_name = $sale->customer_name;
                $twod_sale_list->status = 0;
                $twod_sale_list->customer_phone = $sale->customer_phone;
                $twod_sale_list->save();

            }
            // $twodDList = Twodsalelist::where('status',0)->get();
            // $twodDList = DB::select("SELECT ts.agent_id,u.name,t.round,t.date FROM twodsalelists ts left join agents a on ts.agent_id = a.id left JOIN twods t on ts.twod_id = t.id left join users u on ts.agent_id = u.id group by ts.agent_id,u.name,t.round,t.date,ts.agent_id");
            $agentList = DB::select("SELECT ts.agent_id as id,u.name,t.round,t.date FROM twodsalelists ts left join agents a on ts.agent_id = a.id left JOIN twods t on ts.twod_id = t.id left join users u on ts.agent_id = u.id group by ts.agent_id,u.name,t.round,t.date,ts.agent_id");
            $twodList = DB::select("SELECT ts.agent_id as id , t.number,t.compensation,ts.sale_amount From twodsalelists ts LEFT join twods t on ts.twod_id = t.id and ts.status=0");

            // $agentList = Twodsalelist::select('twodsalelists.id','twodsalelists.agent_id','users.name','twods.round','twods.date')
            $agentList = Twodsalelist::select('twodsalelists.agent_id','users.name','twods.round','twods.date')
                                ->join('twods','twods.id','twodsalelists.twod_id')
                                ->join('agents','agents.id','twodsalelists.agent_id')
                                ->join('users','users.id','agents.user_id')
                                ->where('twodsalelists.agent_id',3)
                                ->groupBy('twodsalelists.agent_id','users.name','twods.round','twods.date','twodsalelists.id')
                               // ->orderBy('twodsalelists.id','desc')
                        ->get();
                        dd($agentList->toArray());
            // dump($agentList);
            $agent = ['agent'=>$agentList];
            $number = ['number'=>$twodList];
            // $arr = array($agentList,$twodList);


            $grouped = $agentList->mapToGroups(function ($item, $key) {
                return [$item['id'] => $item['number']];
            });
            dd($grouped->toArray());
            // foreach($agentList as $agent){
            //     $id = $agent->id;
            //     $twodList = DB::select("SELECT ts.agent_id as id , t.number,t.compensation,ts.sale_amount From twodsalelists ts LEFT join twods t on ts.twod_id = t.id and ts.status=0 and ts.agent_id = $id");
            // }
            // foreach( $twodList as &$row) {
            //     $row->cls = 0;
            //     $row->parentID = 1;
            // }
            // $result = array_merge($agentList,$twodList);
            // $output = array_values($output);
            // dump($output);
            // $result = array_merge($agent,$number);
            // $result =  $agent->merge($number);
            // foreach($agentList as $key=>$value){
            //     //
            //         $aid = $value->agent_id;
            //         foreach($value as $td){
            //         $twodList = DB::select("Select * From twodsalelists ts LEFT join twods t on ts.twod_id = t.id where ts.agent_id = $aid and ts.status=0");
            //         $agent = ['agent'=>$value];
            //         $number = ['number'=>$td];
            //         // $result = array_push(['agent'=>$agentList , 'number'=> $twodList]);
            //          $result = array_merge($agent,$number);
            //     }
            //     //dump($twodList);
            // }

            $pusher->trigger('twodbetlist-channel.'.$referee->id, 'App\\Events\\twodbetlist', ['twods' =>$twodList] );
            return response()->json([
                'status' => 200,
                'message' => ['twodList' =>$twodList],
            ]);


        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized User!'
            ]);
        }
    }

    // Store 3D Sale List
    // public function threeDSale(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'threed_id' => 'required',
    //         'client_id' => 'required',
    //         'sale_amount' => 'required',
    //         'customer_name' => 'required',
    //         'customer_phone' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 400,
    //             'message' => 'Validation Error!',
    //             'data' => $validator->errors()
    //         ]);
    //     }

    //     $sale_lists = $request->all(); // json string
    //     $sale_lists =  json_decode(json_encode($sale_lists));  // change to json object from json string

    //     foreach ($sale_lists->threeDSalesList as $sale) {
            // $threed_sale_list = new Threedsalelist();

            // $threed_sale_list->threed_id = $sale->threed_id;
            // $threed_sale_list->agent_id = $sale->agent_id;
            // $threed_sale_list->sale_amount = $sale->sale_amount;
            // $threed_sale_list->customer_name = $sale->customer_name;
            // $threed_sale_list->customer_phone = $sale->customer_phone;
            // $threed_sale_list->save();
    //     }

    //     return response()->json([
    //         'status' => 200,
    //         'message' => "ThreeD Lists added successfully!"
    //     ]);
    // }


    public function threeDSale(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'threed_id' => 'required',
        //     'agent_id' => 'required',
        //     'sale_amount' => 'required',
        //     'customer_name' => 'required',
        //     'customer_phone' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'Validation Error!',
        //         'data' => $validator->errors()
        //     ]);
        // }

        $sale_lists = $request->all(); // json string
        $sale_lists =  json_decode(json_encode($sale_lists));// change to json object from json string

        $threeDlist = DB::select("SELECT id,number FROM threeds t where referee_id = '1'  ORDER BY id ASC LIMIT 1000");


            foreach ($sale_lists->threeDSalesList as $sale) {

                    $threed_sale_list = new Threedsalelist();
                        foreach($threeDlist as $threeD){
                            // if($sale->number = $threeD->number){
                        $threed_sale_list->threed_id = $threeD->id;
                            // }
                                }
                    // $threed_sale_list->threed_id=Operationstaff::where('operationstaff_code','=',$otcode)->first();
                    $threed_sale_list->agent_id = $sale->agent_id;
                    $threed_sale_list->sale_amount = $sale->sale_amount;
                    $threed_sale_list->customer_name = $sale->customer_name;
                    $threed_sale_list->customer_phone = $sale->customer_phone;
                    $threed_sale_list->save();
                }


    // }
        return response()->json([
            'status' => 200,
            'message' => "ThreeD Lists added successfully!"
        ]);
    }

    // Store LonePyaing Sale List
    public function lonePyaingSale(Request $request)
    {
        $sale_lists = $request->all(); // json string
        $sale_lists =  json_decode(json_encode($sale_lists));  // change to json object from json string

        foreach ($sale_lists->lonePyaingSalesList as $sale) {
            $lonepyaing_sale_list = new Lonepyinesalelist();

            $lonepyaing_sale_list->lonepyine_id = $sale->lonepyine_id;
            $lonepyaing_sale_list->agent_id = $sale->agent_id;
            $lonepyaing_sale_list->sale_amount = $sale->sale_amount;
            $lonepyaing_sale_list->customer_name = $sale->customer_name;
            $lonepyaing_sale_list->customer_phone = $sale->customer_phone;

            $lonepyaing_sale_list->save();
        }

        return response()->json([
            'status' => 200,
            'message' => "LonePyaing Lists added successfully!"
        ]);
    }

    public function ShowTwoDPendingSaleLists()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();

        if ($user) {
            $agent = Agent::where('user_id', $user->id)->first();
            $pending_twod_lists = Twodsalelist::where('status', 0)
                ->where('agent_id', $agent->id)->with('twod')->whereHas('twod', function ($q) use ($current_date) {
                    $q->where('date', $current_date);
                })->get();
            $pusher->trigger('notify-channel', 'App\\Events\\Notify', $pending_twod_lists);
            return response()->json([
                'status' => 200,
                'accepted_lonepyaing_lists' => $pending_twod_lists
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ]);
        }
    }

    public function ShowThreeDPendingSaleLists()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();

        if ($user) {
            $agent = Agent::where('user_id', $user->id)->first();
            $pending_threed_lists = Threedsalelist::where('status', 0)
                ->where('agent_id', $agent->id)->with('threed')->whereHas('threed', function ($q) use ($current_date) {
                    $q->where('date', $current_date);
                })->get();
            $pusher->trigger('notify-channel', 'App\\Events\\Notify', $pending_threed_lists);
            return response()->json([
                'status' => 200,
                'accepted_lonepyaing_lists' => $pending_threed_lists
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ]);
        }
    }

    public function ShowLonePyinePendingSaleLists()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();

        if ($user) {
            $agent = Agent::where('user_id', $user->id)->first();
            $pending_lonepyine_lists = Lonepyinesalelist::where('status', 0)
                ->where('agent_id', $agent->id)->with('lonepyine')->whereHas('lonepyine', function ($q) use ($current_date) {
                    $q->where('date', $current_date);
                })->get();
            $pusher->trigger('notify-channel', 'App\\Events\\Notify', $pending_lonepyine_lists);
            return response()->json([
                'status' => 200,
                'pending_lonepyine_lists' => $pending_lonepyine_lists
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ]);
        }
    }
}
