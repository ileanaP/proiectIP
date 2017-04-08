<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{

    public function index(Request $request)
    {
        $id = $request->query('id');
        $event = DB::table('events')->where('id',$id)->get();
        $pics = DB::table('pictures')->where('event_id',$id)->get();
        $n = count($pics); // the number of pictures for a particular event
        $org = DB::table('org')->where('id',$event[0]->org_id)->get();

        $attendees_id = DB::table('attends')->where('event_id',$id)->get();

        $usrid = array();
        foreach($attendees_id as $a){
            $usrid[] = $a->user_id;
        }

        $attendees = DB::table('users')->whereIn('id',$usrid)->get(array('user'));

        return view('pages.eventPage', compact('id', 'event', 'n','pics','org', 'attendees'));
    }
}