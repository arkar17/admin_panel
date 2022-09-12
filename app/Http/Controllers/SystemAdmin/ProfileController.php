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
        $total= DB::select("Select (SUM(ts.sale_amount)+SUM(tr.sale_amount)+SUM(ls.sale_amount)) maincash ,re.id From agents a left join referees re on re.id = a.referee_id left join twodsalelists ts on ts.agent_id = a.id and ts.status = 1 left join threedsalelists tr on tr.agent_id = a.id and tr.status = 1 left join lonepyinesalelists ls on ls.agent_id = a.id and ls.status = 1 where re.id = $referee_id Group By re.id;");
        $referee=Referee::findOrFail($referee_id);

       $agentsaleamounts= DB::select("Select (SUM(ts.sale_amount)+SUM(tr.sale_amount)+SUM(ls.sale_amount))maincash ,re.id,a.id From agents a left join referees re on re.id = a.referee_id left join twodsalelists ts on ts.agent_id = a.id and ts.status = 1 left join threedsalelists tr on tr.agent_id = a.id and tr.status = 1 left join lonepyinesalelists ls on ls.agent_id = a.id and ls.status = 1 where re.id= $referee_id Group By a.id;");

        $agents=DB::select("Select a.id,u.name,u.phone,(SUM(ts.sale_amount)+SUM(tr.sale_amount)+SUM(ls.sale_amount))maincash From agents a JOIN referees re on re.id = a.referee_id LEFT join twodsalelists ts on ts.agent_id = a.id LEFT join threedsalelists tr on tr.agent_id = a.id LEFT join lonepyinesalelists ls on ls.agent_id = a.id LEFT JOIN users u on u.id = a.user_id where re.id=$referee_id Group By a.id,u.name,u.phone;");

       // $agents=DB::select("Select a.id,u.name,u.phone.(SUM(ts.sale_amount)+SUM(tr.sale_amount)+SUM(ls.sale_amount))maincash From agents a left JOIN referees re on re.id = a.referee_id LEFT join twodsalelists ts on ts.agent_id = a.id LEFT join threedsalelists tr on tr.agent_id = a.id LEFT join lonepyinesalelists ls on ls.agent_id = a.id LEFT JOIN users u on u.id = a.user_id where ls.status = 1 AND tr.status =1 AND ts.status=1 AND re.id=$referee_id Group By a.id,u.name,u.phone;");

        return view('system_admin.profile.refereeprofile',compact('referee','agents','total','agentsaleamounts'));
    }

    // public function agentprofile($id)
    // {   $agent=DB::select("Select (SUM(ts.sale_amount)+SUM(tr.sale_amount)+SUM(ls.sale_amount))maincash,a.id,a.image,u.name,u.phone,re.referee_code From agents a left JOIN referees re on re.id = a.referee_id LEFT join twodsalelists ts on ts.agent_id = a.id LEFT join threedsalelists tr on tr.agent_id = a.id LEFT join lonepyinesalelists ls on ls.agent_id = a.id LEFT JOIN users u on u.id = a.user_id where ls.status = 1 AND tr.status =1 AND ts.status=1 AND a.id=$id Group By a.id,u.name,u.phone,re.referee_code,a.image;");

    //     //$agent=Agent::findOrFail($id);
    //     $twod_salelists=Twodsalelist::where('agent_id','=',$id)->get();
    //     $threed_salelists=Threedsalelist::where('agent_id','=',$id)->get();
    //     $lonepyine_salelists=Lonepyinesalelist::where('agent_id','=',$id)->get();

    //     return view('system_admin.profile.agentprofile',compact('agent','twod_salelists','threed_salelists','lonepyine_salelists'));
    // }

    public function agentprofile($id)
    {
      $agent=DB::select("Select (SUM(ts.sale_amount)+SUM(tr.sale_amount)+SUM(ls.sale_amount))maincash,a.id,a.image,u.name,u.phone,re.referee_code From agents a left JOIN referees re on re.id = a.referee_id LEFT join twodsalelists ts on ts.agent_id = a.id LEFT join threedsalelists tr on tr.agent_id = a.id LEFT join lonepyinesalelists ls on ls.agent_id = a.id LEFT JOIN users u on u.id = a.user_id where ls.status = 1 AND tr.status =1 AND ts.status=1 AND a.id=$id Group By a.id,u.name,u.phone,re.referee_code,a.image;");
        $twocus=DB::select("Select (SUM(ts.sale_amount))maincash ,a.id,ts.customer_name From agents a left join referees re on re.id = a.referee_id left join twodsalelists ts on ts.agent_id = a.id and ts.status = 1 WHERE a.id=$id Group By a.id,ts.customer_name ORDER BY maincash DESC;");
        $threecus=DB::select("Select (SUM(tr.sale_amount))maincash ,a.id,tr.customer_name From agents a left join referees re on re.id = a.referee_id left join threedsalelists tr on tr.agent_id = a.id and tr.status = 1 WHERE a.id=$id Group By a.id,tr.customer_name ORDER BY maincash DESC;");
        $lpcus=DB::select("Select (SUM(ls.sale_amount))maincash ,a.id,ls.customer_name From agents a left join referees re on re.id = a.referee_id left join lonepyinesalelists ls on ls.agent_id = a.id and ls.status = 1 WHERE a.id=$id Group By a.id,ls.customer_name ORDER BY maincash DESC;");
        //$cussaleamounts= DB::select("Select (SUM(ts.sale_amount)+SUM(tr.sale_amount)+SUM(ls.sale_amount))maincash ,a.id,ts.customer_name,tr.customer_name,ls.customer_name From agents a left join referees re on re.id = a.referee_id left join twodsalelists ts on ts.agent_id = a.id and ts.status = 1 left join threedsalelists tr on tr.agent_id = a.id and tr.status = 1 left join lonepyinesalelists ls on ls.agent_id = a.id and ls.status = 1 WHERE a.id=$id Group By a.id,ts.customer_name,tr.customer_name,ls.customer_name;");
        //$agent=Agent::findOrFail($id);
        $twod_salelists=Twodsalelist::where('agent_id','=',$id)->get();
        $threed_salelists=Threedsalelist::where('agent_id','=',$id)->get();
        $lonepyine_salelists=Lonepyinesalelist::where('agent_id','=',$id)->get();

        return view('system_admin.profile.agentprofile',compact('agent','twod_salelists','threed_salelists','lonepyine_salelists','twocus','threecus','lpcus'));
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
