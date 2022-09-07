<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\User;
use App\Models\Referee;
use App\Models\Twodsalelist;
use Illuminate\Http\Request;
use App\Models\Lonepyinesalelist;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function sysdashboard() {
        $users = User::all();
        $referees = Referee::all();

        $twod_salelists = Twodsalelist::select('number','sale_amount')->orderBy('sale_amount', 'DESC')->join('twods','twods.id','twodsalelists.twod_id')->limit(10)->get();

        $lp_salelists = Lonepyinesalelist::select('number','sale_amount')->orderBy('sale_amount', 'DESC')->join('lonepyines','lonepyines.id','lonepyinesalelists.lonepyine_id')->limit(10)->get();
        return view('dashboard', compact('users', 'referees', 'twod_salelists', 'lp_salelists'));

    }

    public function refedashboard(){
        $agents = Agent::all();
        $twod_salelists = Twodsalelist::select('number','sale_amount')->orderBy('sale_amount', 'DESC')->join('twods','twods.id','twodsalelists.twod_id')->limit(10)->get();

        $lp_salelists = Lonepyinesalelist::select('number','sale_amount')->orderBy('sale_amount', 'DESC')->join('lonepyines','lonepyines.id','lonepyinesalelists.lonepyine_id')->limit(10)->get();
        return view('RefereeManagement.dashboard', compact('agents', 'twod_salelists', 'lp_salelists'));

    }
}
