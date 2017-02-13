<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin.php', 'Admin\LoginController@toLogin');
Route::get('code', 'Admin\LoginController@code');
Route::post('/login', 'Admin\LoginController@login');
Route::group(['middleware' => ['login'],'namespace'=>'Admin'],function(){
    Route::get('/loginout', 'LoginController@loginOut');
    Route::get('/info','LoginController@info');
    Route::get('/index', 'LoginController@index');
    Route::get('/editpsd', 'LoginController@editPsd');
    Route::post('/password', 'LoginController@password');
    Route::get('/addcategory', 'CategoryController@addCategory');
    Route::resource('category', 'CategoryController');
    Route::post('changeorder', 'CategoryController@changeOrder');
    Route::post('add', 'CategoryController@add');
    Route::post('editcategory', 'CategoryController@editcategory');
    Route::get('/delete/{id}', 'CategoryController@delete');
    Route::get('article/index', 'ArticleController@index');
    Route::any('upload', 'CommonController@upload');
    Route::post('addArticle', 'ArticleController@add');
    Route::get('article/list', 'ArticleController@list2');
    Route::get('/article/edit/{id}', 'ArticleController@edit');//article/delete/
    Route::post('editArticle', 'ArticleController@editArticle');
    Route::get('/article/delete/{id}', 'ArticleController@delete');
});



Route::get('/aa', 'Admin\LoginController@aa');