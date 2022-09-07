<?php

namespace App\Http\Controllers\SystemAdmin;

use Illuminate\Routing\Controller;
use App\Models\Agent;
use App\Models\Guest;
use App\Models\Client;
use App\Models\Referee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function refereedata(Request $request)
    {
        $referees=Referee::all();

        $agentcounts=DB::select('select referee_id, COUNT(NULLIF(id, `referee_id`)) as agentcount FROM `agents` GROUP BY referee_id');

        // $referees=DB::select('select b.id,b.name, b.phone,b.referee_id,b.parent_id, count(a.agent_id) as AgentCount,a.parent_id FROM `clients` a INNER join clients b on a.parent_id = b.referee_id GROUP by b.id,b.referee_id,a.parent_id, b.parent_id,b.agent_id,b.name,b.phone');
        return view('system_admin.data.refereedata',compact('referees','agentcounts'));
    }

    public function agentdata()
    {
        return view('system_admin.data.agentdata');
    }

}
