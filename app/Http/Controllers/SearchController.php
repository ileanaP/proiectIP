<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;

class SearchController extends Controller
{
    public function searchByCategory(Request $request)
    {
        $events = Event::where('category',$request->query('id'));

        $adminIds = $this->getAdminIds();
        return view('pages.events', compact('events', 'adminIds'));
    }

    private function getAdminIds()
    {
        $adminType = DB::table('types')->where('types', 'Administrator')->get();
        $adminsInfo = DB::table('users')->where('type', $adminType)->get();

        $adminIds = [];
        foreach ($adminsInfo as $adminInfo) {
            $adminIds[] = $adminInfo->id;
        }

        return $adminIds;
    }
}
