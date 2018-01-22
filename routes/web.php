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

//use Illuminate\Http\Request;


Route::get('/', 'ArticleController@index')->name('home');

Route::get('/auth/register', 'RegistrationController@register')->name('auth.register');

Route::post('/auth/register', 'RegistrationController@postRegister')->name('auth.store');

Route::get('register/confirm/{email_token}', 'RegistrationController@confirmEmail');

Route::get('login', 'SessionController@login')->name('login');

Route::post('login', 'SessionController@postLogin')->name('login');

Route::get('logout', 'SessionController@logout')->name('logout');

Route::resource('articles', 'ArticleController', ['except' => ['update', 'edit']]);

Route::get('myindex', 'ArticleController@myindex')->name('myindex');

Route::get('pdf/{article_id}', 'ArticleController@pdf');

Route::get('feed/{type?}', ['as' => 'feed.atom', 'uses' => 'FeedController@getFeed']);