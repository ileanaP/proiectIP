<?php
namespace App\Http\Controllers;

use App\Event;
use App\Feedback;
use App\Org;
use App\Organizer;
use App\Location;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class OrganizerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function seeOrganizers(Request $request)
    {
        if ($this->isAdmin($request)) {
            $users = User::all();
            $adminIds = $this->getAdminIds();
            $orgs = Org::all();
            return view('pages.adminPageModifyOrgs', compact('users', 'adminIds','orgs'));
        } else {
            return view('errors.404');
        }
    }

    public function getOrganizerDetails(Request $request)
    {
        if ($this->isAdmin($request)) {
            $idOrganizer = $request->get('id');
            $events = Event::where("org_id", $idOrganizer)->get();

            foreach ($events as $event) {
                $feedback = Feedback::where("event_id", $event->id)->get();
                $event->average = $this->getAverageFeedbackStars($feedback);
            }

            $users = User::where('type', 4)->get();
            $adminIds = $this->getAdminIds();

            return view('pages.organizerEventsPage', compact('events', 'adminIds', 'users'));
        } else {
            return view('errors.404');
        }
   }

    public function deleteOrganizers(Request $request)
    {
        $request->offsetUnset('_token');
        $orgIds = $request->all();

        foreach ($orgIds as $orgId) {
            $organizerInfo = Org::where('id', $orgId)->get();

            DB::table('users')->where('id', $organizerInfo[0]->user_id)->update(['type' => 4]);
            DB::table('orgs')->where('id', $orgId)->delete();
        }

        return $this->seeOrganizers();
    }

    public function addOrganizer(Request $request)
    {
        $userId = $request->get('userId');
        $userInfo = User::where('id', $userId)->get();
        $orgId = $request->get('orgId');
        $organizer = new Organizer;
        $organizer->user_id = $userId;
        $organizer->org_id = $orgId;
        $organizer->save();
        //$isAlreadyOrganizer = DB::table('orgs')->where('user_id', $userId)->get();
        DB::table('users')->where('id', $userId)->update(['type' => 3]);

        return redirect('/');
    }

    public function addOrganizationForm(Request $request){
        $locations = Location::all();
        return view('pages.addOrganization', compact('locations'));
    }

    public function submitAddOrganization(Request $request){
        $org = new Org;
        $org->name = $request->get('orgName');
        $org->address = $request->get('orgAddress');
        $org->phone = $request->get('orgPhone');
        $org->user_id = $request->user()->id;
        $org->location = $request->get('orgLocation');
        $org->save();

        $organizer = new Organizer;
        $organizer->user_id = $request->user()->id;
        $organizer->org_id = $org->id;
        $organizer->save();

        DB::table('users')->where('id', $request->user()->id)->update(['type' => 3]);

        $adminIds = $this->getAdminIds();

        return view('pages.home', compact('adminIds'));
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

    private function getAverageFeedbackStars($feedback)
    {
        $sum = 0;
        foreach ($feedback as $feedbackItem) {
            $sum += $feedbackItem->stars;
        }

        if (count($feedback)) {
            return $sum/ count($feedback);
        } else {
            return -1;
        }
     }

     private function isAdmin(Request $request)
     {
         $userInfo = User::where('id', $request->user()->id)->get();
         if ($userInfo[0]->type != 1) {
             return false;
         }

         return true;
     }


}