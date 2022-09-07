<?php

namespace App\Http\Controllers\Api\Opstaff;

use App\Models\User;
use App\Models\Opstaff;
use App\Models\Referee;
use Illuminate\Http\Request;
use App\Models\Operationstaff;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OpstaffController extends Controller
{

    // Opstaff Profile
    public function opstaffProfile()
    {
        $user = auth()->user();

        if ($user) {
            $op_staff = Operationstaff::where('user_id', $user->id)->first();
            $user = User::where('operationstaff_code', $op_staff->operationstaff_code)->first();

            return response()->json([
                'status' => 200,
                'data' => $user
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized user'
            ]);
        }
    }

    // Opstaff Profile update
    public function opstaffProfileUpdate(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ]);
        }

        $user = auth()->user();

        if ($user) {
            $imageName = null;
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $imageName = uniqid() . '_' .  $file->getClientOriginalName();
                Storage::disk('public')->put('profiles/' . $imageName, file_get_contents($file));
            }

            $op_staff = Operationstaff::where('user_id', $user->id)->first();
            $user = User::where('operationstaff_code', $op_staff->operationstaff_code)->first();

            $user->name = $request->name;
            $op_staff->image = $imageName;

            $user->save();
            $op_staff->save();

            return response()->json([
                'status' => 200,
                'message' => "Operation profile updated successfully",
                'data' => $user
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized user'
            ]);
        }
    }


    public function acceptReferee($id)
    {
        $user = auth()->user();
        if ($user) {
            $usr = User::findOrFail($id);
            $usr->status =  '1';

            $usr->save();

            return response()->json([
                'status' => 200,
                'data' => $usr
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized usesrs'
            ]);
        }
    }

    public function declineReferee($id)
    {
        $user = auth()->user();
        if ($user) {
            $usr = User::findOrFail($id);
            $usr->status = '2';

            $usr->save();

            return response()->json([
                'status' => 200,
                'data' => $usr
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized usesrs'
            ]);
        }
    }


    // referee requests
    public function showRefereeRequests()
    {
        $user = auth()->user();
        if ($user) {
            $op_staff = Operationstaff::where('user_id', $user->id)->first();

            $referee_requests = User::where('request_type', 'referee')->where('status', '0')
                ->where('operationstaff_code', $op_staff->operationstaff_code)->get();

            return response()->json([
                'status' => 200,
                'referee_requests' => $referee_requests
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized users'
            ]);
        }
    }

    // show referees in operation staff profile
    public function showReferees()
    {
        $user = auth()->user();
        if ($user) {
            $op_staff = Operationstaff::where('user_id', $user->id)->first();

            $referees = Referee::with('user')->whereHas('user', function ($q) use ($op_staff) {
                $q->where('request_type', 'referee')->where('status', '1')->whereNotNull('referee_code')->where('operationstaff_code', $op_staff->operationstaff_code);
            })->get();

            return response()->json([
                'status' => 200,
                'referees' => $referees
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized users'
            ]);
        }
    }

    public function editReferee($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error!',
                'data' => $validator->errors()
            ]);
        }
        $user = auth()->user();

        if ($user) {
            $referee  = Referee::findOrFail($id);
            $user = User::findOrFail($referee->user_id);
            $user->name = $request->name;

            $user->save();

            return response()->json([
                'status' => 200,
                'refereee_name' => $user
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized usesrs'
            ]);
        }
    }

    public function destroyReferee($id)
    {
        $user = auth()->user();
        if ($user) {
            $referee = Referee::findOrFail($id);
            $user = User::findOrFail($referee->user_id);

            $referee->delete();
            $user->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Referee deleted success'
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized users'
            ]);
        }
    }
}
