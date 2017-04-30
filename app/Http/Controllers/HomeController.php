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

        return view('pages.home', compact('orgIds'));
    }
}
