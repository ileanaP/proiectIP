<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Location;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }

    public function main(Request $request)
    {
        $userId = $request->user()->id;

        $user = User::where('id', $userId)->get();
        $location = Location::where('id', $user[0]->location)->get();
        $locations = Location::where('id', '>', 0)->get();

        $adminIds = $this->getAdminIds();
        return view('pages.profile', compact('user','location', 'locations', 'adminIds'));
    }

    public function submitChanges(Request $request)
    {
        $name = $request->get('name');
        $surname = $request->get('surname');
        $email = $request->get('email');
        $location = $request->get('location');
        $password = $request->get('password');
        $confirmedPassword = $request->get('confirmedPassword');

        if ($password === $confirmedPassword && !empty($password)) {
            $updatedPassword = $password;
        }

        $userId = $request->user()->id;

        $data = [
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'location' => $location,
        ];

        if (isset($updatedPassword)) {
            $data['password'] = bcrypt($updatedPassword);
        }

        $imageName = 'image_' . $userId . '.jpg';
        if ($request->file('image') !== null) {
            $request->file('image')->move('img/', $imageName);
            $data['avatar'] = $imageName;
        }

        DB::table('users')->where('id', $userId)->update($data);

        return $this->main($request);
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

}