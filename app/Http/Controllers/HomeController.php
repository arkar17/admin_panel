<?php

namespace App\Http\Controllers;
use Pusher\Pusher;
use Illuminate\Http\Request;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
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
        return view('home');
    }

    public function dashboard() {
        return view('dashboard');
    }
}
