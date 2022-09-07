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
    public function __construct()
    {
        $this->middleware('auth');
    }


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
        return view('system_admin.winning_result');

    }
    public function winningstatus(Request $request)
    {
        $user=auth()->user()->id;
        $time = Carbon::now()->toTimeString();

        $winningnumber=new WinningNumber();
        $winningnumber->user_id=$user;
        $winningnumber->number=$request->number;
        $winningnumber->type=$request->type;
        $winningnumber->date=Carbon::now();
        if($time > 12){
        $winningnumber->round = "Evening";
        }
        else{
        $winningnumber->round = "Morning";
        }
        //$winningnumber->save();

        if($request->type=='2d'){
            $twodnum=Twod::where('number','=',$request->number)->first();
            if(!empty($twodnum->id)){
                $twodnum=Twod::where('number','=',$request->number)
                ->join('twodsalelists','twodsalelists.twod_id','=','twods.id')
                ->update(['twodsalelists.winning_status'=>1]);

                $lonepyineno=substr($request->number, 0, 1);
                $lonepyinelno=$request->number % 10;

                $lonepyine = DB::table('lonepyines')->where('number','LIKE',$lonepyineno.'%')
                                ->join('lonepyinesalelists','lonepyinesalelists.lonepyine_id','=','lonepyines.id')
                                ->update(['lonepyinesalelists.winning_status'=>1]);

                $lonepyinelno = DB::table('lonepyines')->where('number','LIKE','%'.$lonepyinelno)
                                ->join('lonepyinesalelists','lonepyinesalelists.lonepyine_id','=','lonepyines.id')
                                ->update(['lonepyinesalelists.winning_status'=>1]);
            }else{
                return redirect()->back()->with('success', 'Not a Winning Number');
            }
        }elseif($request->type=='3d'){
            $threednum=Threed::where('number','=',$request->number)->first();
            if(!empty($threednum->id)){
                $threednum=Threed::where('number','=',$request->number)
                ->join('threedsalelists','threedsalelists.threed_id','=','threeds.id')
                ->update(['threedsalelists.winning_status'=>1]);
            }else{
                return redirect()->back()->with('success', 'Not a Winning Number');
            }
        }else{
            return redirect()->back()->with('success', 'Choose Type!');
        }
        return redirect ()->back()->with('success', 'Winning Status is Updated successfully!');
    }
}
