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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::prefix('admin')->group(function (){
    Route::get('/sessionSet','AdminController@sessionSet');
    Route::get('/setDefenseSchedule','AdminController@setDefenseSchedule');
    Route::get('/getDefenseSchedule','AdminController@getDefenseSchedule');
    Route::get('/registerStudent','AdminController@studentViewRegister');
    Route::get('/registerLecturer','AdminController@lecturerViewRegister');
    Route::get('/studentSearch','AdminController@studentSearch');
    Route::get('/getDefenseScheduleDetail/{id}','AdminController@getDefenseScheduleDetail');
    Route::get('/studentDetail/{id}','AdminController@studentDetail');
    

    Route::post('/register/student','UserController@studentRegister');
    Route::post('/register/lecturer','UserController@lecturerRegister');

});


Route::prefix('student')->group(function(){
    Route::post('/submitTitle','StudentController@submitTitle');
    Route::post('/submitAdvisor','StudentController@submitAdvisor');
    Route::post('/uploadDocThesisProposal','StudentController@uploadDocThesisProposal');
    Route::post('/uploadDocThesisInterim','StudentController@uploadDocThesisInterim');
    Route::post('/uploadDocThesisFinalDraft','StudentController@uploadDocThesisFinalDraft');
});