<?php

namespace App\Http\Controllers\SystemAdmin;

use App\Models\User;
use App\Models\Agent;
use App\Models\Client;
use App\Models\Referee;
use App\Models\Lonepyine;
use App\Models\Twodsalelist;
use Illuminate\Http\Request;
use App\Models\Operationstaff;
use App\Models\Threedsalelist;
use App\Models\Lonepyinesalelist;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function refreeprofile($referee_id)
    {
        // $totalsaleamount=Referee::where('id','=',1)
        // ->join('agents','agents.referee_id','=','referee.id')
        // ->join('twodsalelists','twodsalelists.agent_id','=','agents.id')
        // ->join('threedsalelists','threedsalelists.agent_id','=','agents.id')
        // ->join('lonepyinesalelists','lonepyinesalelists.agent_id','=','agents.id')
        // ->where('agent.id','=','twodsalelists.agent_id')->groupBy('twodsalelists.sale_amount')->dd();

        $total= DB::select("Select (SUM(ts.sale_amount)+SUM(tr.sale_amount)+SUM(ls.sale_amount)) maincash ,re.id From agents a left join referees re on re.id = a.referee_id left join twodsalelists ts on ts.agent_id = a.id and ts.status = 1 left join threedsalelists tr on tr.agent_id = a.id and tr.status = 1 left join lonepyinesalelists ls on ls.agent_id = a.id and ls.status = 1 where re.id = $referee_id Group By re.id;");
        $referee=Referee::findOrFail($referee_id);
        $agents=Agent::where('referee_id','=',$referee->id)->get();


        //dd($agents);
        return view('system_admin.profile.refereeprofile',compact('referee','agents','total'));
    }

    public function agentprofile($id)
    {
        $agent=Agent::findOrFail($id);
        $twod_salelists=Twodsalelist::where('agent_id','=',$id)->get();
        $threed_salelists=Threedsalelist::where('agent_id','=',$id)->get();
        $lonepyine_salelists=Lonepyinesalelist::where('agent_id','=',$id)->get();

        return view('system_admin.profile.agentprofile',compact('agent','twod_salelists','threed_salelists','lonepyine_salelists'));
    }

    public function guestprofile($id)
    {
        $guest=User::findOrFail($id);

        return view('system_admin.profile.guestprofile',compact('guest'));
    }

    public function operationstaffprofile($id)
    {
       $operationstaff=Operationstaff::findOrFail($id);
       $referees=Referee::where('operationstaff_id','=',$id)->get();
       return view('system_admin.profile.operationstaffprofile',compact('operationstaff','referees'));

    }
}
