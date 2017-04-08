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

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('upcomingEvents', function()
{
    return view('pages.upcomingEvents');
});

Route::get('registerr', function()
{
    return view('pages.register');
});

Route::get('loginn', function()
{
    return view('pages.login');
});

Route::get('events', function()
{

    $events = DB::table('events')->get();

    return view('pages.events', compact('events'));
});

Route::get('eventpage', 'EventController@index')->name('eventpage');

Route::get('attendEvent', 'AttendController@attendEvent')->name('attendEvent');


Auth::routes();

Route::get('logout', [
    'as' => 'account-sign-out',
    'uses' => 'Auth\LoginController@logout'
]);

Route::get('/home', 'HomeController@index');