<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserProfileController extends Controller
{
    public function main(Request $request){
        $user_id = $request->query('id');
        $user = User::where('id',$user_id);
        return view('pages.profile', compact('user'));
    }
}