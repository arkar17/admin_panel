<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Referee;
use Illuminate\Http\Request;
use App\Models\CashinCashout;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CashInRequest;
use Illuminate\Support\Facades\Validator;

class CashInCashOutController extends Controller
{

    public function maincashStore(Request $request)
    {

        $user = auth()->user();
        $referee = Referee::where('user_id', $user->id)->first();

        $referee->main_cash = $request->main_cash;

        $referee->save();

        return redirect()->back()->with('success', 'Main Cash added successfully!');
    }

    public function cashInView()
    {
        $agents = Agent::with('user')->get();

        // dd($agents->toArray());
        // // dd($agents->toArray());
        $cashin_cashouts = CashinCashout::select('cashin_cashouts.id', 'cashin_cashouts.agent_id', 'cashin_cashouts.coin_amount', 'cashin_cashouts.status', 'cashin_cashouts.payment', 'cashin_cashouts.withdraw', 'users.name', 'users.phone')



            ->join('users', 'users.id', 'cashin_cashouts.agent_id')->get();

            $cc = DB::select("select cc.id ,u.name, u.phone , cc.coin_amount from cashin_cashouts cc left join agents a on a.user_id = cc.agent_id left join users u on u.id = a.user_id");
            // dd($agents->toArray());
        // dd($cashin_cashouts->toArray());
        return view('RefereeManagement.cashin-cashout.cashin', compact('agents', 'cc','cashin_cashouts'));
    }

    public function cashInStore(CashInRequest $request)
    {
        $cashin_cashout = new CashinCashout();
        $cashin_cashout->agent_id = $request->agent_id;
        $cashin_cashout->coin_amount = $request->coin_amount;
        $cashin_cashout->status = $request->status;
        $cashin_cashout->payment = $request->payment;

        $cashin_cashout->save();

        return redirect()->back();
    }

    // public function cashOutView()
    // {
    //     $agents = Agent::with('user')->get();

    //     $cashin_cashouts = CashinCashout::select('cashin_cashouts.id', 'cashin_cashouts.agent_id', 'cashin_cashouts.coin_amount', 'cashin_cashouts.status', 'cashin_cashouts.payment', 'cashin_cashouts.withdraw', 'users.name', 'users.phone')

    //         ->join('users', 'users.id', 'cashin_cashouts.agent_id')->get();

    //         dd($cashin_cashouts->toArray());
    //     return view('cashin-cashout.cashout', compact('agents', 'cashin_cashouts'));
    // }

    public function cashOutStore(Request $request)
    {
        $cashin_cashout = CashinCashout::findOrFail($request->agent_id);

        $cashin_cashout->coin_amount = $cashin_cashout->coin_amount - $request->withdraw;
        $cashin_cashout->withdraw = $request->withdraw;
        $cashin_cashout->save();

        return redirect()->back();
    }
}
