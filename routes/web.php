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

Route::get('/account/sign-out', array(
    'as' => 'account-sign-out',
    'uses' => 'LogoutController@logout'
));

Auth::routes();

Route::get('/home', 'HomeController@index');
