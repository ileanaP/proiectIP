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
        if ($request->has('id')) {
            $events = Event::where('category', $request->query('id'))->get();
        } else {
            $events = Event::all();
        }

        $orgIds = $this->getOrgIds();
        return view('pages.events', compact('events', 'orgIds'));
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
        $usrid = [];
        foreach($attendees_id as $a){
            $usrid[] = $a->user_id;
        }
        $attendees = User::find($usrid);

        $orgIds = $this->getOrgIds();
        return view('pages.eventPage', compact('id', 'event', 'n','pics','org', 'orgIds', 'usrid', 'attendees'));
    }

    public function addEventForm(Request $request)
    {
        $orgIds = $this->getOrgIds();
        return view('pages.addEvent', compact('orgIds'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addEvent(Request $request)
    {
        $titleEvent = $request->get('title');
        $descriptionEvent = $request->get('description');
        $link = $request->get('link');
        $price = $request->get('price');
        $address = $request->get('address');
        $categoryId = $request->get('categoryId');
        $imageName = 'image_' . $titleEvent . '.jpg';

        $request->file('image')->move('img/', $imageName);

        $userId = $request->user()->id;

        $organizerInfo = DB::table('org')->where('user_id', $userId)->get();

        $data = [
            'address' => $address,
            'category' => $categoryId,
            'desc' => $descriptionEvent,
            'name' => $titleEvent,
            'org_id' => $organizerInfo[0]->id,
            'price' => $price,
            'link' => $link,
            'picture' => $imageName
        ];

        DB::table('events')->insert($data);

        return $this->addEventForm($request);
    }

    private function getOrgIds()
    {
        $organizersInfo = DB::table('org')->get();

        $orgIds = [];
        foreach ($organizersInfo as $organizerInfo) {
            $orgIds[] = $organizerInfo->user_id;
        }

        return $orgIds;
    }


}