<?php
namespace App\Http\Controllers;

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
        $orgIds = $this->getOrgIds();
        return view('pages.organizers', compact('orgIds'));
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
        return $this->seeOrganizers();
    }

    private function getOrgIds()
    {
        $organizersInfo = DB::table('orgs')->get();

        $orgIds = [];
        foreach ($organizersInfo as $organizerInfo) {
            $orgIds[] = $organizerInfo->user_id;
        }

        return $orgIds;
    }

}