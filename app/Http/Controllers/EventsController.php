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
        $event = DB::table('events')->where('id',$id)->get();
        $pics = DB::table('pictures')->where('event_id',$id)->get();
        $n = count($pics); // the number of pictures for a particular event
        $org = DB::table('orgs')->where('id',$event[0]->org_id)->get();

        $attendees_id = Attend::where('event_id',$id)->get();
        $usrid = [];
        foreach($attendees_id as $a){
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
        $titleEvent = $request->get('title');
        $descriptionEvent = $request->get('description');
        $link = $request->get('link');
        $price = $request->get('price');
        $address = $request->get('address');
        $categoryId = $request->get('categoryId');
        $imageName = 'image_' . $titleEvent . '.jpg';

        if ($request->file('image') !== null) {
            $request->file('image')->move('img/', $imageName);
        }

        $userId = $request->user()->id;

        $organizerInfo = DB::table('orgs')->where('user_id', $userId)->get();

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

    private function getAdminIds()
    {
        $adminType = DB::table('types')->where('types', 'Administrator')->get();
        $adminsInfo = DB::table('users')->where('type', $adminType[0]->id)->get();

        $adminIds = [];
        foreach ($adminsInfo as $adminInfo) {
            $adminIds[] = $adminInfo->user_id;
        }

        return $adminIds;
    }



}