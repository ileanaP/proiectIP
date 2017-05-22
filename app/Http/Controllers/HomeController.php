<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $organizersInfo = DB::table('orgs')->get();

        $orgIds = [];
        foreach ($organizersInfo as $organizerInfo) {
            $orgIds[] = $organizerInfo->user_id;
        }

        $adminIds = $this->getAdminIds();

        return view('pages.home', compact('orgIds', 'adminIds'));
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

    public function exception(){
        return view('errors.404');
    }
}
