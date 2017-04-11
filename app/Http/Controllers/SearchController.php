<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;

class SearchController extends Controller
{
    public function searchByCategory(Request $request){
        $events = Event::where('category',$request->query('id'));
        return view('pages.events', compact('events'));
    }
}
