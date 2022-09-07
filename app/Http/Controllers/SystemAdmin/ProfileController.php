<?php

namespace App\Http\Controllers\SystemAdmin;

use Illuminate\Routing\Controller;
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

class ProfileController extends Controller
{
    public function refreeprofile($referee_id)
    {
        $referee=Referee::findOrFail($referee_id);

        $agents=Agent::where('referee_id','=',$referee->id)->get();
        //dd($agents);
        return view('system_admin.profile.refereeprofile',compact('referee','agents'));
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
