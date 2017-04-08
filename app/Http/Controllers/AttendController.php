<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class AttendController extends Controller
{
    public function attendEvent(Request $request){
        $id = $request->query('id');
        $event = $id;
        $user = Auth::user();
        $user_id = $user->id;

        DB::table('attends')->insert([
            'user_id' => $user_id,
            'event_id' => $event,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('eventpage', ['id' => $id]);
    }
}
