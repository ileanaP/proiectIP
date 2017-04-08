<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubmitController extends Controller
{
    public function attendEvent(Request $request)
        {
            return view('pages.events');
        }
}
