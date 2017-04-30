<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Middleware\LogoutRedirect;

Route::get('/', 'HomeController@index');

Route::get('addEventForm', 'EventsController@addEventForm');

Route::get('upcomingEvents', 'EventsController@mainList')->name('upcomingEvents');

Route::post('addEvent', 'EventsController@addEvent')->name('addEvent');
Route::get('eventpage', 'EventsController@eventPage')->name('eventpage');
Route::get('attendEvent', 'AttendController@attendEvent')->name('attendEvent');
Route::get('notAttendEvent', 'AttendController@notAttendEvent')->name('notAttendEvent');

Route::get('profile', 'UserProfileController@main')->name('profile');

Auth::routes();

Route::get('logout', [
    'as' => 'account-sign-out',
    'uses' => 'Auth\LoginController@logout'
]);

Route::get('/home', 'HomeController@index');

