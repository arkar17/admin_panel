<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Pusher\Pusher;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Lonepyine;
use App\Models\Lonepyinesalelist;
use App\Models\Threed;
use App\Models\Threedsalelist;
use App\Models\Twod;
use App\Models\Twodsalelist;
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
        // $validator = Validator::make($request->all(), [
        //     'twod_id' => 'required',
        //     'client_id' => 'required',
        //     'sale_amount' => 'required',
        //     'customer_name' => 'required',
        //     'customer_phone' => 'required'
        // ]);


        // if($validator->fails()) {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'Validation Error!',
        //         'data' => $validator->errors()
        //     ]);
        // }


        $user = auth()->user();

        if ($user) {
            $sale_lists = $request->all(); // json string
            $sale_lists =  json_decode(json_encode($sale_lists));  // change to json object from json string

            foreach ($sale_lists->twoDSalesList as $sale) {
                $twod_sale_list = new Twodsalelist();

                $twod_sale_list->twod_id = $sale->twod_id;
                $twod_sale_list->agent_id = $sale->agent_id;
                $twod_sale_list->sale_amount = $sale->sale_amount;
                $twod_sale_list->customer_name = $sale->customer_name;
                $twod_sale_list->customer_phone = $sale->customer_phone;

                $twod_sale_list->save();
            }

            return response()->json([
                'status' => 200,
                'message' => "TwoD Lists added successfully!"
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized User!'
            ]);
        }
    }

    // Store 3D Sale List
    public function threeDSale(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'threed_id' => 'required',
            'client_id' => 'required',
            'sale_amount' => 'required',
            'customer_name' => 'required',
            'customer_phone' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error!',
                'data' => $validator->errors()
            ]);
        }

        $sale_lists = $request->all(); // json string
        $sale_lists =  json_decode(json_encode($sale_lists));  // change to json object from json string

        foreach ($sale_lists->threeDSalesList as $sale) {
            $threed_sale_list = new Threedsalelist();

            $threed_sale_list->threed_id = $sale->threed_id;
            $threed_sale_list->agent_id = $sale->agent_id;
            $threed_sale_list->sale_amount = $sale->sale_amount;
            $threed_sale_list->customer_name = $sale->customer_name;
            $threed_sale_list->customer_phone = $sale->customer_phone;

            $threed_sale_list->save();
        }

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
