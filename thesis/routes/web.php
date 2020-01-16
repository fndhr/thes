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
    return redirect('login');
});

Auth::routes();

Route::get('/home', ['middleware' => 'auth', 'uses' => 'HomeController@index']);
Route::post('/homeChangePass','HomeController@changePassword') ->name('home');
//Route::post('/downloadFile','HomeController@downloadFile');
Route::post('/downloadFileProposal','HomeController@downloadFileProposal');
Route::post('/downloadFileInterim','HomeController@downloadFileInterim');
Route::post('/downloadFileFinalDraft','HomeController@downloadFileFinalDraft');
Route::post('/downloadFileFinalizedDoc','HomeController@downloadFileFinalizedDoc');
Route::post('/downloadFileRevisedDoc','HomeController@downloadFileRevisedDoc');
Route::post('/viewFileProposal','HomeController@viewFileProposal');
Route::post('/viewFileInterim','HomeController@viewFileInterim');
Route::post('/viewFileFinalDraft','HomeController@viewFileFinalDraft');
Route::post('/viewFileFinalizedDoc','HomeController@viewFileFinalizedDoc');
Route::post('/viewFileRevisedDoc','HomeController@viewFileRevisedDoc');

Route::prefix('admin')->group(function (){
    Route::get('/sessionSet','AdminController@sessionSet');
    Route::get('/sessionSet/{id}','AdminController@sessionEdit');
    Route::get('/setDefenseSchedule/{id}','AdminController@setDefenseSchedule');
    Route::get('/getDefenseSchedule','AdminController@getDefenseSchedule');
    Route::get('/registerStudent','AdminController@studentViewRegister');
    Route::get('/registerLecturer','AdminController@lecturerViewRegister');
    Route::get('/studentSearch','AdminController@studentSearch');
    Route::get('/getDefenseScheduleDetail/{id}','AdminController@getDefenseScheduleDetail');
    Route::get('/studentDetail/{id}','AdminController@studentDetail');

    Route::post('/register/student','UserController@studentRegister');
    Route::post('/register/lecturer','UserController@lecturerRegister');
    Route::post('/approve/advisor','AdminController@approveAdvisor');
    Route::post('/approve/title','AdminController@approveTitle');
    Route::post('/disapprove/advisor','AdminController@disapproveAdvisor');
    Route::post('/disapprove/title','AdminController@disapproveTitle');
    Route::post('/studentSearch','AdminController@studentSearchFilter');
    Route::post('/createSessionSet','AdminController@createSessionSet');
    Route::post('/editSessionSet','AdminController@editSessionSet');
    Route::post('/submitSetDefenseSchedule','AdminController@submitSetDefenseSchedule');
    Route::post('/defenseSearchFilter','AdminController@defenseSearchFilter');
});


Route::prefix('student')->group(function(){
    Route::post('/submitTitle','StudentController@submitTitle');
    Route::post('/submitAdvisor','StudentController@submitAdvisor');
    Route::post('/submitAdvisorTitle','StudentController@submitAdvisorTitle');
    Route::post('/uploadDocThesisProposal','StudentController@uploadDocThesisProposal');
    Route::post('/uploadDocThesisInterim','StudentController@uploadDocThesisInterim');
    Route::post('/uploadDocThesisFinalDraft','StudentController@uploadDocThesisFinalDraft');
    Route::post('/uploadSignedRevisedDoc','StudentController@uploadSignedRevisedDoc');
    Route::post('/uploadFinalizedDoc','StudentController@uploadFinalizedDoc');
    
});

Route::prefix('lecturer')->group(function(){
    Route::get('/studentSearch','LecturerController@studentSearch');
    Route::get('/studentDetail/{id}','LecturerController@studentDetail');
    Route::get('/defenseScheduleSearch','LecturerController@defenseScheduleSearch');
    Route::get('/getDefenseScheduleDetail/{id}','LecturerController@getDefenseScheduleDetail');
    Route::get('/defensescoring/{id}','LecturerController@defenseScoring');

    Route::post('/studentSearch','LecturerController@studentSearchFilter');
    Route::post('/defenseSearchFilter','LecturerController@defenseSearchFilter');
    Route::post('/submitScoring','LecturerController@submitScoring');
    Route::post('/approve/document','LecturerController@approveDocument');
    Route::post('/disapprove/document','LecturerController@disapproveDocument');
});