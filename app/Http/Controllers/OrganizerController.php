<?php
namespace App\Http\Controllers;

use App\Org;
use Illuminate\Http\Request;
use App\User;
use App\Location;
use Illuminate\Support\Facades\DB;

class OrganizerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function seeOrganizers()
    {
        $users = User::where('type', 4)->get();

        return view('pages.organizers', compact('users'));
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

        DB::table('orgs')->insert($data);
        DB::table('users')->where('id', $userId)->update(['type' => 3]);
        return $this->seeOrganizers();
    }


}