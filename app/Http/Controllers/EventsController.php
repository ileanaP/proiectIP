<?php
namespace App\Http\Controllers;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Event;
use App\User;
use App\Attend;
use App\Org;
use Illuminate\Support\Facades\Validator;
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
        $feedbackMessage = $request->get('feedbackMessage') !== null ? $request->get('feedbackMessage') : '';
        $adminIds = $this->getAdminIds();
        return view('pages.eventPage', compact('id', 'event', 'n', 'pics', 'org', 'usrid', 'attendees', 'adminIds', 'feedbackMessage'));
    }
    public function addEventForm(Request $request)
    {
        $errorMessage = $request->get('errorMessage') != null ? $request->get('errorMessage') : '';
        $adminIds = $this->getAdminIds();
        return view('pages.addEvent', compact('adminIds', 'errorMessage'));
    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addEvent(Request $request)
    {
        $this->validator($request->all())->validate();
        $event = new Event;
        $event->name = $request->get('name') != null ? $request->get('name') : '';
        $event->org_id = Org::where('user_id', $request->user()->id)->get()[0]->id;
        $event->desc = $request->get('description') != null ? $request->get('description') : '';
        $event->link = $request->get('link') != null ? $request->get('link') : '';
        $event->price = $request->get('price') != null ? $request->get('price') : '';
        $event->address = $request->get('address') != null ? $request->get('address') : '';
        $event->category = $request->get('categoryId');
        $event->save();
        if ($request->file('image') !== null) {
            $imageName = $event->id . '_event_title_image.jpg';
            Event::where('id' ,$event->id)->update(['picture' => $imageName]);
            $request->file('image')->move('img/', $imageName);
        }
        return redirect()->route('upcomingEvents');
    }
    /**
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:events',
            'description' => 'required|max:255',
            'link' => 'required',
            'price' => 'required',
            'address' => 'required',
        ]);
    }
    public function myEvents(Request $request)
    {
        $userId = $request->user()->id;
        $orgInfo = Org::where('user_id', $userId)->get();
        $orgId = $orgInfo[0]->id;
        $events = Event::where('org_id', $orgId)->get();
        $adminIds = $this->getAdminIds();
        return view('pages.myEvents', compact('events', 'adminIds'));
    }
    public function editEvent(Request $request)
    {
        if ($request->get('id') != null) {
            $eventId = $request->get('id');
            $orgInfo = Org::where('user_id', $request->user()->id)->get();
            $orgId = $orgInfo[0]->id;
            $eventInfo = Event::where(['org_id' => $orgId, 'id' => $eventId])->get();
            if (count($eventInfo)) {
                $saveMessage = $request->get('saveMessage') !== null ? $request->get('saveMessage') : '';
                $adminIds = $this->getAdminIds();
                return view('pages.editEvent', compact('eventInfo', 'adminIds', 'saveMessage'));
            } else {
                return view('errors.404');
            }
        }
    }
    public function submitEventChanges(Request $request)
    {
        $name = $request->get('name');
        $desc = $request->get('desc');
        $price = $request->get('price');
        $link = $request->get('link');
        $eventId = $request->get('eventId');
        $data = [
            'name' => $name,
            'desc' => $desc,
            'price' => $price,
            'link' => $link
        ];
        DB::table('events')->where('id', $eventId)->update($data);
        if ($request->file('image') !== null) {
            $picture = new Picture;
            $picture->event_id = $eventId;
            $imageName = $eventId . time() . 'jpg';
            $picture->picture = $imageName;
            $picture->save();
            $request->file('image')->move('img/', $imageName);
        }
        if ($request->file('mainImage') !== null) {
            $imageName = $eventId . '_event_title_image_' .time() . 'jpg';
            Event::where('id', $eventId)->update(['picture' => $imageName]);
            $request->file('mainImage')->move('img/', $imageName);
        }
        return redirect()->route('editEvent', ['id' => $eventId, 'saveMessage' => 'Modiifcarile au fost efectuate cu succes!']);
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