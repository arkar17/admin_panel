<?php

namespace App\Http\Controllers\SystemAdmin;
use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\Twod;
use App\Models\User;
use App\Models\Guest;
use App\Models\Client;
use App\Models\Threed;
use App\Models\Lonepyine;
use App\Models\Twodsalelist;
use Illuminate\Http\Request;
use App\Models\WinningNumber;
use App\Models\Threedsalelist;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function index()
    {
        $users=User::where('status','=','0')->get();
//         $options = array(
//             'cluster' => env('PUSHER_APP_CLUSTER'),
//             'encrypted' => true
//             );
//             $pusher = new Pusher(
//             env('PUSHER_APP_KEY'),
//             env('PUSHER_APP_SECRET'),
//             env('PUSHER_APP_ID'),
//             $options
//             );

// $data['message'] = 'Hello XpertPhp';
// $pusher->trigger('notify-channel', 'App\\Events\\Notify', $data);
        return view('system_admin.home',compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect ()->back()->with('success', 'User is deleted successfully!');
    }

    public function viewWinning(Request $request)
    {
        $twodnumbers=DB::select('Select u.name,two.round,two.number,two.date,ts.id,ts.customer_name,ts.customer_phone,ts.datetime From agents a left join twodsalelists ts on ts.agent_id = a.id LEFT join twods two on two.id=ts.twod_id LEFT join users u on u.id=a.user_id where ts.winning_status = 1 and two.date=CURRENT_DATE;');
        $lonepyinenumbers=DB::select('Select u.name,l.round,l.number,lps.id,l.date,lps.customer_name,lps.customer_phone,lps.datetime From agents a left join lonepyinesalelists lps on lps.agent_id = a.id LEFT join lonepyines l on l.id=lps.lonepyine_id LEFT join users u on u.id=a.user_id where lps.winning_status = 1 and l.date=CURRENT_DATE;');
        $threednumbers=DB::select('Select u.name,t.number,ts.id,t.date,ts.customer_name,ts.customer_phone,ts.datetime From agents a left join threedsalelists ts on ts.agent_id = a.id LEFT join threeds t on t.id=ts.threed_id LEFT join users u on u.id=a.user_id where ts.winning_status = 1 and t.date=CURRENT_DATE;');
        return view('system_admin.winning_result', compact('twodnumbers','threednumbers','lonepyinenumbers'))->with('success', 'Winning Status is Updated successfully!');

    }
    public function winningstatus(Request $request)
    {
        $user=auth()->user()->id;
        // dd($user);
        $time = Carbon::now()->toTimeString();
        $winningnumber=new WinningNumber();
        $winningnumber->user_id= $user;
        $winningnumber->number=$request->number;
        $winningnumber->type=$request->type;
        $winningnumber->date=Carbon::now();
        $current_date=Carbon::now()->toDateString();

        if($time > 12){
        $round = "Evening";
        }
        else{
        $round = "Morning";
        }
        $winningnumber->round=$round;

        $winningnumber->save();


        if($request->type=='2d'){
            $twodnum=Twod::where('number','=',$request->number)->first();
            if(!empty($twodnum->id)){
                $twodnum=DB::table('twods')
                            ->join('twodsalelists','twodsalelists.twod_id','=','twods.id')
                            ->where('twods.number',$request->number)
                            ->where('twods.round',$round)
                            ->where('date',$current_date)
                            ->where('twodsalelists.status','1')->update(['twodsalelists.winning_status'=>1]);

                $lonepyineno=substr($request->number, 0, 1);
                $lonepyinelno=$request->number % 10;

                $lonepyine = DB::table('lonepyines')->where('number','LIKE',$lonepyineno.'%')
                                ->join('lonepyinesalelists','lonepyinesalelists.lonepyine_id','=','lonepyines.id')
                                ->where('lonepyinesalelists.status','=','1')
                                ->where('lonepyines.round',$round)
                                ->where('date',$current_date)
                                ->update(['lonepyinesalelists.winning_status'=>1]);

                $lonepyinelno = DB::table('lonepyines')->where('number','LIKE','%'.$lonepyinelno)
                                ->join('lonepyinesalelists','lonepyinesalelists.lonepyine_id','=','lonepyines.id')
                                ->where('lonepyinesalelists.status','=','1')
                                ->where('lonepyines.round',$round)
                                ->where('date',$current_date)
                                ->update(['lonepyinesalelists.winning_status'=>1]);
            }else{
                return redirect()->back()->with('success', 'Not a Winning Number');
            }
        }elseif($request->type=='3d'){
            $threednum=Threed::where('number','=',$request->number)->first();
            if(!empty($threednum->id)){
                $threednum=Threed::where('number','=',$request->number)
                ->join('threedsalelists','threedsalelists.threed_id','=','threeds.id')
                ->where('threedsalelists.status','=','1')
                ->where('threeds.round',$round)
                ->where('date',$current_date)
                ->update(['threedsalelists.winning_status'=>1]);
            }else{
                return redirect()->back()->with('success', 'Not a Winning Number');
            }
        }elseif($request->type==''){
            return redirect()->back()->with('success', 'Choose Type!');
        }
        return redirect ()->back()->with('success', 'Winning Status is Updated successfully!');

        // $twodnumbers=DB::select('Select u.name,two.number,ts.id,ts.customer_name,ts.customer_phone,ts.datetime From agents a left join twodsalelists ts on ts.agent_id = a.id LEFT join twods two on two.id=ts.twod_id LEFT join users u on u.id=a.user_id where ts.winning_status = 1;');
        // $threenumbers=DB::select('Select u.name,l.number,lps.id,lps.customer_name,lps.customer_phone,lps.datetime From agents a left join lonepyinesalelists lps on lps.agent_id = a.id LEFT join lonepyines l on l.id=lps.lonepyine_id LEFT join users u on u.id=a.user_id where lps.winning_status = 1;');

        // return view('system_admin.winning_result', compact('twodnumbers','threenumbers'))->with('success', 'Winning Status is Updated successfully!');
    }
}
