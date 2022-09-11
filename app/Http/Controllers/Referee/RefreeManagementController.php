<?php

namespace App\Http\Controllers\Referee;

use auth;
use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\Twod;
use App\Models\User;
use App\Models\Agent;
use App\Models\Client;
use App\Models\Referee;
use App\Models\Requests;
use App\Models\Lonepyine;
use App\Models\Twodsalelist;
use Illuminate\Http\Request;
use App\Models\Threedsalelist;
use App\Models\Lonepyinesalelist;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class RefreeManagementController extends Controller
{
    //
    public function agentData()
    {
        return view('RefereeManagement.agentdata');
    }
    public function agentList()
    {
        $agentrequests = User::where('status', '=', 1)->where('request_type', '=', 'Agent')->get();
        // return view('system_admin.requestlist.refereerequests',
        return view('RefereeManagement.agentRequestList', compact('agentrequests'));
    }
    public function agentAccept($id)
    {
        $user = User::findOrFail($id);
        $user->status = 2;
        $rfcode = strtoupper($user->referee_code);
        $referee = Referee::where('referee_code', '=', $rfcode)->first();
        if (!empty($referee->id)) {
            $referee_id = $referee->id;
        } else {
            return redirect()->back()->with('success', 'Invalid Referee ID');
        }
        $user->referee_code = $rfcode;
        $user->update();

        $agent = new Agent();

        $agent->user_id = $id;
        $agent->referee_id = $referee_id;
        $agent->save();

        return redirect()->back()->with('success', 'New Agent is created successfully!');
    }

    public function agentAcceptold($id, $client_id)
    {
        $refereerequest = User::findOrFail($id);
        $refereerequest->status = 'accept'; //0=pending,1=accept,2=decline
        $refereerequest->update();
        // $string = 'AG-00001';

        $countAgentID = User::count('agent_id');


        if ($countAgentID == 0) {
            $agent = User::findOrFail($client_id);
            $agent->status = 'agent';
            // $agent->agent_id= $string.intval($newid)+1;
            $agent->agent_id = 'AG00001';
            $agent->user_status = 'active'; //0=inactive,1=active
            $agent->parent_id = $refereerequest->operationstaff_id;
            $agent->update();
            return redirect()->back();
        } else {
            $LatestAgentID = User::max('agent_id');
            $newid = substr($LatestAgentID, 2, 5);
            // $string = substr($LatestAgentID, 0, 2);

            $agent = User::findOrFail($client_id);
            $agent->status = 'agent';
            $agent->agent_id = 'AG' . intval($newid) + 1;
            // $agent->agent_id= 'AG1';
            $agent->user_status = 'active'; //0=inactive,1=active
            $agent->parent_id = $refereerequest->operationstaff_id;
            $agent->update();
            return redirect()->back();
        }
    }
    // public function agentDecline($id)
    // {
    //     $refereerequest = Requests::findOrFail($id);
    //     $refereerequest->status = 'Decline';//0=pending,1=accept,2=decline
    //     $refereerequest->update();
    //     return redirect()->back();
    // }

    public function twoDmanage()
    {
        return view('RefereeManagement.twoDManage');
    }

    public function twoDManageCreate(Request $request)
    {
        //     return response()->json([
        //         'success' => 'success',
        //         'data' => $request->twod,
        // ]);
        $td_lists = $request->twod; // json string
        $td_lists =  json_decode(json_encode($td_lists));
        $date = Carbon::Now();
        $time = Carbon::Now()->toTimeString();
        $user = auth()->user()->id;
        if ($time > 12) {
            foreach ($td_lists as $td_lists) {
                $twod = new Twod();
                //  intval($num)
                $maxAmt = $td_lists->maxAmount;
                $comp = $td_lists->compensation;
                $twod->referee_id = $user;
                $twod->number = $td_lists->twodNumber;
                $twod->max_amount = intval($maxAmt);
                $twod->Compensation = intval($comp);
                $twod->date = $date;
                $twod->round =  'Evening';
                $twod->save();
            }
        } else {
            foreach ($td_lists as $td_lists) {
                $twod = new Twod();
                //  intval($num)
                $maxAmt = $td_lists->maxAmount;
                $comp = $td_lists->compensation;
                $twod->referee_id = $user;
                $twod->number = $td_lists->twodNumber;
                $twod->max_amount = intval($maxAmt);
                $twod->Compensation = intval($comp);
                $twod->date = $date;
                $twod->round =  'Morning';
                $twod->save();
            }
        }
    }


    public function tDListToAgentsAndReferee()
    {
        $user = auth()->user();
        $currenDate = Carbon::now()->toDateString();
        $time = Carbon::Now()->toTimeString();
        if ($user) {
            $agent = Agent::where('user_id', $user->id)->with('referee')->first();
            $referee = Referee::where('user_id', $agent->referee->user_id)->with('user')->first();
            // dd($referee);
            if ($time > 12) {
                $twoD_sale_lists = DB::select("Select aa.id,aa.number , aa.max_amount , aa.compensation , SUM(ts.sale_amount) as sales
            from (SELECT * FROM ( SELECT * FROM twods t where referee_id = '$referee->id' ORDER BY id DESC LIMIT 100 )sub ORDER BY id ASC) aa
            LEFT join agents on aa.referee_id = agents.id
            LEFT join twodsalelists ts on ts.twod_id = aa.id
            where aa.referee_id = '$referee->id'
            and aa.date = '$currenDate'
            and aa.round = 'Evening'
            group by aa.number, aa.max_amount , agents.id , aa.max_amount , aa.compensation");
            } else {
                $twoD_sale_lists = DB::select("Select aa.id,aa.number , aa.max_amount , aa.compensation , SUM(ts.sale_amount) as sales
            from (SELECT * FROM ( SELECT * FROM twods t where referee_id = '$referee->id' ORDER BY id DESC LIMIT 100 )sub ORDER BY id ASC) aa
            LEFT join agents on aa.referee_id = agents.id
            LEFT join twodsalelists ts on ts.twod_id = aa.id
            where aa.referee_id = '$referee->id'
            and aa.date = '$currenDate'
            and aa.round = 'Morning'
            group by aa.number, aa.max_amount , agents.id , aa.max_amount , aa.compensation");
            }
        }
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
        $pusher->trigger('testing-channel.' . $referee->id, 'App\\Events\\testing',  ['salesList' => $twoD_sale_lists]);
        return response()->json([
            'status' => 200,
            'data' => ['salesList' => $twoD_sale_lists]
        ]);
    }

    public function SendToAgentsAndReferee1()
    {
        return view('test');
    }

    // public function DailySales()
    // {
    //     $result = DB::select("SELECT ts.agent_id,SUM(ts.sale_amount) as SalesAmount,a.commision,
    //     ((a.commision/100)* SUM(ts.sale_amount)) as Result FROM twodsalelists ts
    //     left join agents a ON a.id = ts.agent_id group by ts.agent_id,a.commision");
    //         foreach($result as $re){
    //         //    dump($re->commission);
    //         }
    //     $agentList = DB::select("SELECT ts.agent_id,u.name,t.round,t.date FROM twodsalelists ts left join agents a on ts.agent_id = a.id left JOIN twods t on ts.twod_id = t.id left join users u on ts.agent_id = u.id group by ts.agent_id,u.name,t.round,t.date,ts.agent_id");
    //     // dump($agentList);
    //     foreach($agentList as $key=>$value){
    //         //
    //             $aid = $value->agent_id;
    //             foreach($value as $td){
    //             $twodList = DB::select("Select * From twodsalelists ts LEFT join twods t on ts.twod_id = t.id where ts.agent_id = $aid");
    //         }
    //         //dump($twodList);
    //     }

    //     // $twodList = $twodList->toArray();
    //     return view('RefereeManagement.dailySales',compact('agentList','twodList'));
    // }

    // public function dailysalebook()
    // {
        //         return response()->json([
        //         'success' => 'success',
        //         'data' => $request->saleList,
        // ]);
        // dump($request->saleList);
        // $agenttwodsaleList = Twodsalelist::select(
        //     'twodsalelists.id',
        //     'twodsalelists.agent_id',
        //     'twodsalelists.sale_amount',
        //     'twodsalelists.status',
        //     'twods.number',
        //     'twods.compensation',
        //     'twods.round',
        //     'users.name'
        // )
            // ->join('twods', 'twods.id', 'twodsalelists.twod_id')
            // ->join('agents', 'agents.id', 'twodsalelists.agent_id')
            // ->join('users', 'users.id', 'agents.user_id')
            // ->orderBy('twodsalelists.id', 'desc')
            // ->get();
        // dd($twodAccept->toArray());
        // $agentlonepyinesalelist = Lonepyinesalelist::select(
        //     'lonepyinesalelists.id',
        //     'lonepyines.number',
        //     'lonepyines.compensation',
        //     'lonepyines.round',
        //     'lonepyinesalelists.sale_amount',
        //     'lonepyinesalelists.agent_id',
        //     'users.name',
        //     'lonepyinesalelists.status'
        // )
        //     ->join('lonepyines', 'lonepyinesalelists.lonepyine_id', 'lonepyines.id')
        //     ->join('agents', 'agents.id', 'lonepyinesalelists.agent_id')
        //     ->join('users', 'users.id', 'agents.user_id')
        //     ->orderBy('lonepyinesalelists.id', 'desc')
        //     ->get();
        //dd($agentlonepyinesalelist->toArray());

        // $agentthreedsalelist = Threedsalelist::select(
        //     'threedsalelists.id',
        //     'threedsalelists.agent_id',
        //     'threedsalelists.sale_amount',
        //     'threedsalelists.status',
        //     'threeds.number',
        //     'threeds.compensation',
        //     'users.name'
        // )
        //     ->join('threeds', 'threeds.id', 'threedsalelists.threed_id')
        //     ->join('agents', 'agents.id', 'threedsalelists.agent_id')
        //     ->join('users', 'users.id', 'agents.user_id')
        //     ->orderBy('threedsalelists.id', 'desc')
        //     ->get();
        //dd($threedlist->toArray());
        // $acceptstatus = $agenttwodsaleList->where('status', 1);
    //     $twoDList = DB::select("SELECT * From twodsalelists limit 3");
    //     return view('RefereeManagement.dailysalebook',compact('twoDList'));
    // }


    // dailysalebook start
    public function dailysalebook(){
        $agenttwodsaleList = Twodsalelist::select('twodsalelists.id','twodsalelists.agent_id','twodsalelists.sale_amount','twodsalelists.status','twods.number',
                                'twods.compensation','twods.round','users.name')
                                ->join('twods','twods.id','twodsalelists.twod_id')
                                ->join('agents','agents.id','twodsalelists.agent_id')
                                ->join('users','users.id','agents.user_id')
                                ->groupBy('twodsalelists.agent_id')
                                ->orderBy('twodsalelists.id','desc')
                                ->where('twodsalelists.status',0)
                                ->get();
            //dd($agenttwodsaleList->toArray());
        $agenttwodsalenumber = Twodsalelist::select('twodsalelists.id','twodsalelists.agent_id','twodsalelists.sale_amount','twodsalelists.status','twods.number',
        'twods.compensation','twods.round','users.name')
        ->join('twods','twods.id','twodsalelists.twod_id')
        ->join('agents','agents.id','twodsalelists.agent_id')
        ->join('users','users.id','agents.user_id')
        ->where('twodsalelists.status',0)
        ->get();
                            //    dd($agenttwodsalenumber->toArray());
        $agentlonepyinesalelist = Lonepyinesalelist::select('lonepyinesalelists.id','lonepyines.number','lonepyines.compensation','lonepyines.round','lonepyinesalelists.sale_amount',
                            'lonepyinesalelists.agent_id','users.name','lonepyinesalelists.status')
                            ->join('lonepyines','lonepyinesalelists.lonepyine_id','lonepyines.id')
                            ->join('agents','agents.id','lonepyinesalelists.agent_id')
                            ->join('users','users.id','agents.user_id')
                            ->groupBy('lonepyinesalelists.agent_id')
                            ->orderBy('lonepyinesalelists.id','desc')
                            ->where('lonepyinesalelists.status',0)
                            ->get();
                            //dd($agentlonepyinesalelist->toArray());

        $agentlonepyinesalenumber = Lonepyinesalelist::select('lonepyinesalelists.id','lonepyines.number','lonepyines.compensation','lonepyines.round','lonepyinesalelists.sale_amount',
        'lonepyinesalelists.agent_id','users.name','lonepyinesalelists.status')
        ->join('lonepyines','lonepyinesalelists.lonepyine_id','lonepyines.id')
        ->join('agents','agents.id','lonepyinesalelists.agent_id')
        ->join('users','users.id','agents.user_id')
        ->where('lonepyinesalelists.status',0)
        ->get();
                        //dd($agentlonepyinesalelist->toArray());

        $agentthreedsalelist = Threedsalelist::select('threedsalelists.id','threedsalelists.agent_id','threedsalelists.sale_amount','threedsalelists.status',
                        'threeds.number','threeds.compensation','users.name')
                            ->join('threeds','threeds.id','threedsalelists.threed_id')
                            ->join('agents','agents.id','threedsalelists.agent_id')
                            ->join('users','users.id','agents.user_id')
                            ->groupBy('threedsalelists.agent_id')
                           ->orderBy('threedsalelists.id','desc')
                            ->where('threedsalelists.status',0)
                            ->get();


        $agentthreedsalenumber = Threedsalelist::select('threedsalelists.id','threedsalelists.agent_id','threedsalelists.sale_amount','threedsalelists.status',
            'threeds.number','threeds.compensation','users.name')
        ->join('threeds','threeds.id','threedsalelists.threed_id')
        ->join('agents','agents.id','threedsalelists.agent_id')
        ->join('users','users.id','agents.user_id')
        ->where('threedsalelists.status',0)
        ->get();
        //dd($threedlist->toArray());
        $acceptstatus = $agenttwodsaleList->where('status',1);

        //chart
        $agents = Agent::all();
        $twod_salelists = Twodsalelist::select('number','sale_amount')->orderBy('sale_amount', 'DESC')->join('twods','twods.id','twodsalelists.twod_id')->limit(10)->get();

        $lp_salelists = Lonepyinesalelist::select('number','sale_amount')->orderBy('sale_amount', 'DESC')->join('lonepyines','lonepyines.id','lonepyinesalelists.lonepyine_id')->limit(10)->get();
        $threed_salelists = Threedsalelist::select('number','sale_amount')->orderBy('sale_amount', 'DESC')->join('threeds','threeds.id','threedsalelists.threed_id')->get();


        $grouped = $agenttwodsalenumber->mapToGroups(function ($item, $key) {
            return [$item['name'] => $item['number']];
        });
        $numbergroup=$grouped->toArray();

        $grouped = $agenttwodsalenumber->mapToGroups(function ($item, $key) {
            return [$item['name'] => $item['id']];
        });
        $idgroup=$grouped->toArray();

        $grouped = $agenttwodsalenumber->mapToGroups(function ($item, $key) {
            return [$item['name'] => $item['compensation']];
        });
        $compengroup=$grouped->toArray();

        $grouped = $agenttwodsalenumber->mapToGroups(function ($item, $key) {
            return [$item['name'] => $item['sale_amount']];
        });
        $salegroup=$grouped->toArray();


        //for lonepyine
        $grouped = $agentlonepyinesalenumber->mapToGroups(function ($item, $key) {
            return [$item['name'] => $item['number']];
        });
        $lp_numbergroup=$grouped->toArray();

        $grouped = $agentlonepyinesalenumber->mapToGroups(function ($item, $key) {
            return [$item['name'] => $item['id']];
        });
        $lp_idgroup=$grouped->toArray();


        $grouped = $agentlonepyinesalenumber->mapToGroups(function ($item, $key) {
            return [$item['name'] => $item['compensation']];
        });
        $lp_compengroup=$grouped->toArray();

        $grouped = $agentlonepyinesalenumber->mapToGroups(function ($item, $key) {
            return [$item['name'] => $item['sale_amount']];
        });
        $lp_salegroup=$grouped->toArray();

        //for 3D
        $grouped = $agentthreedsalenumber->mapToGroups(function ($item, $key) {
            return [$item['name'] => $item['number']];
        });
        $threed_numbergroup=$grouped->toArray();

        $grouped = $agentthreedsalenumber->mapToGroups(function ($item, $key) {
            return [$item['name'] => $item['id']];
        });
        $threed_idgroup=$grouped->toArray();

        $grouped = $agentthreedsalenumber->mapToGroups(function ($item, $key) {
            return [$item['name'] => $item['compensation']];
        });
        $threed_compengroup=$grouped->toArray();

        $grouped = $agentthreedsalenumber->mapToGroups(function ($item, $key) {
            return [$item['name'] => $item['sale_amount']];
        });
        $threed_salegroup=$grouped->toArray();

        //dd($salegroup);
        return view('RefereeManagement.dailysalebook', compact('agents','twod_salelists','numbergroup','compengroup',
        'salegroup','lp_numbergroup','lp_compengroup','lp_salegroup','lp_salelists','threed_numbergroup','threed_compengroup','threed_salegroup',
        'threed_salelists','agenttwodsaleList','agenttwodsalenumber', 'acceptstatus', 'agentlonepyinesalelist','agentthreedsalelist','idgroup','lp_idgroup','threed_idgroup'));
    }

//accept
    public function update(Request $request){
        foreach($request->id as $re){
            $twoDSalesList = Twodsalelist::where('id',$re)
            ->update(["status" => 1]);
        }
        return redirect()->back()->with('success', 'Status Update!');
    }
    public function lpupdate(Request $request){
        foreach($request->id as $re){
            $lpSalesList = Lonepyinesalelist::where('id',$re)
            ->update(["status" => 1]);
        }
        return redirect()->back()->with('success', 'Status Update!');
    }
    public function threedupdate(Request $request){
        foreach($request->id as $re){
            $lpSalesList = Threedsalelist::where('id',$re)
            ->update(["status" => 1]);
        }
        return redirect()->back()->with('success', 'Status Update!');
    }




 //decline
    public function declineTwod(Request $request){
        foreach($request->id as $re){
            $twoDSalesList = Twodsalelist::where('id',$re)
            ->update(["status" => 2]);
        }
        return redirect()->back()->with('success', 'Status Update!');
    }
    public function declinelp(Request $request){
        foreach($request->id as $re){
            $lpSalesList = Lonepyinesalelist::where('id',$re)
            ->update(["status" => 2]);
        }
        return redirect()->back()->with('success', 'Status Update!');
    }
    public function declineThreed(Request $request){
        foreach($request->id as $re){
            $lpSalesList = Threedsalelist::where('id',$re)
            ->update(["status" => 2]);
        }
        return redirect()->back()->with('success', 'Status Update!');
    }

    //dailysalebook end

    public function twodlist()
    {
        $user = auth()->user()->id;
        $currenDate = Carbon::now()->toDateString();
        $time = Carbon::Now()->toTimeString();
        $twoD_sale_lists = DB::select("Select aa.number , aa.max_amount , aa.compensation , SUM(ts.sale_amount) as sales
        from (SELECT * FROM ( SELECT * FROM twods t where referee_id = '$user' ORDER BY id DESC LIMIT 100 )sub ORDER BY id ASC) aa
        LEFT join agents on aa.referee_id = agents.id
        LEFT join twodsalelists ts on ts.twod_id = aa.id
        where aa.referee_id = '$user'
        and aa.date = '$currenDate'
        group by aa.number, aa.max_amount , agents.id , aa.max_amount , aa.compensation");

        return response()->json([
            'status' => 200,
            'data' => ['salesList' => $twoD_sale_lists]
        ]);
    }

    public function lonepyinelist()
    {
        $user = auth()->user()->id;
        $currenDate = Carbon::now()->toDateString();
        $time = Carbon::Now()->toTimeString();
        $lonepyaing_sale_lists = DB::select("Select aa.number , aa.max_amount , aa.compensation , SUM(ts.sale_amount) as sales
        from (SELECT * FROM
         ( SELECT * FROM lonepyines t where referee_id = '$user'
         ORDER BY id DESC LIMIT 20 )sub ORDER BY id ASC) aa LEFT join agents on
         aa.referee_id = agents.id LEFT join lonepyinesalelists ts on
         ts.lonepyine_id = aa.id where aa.referee_id = '$user' and aa.date = '$currenDate' group by aa.number, aa.max_amount , agents.id , aa.max_amount , aa.compensation");

        return response()->json([
            'status' => 200,
            'data' => ['salesList' => $lonepyaing_sale_lists]
        ]);
    }

    // Accept & decline

    public function  twodAccept($id)
    {
        //dd($id);
        $twodrequest = Twodsalelist::findOrFail($id);
        $twodrequest->status = 1;
        $twodrequest->update();
        return redirect()->back()->with(['twodaccept' => '2D Accepted Success']);
    }
    public function  twodDecline($id)
    {
        //dd($id);
        $twodrequest = Twodsalelist::findOrFail($id);
        $twodrequest->status = 2;
        $twodrequest->update();
        return redirect()->back()->with(['twoddecline' => '2D Decline Success !']);
    }
    public function  lonepyineAccept($id)
    {
        //dd($id);d
        $lonepyinerequest = Lonepyinesalelist::findOrFail($id);
        $lonepyinerequest->status = 1;
        $lonepyinerequest->update();
        return redirect()->back()->with(['lonepyineaccept' => 'Lone Pyine Accepted Success']);
    }
    public function lonepyinedecline($id)
    {
        //dd($id);
        $lonepyinerequest = Lonepyinesalelist::findOrFail($id);
        $lonepyinerequest->status = 2;
        $lonepyinerequest->update();
        return redirect()->back()->with(['lonepyinedecline' => 'Lone pyine Decline Success!']);
    }
    public function  threedAccept($id)
    {
        //dd($id);
        $lonepyinerequest = Threedsalelist::findOrFail($id);
        $lonepyinerequest->status = 1;
        $lonepyinerequest->update();
        return redirect()->back()->with(['threedaccept' => '3D Accepted Success']);
    }
    public function threeddecline($id)
    {
        //dd($id);
        $lonepyinerequest = Threedsalelist::findOrFail($id);
        $lonepyinerequest->status = 2;
        $lonepyinerequest->update();
        return redirect()->back()->with(['threeddecline' => '3D Decline Success!']);
    }
}
