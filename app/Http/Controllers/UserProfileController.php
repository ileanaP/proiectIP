<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Location;

class UserProfileController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }

    public function main(Request $request)
    {
        $user_id = $request->query('id');
        $user = User::where('id',$user_id)->get();
        $location = Location::where('id',$user[0]->location)->get();
        $locations = Location::where('id','>',0)->get();

        return view('pages.profile', compact('user','location', 'locations'));
    }
}