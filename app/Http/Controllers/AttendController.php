<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Attend;

class AttendController extends Controller
{
    public function attendEvent(Request $request)
    {
        $id = $request->query('id');
        $user = Auth::user();

        $attend = new Attend;
        $attend->user_id = $user->id;
        $attend->event_id = $id;
        $attend->save();

        return redirect()->route('eventpage', ['id' => $id]);
    }

    public function notAttendEvent(Request $request)
    {
        $id = $request->query('id');
        $user = Auth::user();
        $attend = Attend::where('user_id',$user->id)->where('event_id',$id);
        $attend->delete();

        return redirect()->route('eventpage', ['id' => $id]);
    }
}
