<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Event;
use App\User;
use App\Attend;
use App\Org;

class EventsController extends Controller
{
    public function mainList(Request $request)
    {
        if ($request->has('id')) {
            $events = Event::where('category', $request->query('id'))->get();
        } else {
            $events = Event::all();
        }

        $adminIds = $this->getAdminIds();
        return view('pages.events', compact('events', 'adminIds'));
    }

    public function searchEventByCategory(Request $request)
    {
        $id = $request->query('id');
        $events = Event::where('category',$id);

        $adminIds = $this->getAdminIds();
        return view('pages.events', compact('events', 'adminIds'));
    }

    public function eventPage(Request $request)
    {
        $id = $request->query('id');
        $event = DB::table('events')->where('id', $id)->get();
        $pics = DB::table('pictures')->where('event_id', $id)->get();
        $n = count($pics); // the number of pictures for a particular event
        $org = DB::table('orgs')->where('id', $event[0]->org_id)->get();

        $attendees_id = Attend::where('event_id', $id)->get();
        $usrid = [];
        foreach($attendees_id as $a) {
            $usrid[] = $a->user_id;
        }
        $attendees = User::find($usrid);

        $adminIds = $this->getAdminIds();

        return view('pages.eventPage', compact('id', 'event', 'n','pics','org', 'usrid', 'attendees', 'adminIds'));
    }

    public function addEventForm(Request $request)
    {
        $adminIds = $this->getAdminIds();
        return view('pages.addEvent', compact('adminIds'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addEvent(Request $request)
    {
        $event = new Event;
        $event->name = $request->get('title');
        $event->org_id = Org::where('user_id', $request->user()->id)->get()[0]->id;
        $event->desc = $request->get('description');
        $event->link = $request->get('link');
        $event->price = $request->get('price');
        $event->address = $request->get('address');
        $event->category = $request->get('categoryId');
        $event->save();
        if ($request->file('image') !== null) {
            $imageName = $event->id . '_event_title_image.jpg';
            Event::where('id',$event->id)->update(['picture'=>$imageName]);
            $request->file('image')->move('img/', $imageName);
        }

        return $this->mainList($request);
    }

    private function getAdminIds()
    {
        $adminType = DB::table('types')->where('types', 'Administrator')->get();
        $adminsInfo = DB::table('users')->where('type', $adminType[0]->id)->get();

        $adminIds = [];
        foreach ($adminsInfo as $adminInfo) {
            $adminIds[] = $adminInfo->id;
        }

        return $adminIds;
    }



}