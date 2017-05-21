<?php
namespace App\Http\Controllers;

use App\Event;
use App\Feedback;
use App\Org;
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
            $users = User::where('type', 4)->get();
            $adminIds = $this->getAdminIds();
            return view('pages.adminPageModifyOrgs', compact('users', 'adminIds'));
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

        $data = [
            'name' => $userInfo[0]->name . ' ' . $userInfo[0]->surname,
            'address' => $userInfo[0]->email,
            'user_id' => $userId,
        ];

        $isAlreadyOrganizer = DB::table('orgs')->where('user_id', $userId)->get();

        if (!empty($isAlreadyOrganizer)) {
            DB::table('orgs')->insert($data);
            DB::table('users')->where('id', $userId)->update(['type' => 3]);
        }

        return $this->seeOrganizers();
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