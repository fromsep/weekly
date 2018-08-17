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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test');

Auth::routes();
Route::middleware(['auth'])->group(function() {
    Route::get('group', 'Auth\GroupController@select')->name('group.select');
    Route::post('group/update', 'Auth\GroupController@update')->name('group.update');
});

Route::middleware(['auth','checkGroup'])->group(function() {
    Route::get('/', 'AssignmentController@recent');

    Route::prefix('assignment')->group(function () {
        Route::get('/', 'AssignmentController@index');
        Route::get('recent', 'AssignmentController@recent')->name('assignment.recent');
        Route::any('add', 'AssignmentController@add')->name('assignment.add');
        Route::get('detail/{id}', 'AssignmentController@detail');
        Route::get('edit/{id}', 'AssignmentController@edit');
        Route::post('update', 'AssignmentController@update')->name('assignment.update');
        Route::get('delete/{id}', 'AssignmentController@delete');
    });
});

