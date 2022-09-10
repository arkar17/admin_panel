<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agent;
use App\Models\Referee;
use App\Models\Twodsalelist;
use Illuminate\Http\Request;
use App\Models\Threedsalelist;
use App\Models\Lonepyinesalelist;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function sysdashboard() {
        $users = User::all();
        $referees = Referee::all();
        $agents=Agent::all();
        $totalsaleamounts= DB::select("Select (SUM(ts.sale_amount)+SUM(tr.sale_amount)+SUM(ls.sale_amount)) maincash ,re.id From agents a left join referees re on re.id = a.referee_id left join twodsalelists ts on ts.agent_id = a.id and ts.status = 1 left join threedsalelists tr on tr.agent_id = a.id and tr.status = 1 left join lonepyinesalelists ls on ls.agent_id = a.id and ls.status = 1 Group By re.id;");

        $twodtotal=(int)Twodsalelist::where('status','=','1')->sum('sale_amount');
        $threedtotal=(int)Threedsalelist::where('status','=','1')->sum('sale_amount');
        $lonepyinetotal=(int)Lonepyinesalelist::where('status','=','1')->sum('sale_amount');
        $sum=$twodtotal+$threedtotal+ $lonepyinetotal;

        $twod_salelists = Twodsalelist::select('number','sale_amount')->orderBy('sale_amount', 'DESC')->join('twods','twods.id','twodsalelists.twod_id')->limit(10)->get();
        $lp_salelists = Lonepyinesalelist::select('number','sale_amount')->orderBy('sale_amount', 'DESC')->join('lonepyines','lonepyines.id','lonepyinesalelists.lonepyine_id')->limit(10)->get();
        return view('dashboard', compact('users', 'referees', 'twod_salelists', 'lp_salelists','agents','totalsaleamounts','sum'));

    }

    public function refedashboard(){
        $agents = Agent::all();
        $twod_salelists = Twodsalelist::select('number','sale_amount')->orderBy('sale_amount', 'DESC')->join('twods','twods.id','twodsalelists.twod_id')->limit(10)->get();

        $lp_salelists = Lonepyinesalelist::select('number','sale_amount')->orderBy('sale_amount', 'DESC')->join('lonepyines','lonepyines.id','lonepyinesalelists.lonepyine_id')->limit(10)->get();
        return view('RefereeManagement.dashboard', compact('agents', 'twod_salelists', 'lp_salelists'));

    }
}
