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
        return view('pages.eventPage', compact('id', 'event', 'n','pics','org'));
    }
}