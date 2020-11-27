<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => "Home"],function ()
{
	Route::get('/','HomeController@index')->name('home');
	Route::get('/about','HomeController@about')->name('about');
	Route::get('/news','HomeController@news')->name('news');
	Route::get('/official','HomeController@official')->name('official');
	Route::get('/official/{slug}','HomeController@officialDetail')->name('official.detail');
	Route::get('/official/search/{key}','HomeController@officialSearch')->name('official.search');
	Route::get('/tutorial','HomeController@tutorial')->name('tutorial');
	Route::get('/contact','HomeController@contact')->name('contact');
});

Route::group(['namespace' => "Admin",'prefix'=>"admin_v1", 'as' => "admin."],function ()
{
	Route::get('/','HomeController@index')->name('home');
	Route::group(['prefix'=>"official", 'as' => "official."],function ()
	{
		Route::get('/','OfficialController@index')->name('list');
		Route::get('/create','OfficialController@create')->name('create');
		Route::get('/edit/{id}','OfficialController@edit')->name('edit');
		Route::get('/detail/{id}','OfficialController@detail')->name('detail');
		Route::group(['prefix'=>"category", 'as' => "category."],function ()
		{
			Route::get('/','OfficialController@listCategory')->name('list');
			Route::get('/create','OfficialController@createCategory')->name('create');
			Route::get('/edit/{id}','OfficialController@editCategory')->name('edit');
		});
		Route::group(['prefix'=>"position", 'as' => "position."],function ()
		{
			Route::get('/','OfficialController@listPosition')->name('list');
			Route::get('/create','OfficialController@createPosition')->name('create');
			Route::get('/edit/{id}','OfficialController@editPosition')->name('edit');
		});
	});
});






Route::group(['namespace' => "Api\Admin",'prefix'=>"v1/api", 'as' => "api.admin."],function ()
{
	Route::group(['prefix'=>"official", 'as' => "official."],function ()
	{
		Route::post('/create','OfficialController@create')->name('create');
		Route::post('/edit','OfficialController@edit')->name('edit');
		Route::post('/delete','OfficialController@delete')->name('delete');
		Route::group(['prefix'=>"category", 'as' => "category."],function ()
		{
			Route::post('/create','OfficialController@createCategory')->name('create');
			Route::post('/edit','OfficialController@editCategory')->name('edit');
			Route::post('/delete','OfficialController@deleteCategory')->name('delete');
		});
		Route::group(['prefix'=>"position", 'as' => "position."],function ()
		{
			Route::post('/create','OfficialController@createPosition')->name('create');
			Route::post('/edit','OfficialController@editPosition')->name('edit');
			Route::post('/delete','OfficialController@deletePosition')->name('delete');
		});
	});
});
