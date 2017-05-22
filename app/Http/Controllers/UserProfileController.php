<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function main(Request $request)
    {
        if ($request->get('id') != null) {
            $userId = $request->get('id');
        } elseif ($request->user() == null) {
            return view('auth.login');
        } else {
            $userId = $request->user()->id;
        }
        $saveMessage = $request->get('saveMessage') != null ? $request->get('saveMessage') : '';
        $user = User::where('id', $userId)->get();
        $location = Location::where('id', $user[0]->location)->get();
        $locations = Location::where('id', '>', 0)->get();
        $adminIds = $this->getAdminIds();
        return view('pages.profile', compact('user','location', 'locations', 'adminIds', 'saveMessage'));
    }

    public function submitChanges(Request $request)
    {
        $this->validator($request->all())->validate();

        $name = $request->get('name');
        $surname = $request->get('surname');
        $email = $request->get('email');
        $location = $request->get('location');
        $password = $request->get('password');

        $userId = $request->user()->id;
        $data = [
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'location' => $location,
        ];
        if (!empty($password)) {
            $data['password'] = bcrypt($password);
        }
        $imageName = 'image_' . $userId . '.jpg';
        if ($request->file('image') !== null) {
            $request->file('image')->move('img/', $imageName);
            $data['avatar'] = $imageName;
        }

        DB::table('users')->where('id', $userId)->update($data);
        return redirect()->route('profile', ['id' => $userId, 'saveMessage' => 'Modiifcarile au fost efectuate cu succes!']);
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

    /**
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator(array $data)
    {
        return Validator::make($data, [
            'password' => 'nullable|min:6|confirmed',
            'image' => 'mimes:jpeg,jpg,png,bmp | max:1024'
        ]);
    }

}