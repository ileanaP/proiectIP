<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Event;
use App\User;
use App\Attend;

class EventsController extends Controller
{
    public function mainList(Request $request)
    {
        if($request->has('id')){
            $events = Event::where('category',$request->query('id'))->get();
        } else {
            $events = Event::all();
        }
        return view('pages.events', compact('events'));
    }

    public function searchEventByCategory(Request $request)
    {
        $id = $request->query('id');
        $events = Event::where('category',$id);
        return view('pages.events', compact('events'));
    }

    public function eventPage(Request $request)
    {
        $id = $request->query('id');
        $event = DB::table('events')->where('id',$id)->get();
        $pics = DB::table('pictures')->where('event_id',$id)->get();
        $n = count($pics); // the number of pictures for a particular event
        $org = DB::table('org')->where('id',$event[0]->org_id)->get();

        $attendees_id = Attend::where('event_id',$id)->get();
        $usrid = array();
        foreach($attendees_id as $a){
            $usrid[] = $a->user_id;
        }
        $attendees = User::find($usrid);

        return view('pages.eventPage', compact('id', 'event', 'n','pics','org', 'usrid', 'attendees'));
    }



}