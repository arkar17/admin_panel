<?php

namespace App\Http\Controllers;

use App\Models\Lonepyinesalelist;
use App\Models\Referee;
use App\Models\Twodsalelist;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard() {
        $users = User::all();
        $referees = Referee::all();

        $twod_salelists = Twodsalelist::select('number','sale_amount')->orderBy('sale_amount', 'DESC')->join('twods','twods.id','twodsalelists.twod_id')->limit(10)->get();

        $lp_salelists = Lonepyinesalelist::select('number','sale_amount')->orderBy('sale_amount', 'DESC')->join('lonepyines','lonepyines.id','lonepyinesalelists.lonepyine_id')->limit(10)->get();

        // dd($twod_salelists->toArray());
        return view('dashboard', compact('users', 'referees', 'twod_salelists', 'lp_salelists'));

        //dd($twod_salelists);

        // $twod_sale = [];
        // foreach($twod_salelists as $twod_salelist) {
        //     foreach($twod_salelist as $twod) {
        //         array_push($twod_sale, $twod);
        //     }

        // }

        // dd($twod_sale);
        // arsort($twod_sale);


        // dd($twod_sale);

// foreach($twod_sale as $x => $x_value) {
//     echo "<pre>";
//     print_r($x_value);
    // echo "Key=" . $x . ", Value=" . $x_value;
    // echo "<br>";
//   }

    }
}
