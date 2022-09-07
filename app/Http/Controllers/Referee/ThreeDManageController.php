<?php

namespace App\Http\Controllers\Referee;

use auth;
use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\Agent;
use App\Models\threed;
use App\Models\Referee;
use App\Models\Lonepyine;
use App\Models\LonePyaing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ThreeDManageController extends Controller
{
    //
    public function ThreeDmanage()
    {
        $user = auth()->user()->id;
        $rate = DB::Select("SELECT t.compensation FROM threeds t where referee_id = $user ORDER BY id DESC LIMIT 1");
        $user = auth()->user();
                $currenDate = Carbon::now()->toDateString();
                $time = Carbon::Now()->toTimeString();
                if ($user) {
                    $agent = Agent::where('user_id', $user->id)->with('referee')->first();
                    $referee = Referee::where('user_id', $agent->referee->user_id)->with('user')->first();
                    if($time > 12){
                    $lonepyaing_sale_lists = DB::select("Select aa.number , aa.max_amount , aa.compensation , SUM(ts.sale_amount) as sales
                    from (SELECT * FROM
                     ( SELECT * FROM lonepyines t where referee_id = '$referee->id'
                     ORDER BY id DESC LIMIT 20 )sub ORDER BY id ASC) aa LEFT join agents on
                     aa.referee_id = agents.id LEFT join lonepyinesalelists ts on
                     ts.lonepyine_id = aa.id where aa.referee_id = '$referee->id' and aa.date = '$currenDate' and aa.round = 'Evening' group by aa.number, aa.max_amount , agents.id , aa.max_amount , aa.compensation");
                }
                else{
                    $lonepyaing_sale_lists = DB::select("Select aa.number , aa.max_amount , aa.compensation , SUM(ts.sale_amount) as sales
                    from (SELECT * FROM
                     ( SELECT * FROM lonepyines t where referee_id = '$referee->id'
                     ORDER BY id DESC LIMIT 20 )sub ORDER BY id ASC) aa LEFT join agents on
                     aa.referee_id = agents.id LEFT join lonepyinesalelists ts on
                     ts.lonepyine_id = aa.id where aa.referee_id = '$referee->id' and aa.date = '$currenDate' and aa.round = 'Morning' group by aa.number, aa.max_amount , agents.id , aa.max_amount , aa.compensation");
                }
                    }
                    // dump($lonepyaing_sale_lists);
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

                                // $data['message'] = 'Hello XpertPhp';
                            $pusher->trigger('testing-channel.'.$referee->id, 'App\\Events\\testing',  ['salesList' => $lonepyaing_sale_lists]);
                            return view('RefereeManagement.threedManage', compact('rate','lonepyaing_sale_lists'));

                            // return view('RefereeManagement.threedManage',compact('rate'));
    }

    public function TnLmanage()
    {
        $user = auth()->user()->id;
        $rate = DB::Select("SELECT t.compensation FROM threeds t where referee_id = $user ORDER BY id DESC LIMIT 1");
        $user = auth()->user();
                $currenDate = Carbon::now()->toDateString();
                $time = Carbon::Now()->toTimeString();
                if ($user) {
                    $agent = Agent::where('user_id', $user->id)->with('referee')->first();
                    $referee = Referee::where('user_id', $agent->referee->user_id)->with('user')->first();
                    if($time > 12){
                    $lonepyaing_sale_lists = DB::select("Select aa.number , aa.max_amount , aa.compensation , SUM(ts.sale_amount) as sales
                    from (SELECT * FROM
                     ( SELECT * FROM lonepyines t where referee_id = '$referee->id'
                     ORDER BY id DESC LIMIT 20 )sub ORDER BY id ASC) aa LEFT join agents on
                     aa.referee_id = agents.id LEFT join lonepyinesalelists ts on
                     ts.lonepyine_id = aa.id where aa.referee_id = '$referee->id' and aa.date = '$currenDate' and aa.round = 'Evening' group by aa.number, aa.max_amount , agents.id , aa.max_amount , aa.compensation");
                }
                else{
                    $lonepyaing_sale_lists = DB::select("Select aa.number , aa.max_amount , aa.compensation , SUM(ts.sale_amount) as sales
                    from (SELECT * FROM
                     ( SELECT * FROM lonepyines t where referee_id = '$referee->id'
                     ORDER BY id DESC LIMIT 20 )sub ORDER BY id ASC) aa LEFT join agents on
                     aa.referee_id = agents.id LEFT join lonepyinesalelists ts on
                     ts.lonepyine_id = aa.id where aa.referee_id = '$referee->id' and aa.date = '$currenDate' and aa.round = 'Morning' group by aa.number, aa.max_amount , agents.id , aa.max_amount , aa.compensation");
                }
                    }
                    // dump($lonepyaing_sale_lists);
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

                                // $data['message'] = 'Hello XpertPhp';
                            $pusher->trigger('testing-channel.'.$referee->id, 'App\\Events\\testing',  ['salesList' => $lonepyaing_sale_lists]);
                            return response()->json([
                                'status' => 200,
                                'data' => ['salesList' => $lonepyaing_sale_lists]
                            ]);

                            // return view('RefereeManagement.threedManage',compact('rate'));
    }

    public function ThreeDManageCreate(Request $request)
    {
        $rate = $request->number;
        $date = Carbon::Now();
        $time = Carbon::Now()->toTimeString();
        $user = auth()->user()->id;
        for($i=0; $i <= 999 ; $i++){
            if(strlen($i) == 1){
            $threeD = new threed();
            $threeD->number = '00'.$i;
            $threeD->compensation = $rate;
            $threeD->date = $date;
            $threeD->referee_id = $user;
            $threeD->save();
            }
            elseif(strlen($i) == 2){
                $threeD = new threed();
                $threeD->number = '0'.$i;
                $threeD->compensation = $rate;
                $threeD->date = $date;
                $threeD->referee_id = $user;
                $threeD->save();
                }
            else{
            $threeD = new threed();
            $threeD->number = $i;
            $threeD->compensation = $rate;
            $threeD->date = $date;
            $threeD->referee_id = $user;
            $threeD->save();
            }

        }
        return redirect()->back();
    }
    public function LonePyaingManageCreate(Request $request)
    {
    //     return response()->json([
    //         'success' => 'success',
    //         'data' => $request->lonepyaing,
    // ]);
    $lonePyaingList = $request->lonepyaing; // json string
    $date = Carbon::Now();
    $time = Carbon::Now()->toTimeString();
    $user = auth()->user()->id;
    if($time > 12){
        foreach ($lonePyaingList as $lonePyaingLists) {
            $LonePyaing = new Lonepyine();
           //  intval($num)
            $maxAmt = $lonePyaingLists['maxAmount'];
            $comp = $lonePyaingLists['compensation'];
            $LonePyaing->number = $lonePyaingLists['lonepyineNumber'];
            $LonePyaing->date = $date;
            $LonePyaing->max_amount = intval($maxAmt);
            $LonePyaing->compensation = intval($comp);
            $LonePyaing->round =  'Evening';
            $LonePyaing->referee_id = $user;
            $LonePyaing->save();
        }
    }
    else{
        foreach ($lonePyaingList as $lonePyaingLists) {
            $LonePyaing = new Lonepyine();
           //  intval($num)
            $maxAmt = $lonePyaingLists['maxAmount'];
            $comp = $lonePyaingLists['compensation'];
            $LonePyaing->number = $lonePyaingLists['lonepyineNumber'];
            $LonePyaing->date = $date;
            $LonePyaing->max_amount = intval($maxAmt);
            $LonePyaing->compensation = intval($comp);
            $LonePyaing->round =  'Morning';
            $LonePyaing->referee_id = $user;
            $LonePyaing->save();
        }
    }
}

}

