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

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Route::get('calendar', function()
{
    return view('pages.testcalendar');
});

Route::get('addEventForm', 'EventsController@addEventForm');
Route::get('upcomingEvents', 'EventsController@mainList')->name('upcomingEvents');
Route::post('addEvent', 'EventsController@addEvent')->name('addEvent');
Route::get('eventpage', 'EventsController@eventPage')->name('eventpage');
Route::get('attendEvent', 'AttendController@attendEvent')->name('attendEvent');
Route::get('notAttendEvent', 'AttendController@notAttendEvent')->name('notAttendEvent');

Route::get('profile', 'UserProfileController@main')->name('profile');
Route::get('organizersPage', 'OrganizerController@seeOrganizers')->name('seeOrganizers');
Route::get('organizerDetails', 'OrganizerController@getOrganizerDetails')->name('organizerDetails');

Route::post('addFeedback', 'FeedbackController@addFeedback')->name('addFeedback');

Route::post('addOrganizer', 'OrganizerController@addOrganizer')->name('addOrganizer');
Route::post('deleteOrganizers', 'OrganizerController@deleteOrganizers')->name('deleteOrganizers');
Route::post('submitChanges', 'UserProfileController@submitChanges')->name('submitChanges');


Auth::routes();

Route::get('logout', [
    'as' => 'account-sign-out',
    'uses' => 'Auth\LoginController@logout'
]);

