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

use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/logout', 'Auth\LoginController@userLogout')->name('logout');
Route::get('studentInfoByUserID/{id}', 'ExamRegistrationController@getStudentInfoByUserID')->name('studentInfoByUserID');

Route::resource('examRegistration', 'ExamRegistrationController');

Route::get('all/infoRegistered/{id}', 'ExamRegistrationController@getRegistered')->name('all.infoRegistered');
Route::get('checkStatusAt/{time}', 'ExamRegistrationController@checkStatusAt')->name('checkStatusAt');
Route::get('newestExam', 'ExamRegistrationController@getNewestExam')->name('newestExam');
Route::get('infoScheduling', 'SchedulingController@getAllInfo')->name('infoScheduling');
Route::get('infoSchedulingByStudentID/{id}', 'SchedulingController@getSchedulingByStudentID')->name('infoSchedulingByStudentID');
Route::get('infoPrint/{id}', 'ExamRegistrationController@getInfoPrint')->name('infoPrint');

Route::get('/contestCard', function () {
    return view('contestCard');
})->name('contestCard');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('login.submit');
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('password.reset');

    Route::prefix('import')->name('import.')->group(function () {
        Route::post('StudentAccount', 'ImportController@studentAccount')->name('StudentAccount');
        Route::post('StudentInfo', 'ImportController@studentInfo')->name('StudentInfo');
        Route::post('subject', 'ImportController@subject')->name('subject');
        Route::post('room', 'ImportController@room')->name('room');
        Route::post('SubjectClass', 'ImportController@subjectClass')->name('SubjectClass');
        Route::post('StudentOfSubjectClass', 'ImportController@studentOfSubjectClass')->name('StudentOfSubjectClass');
        Route::post('StudentNotEligible', 'ImportController@studentNotEligible')->name('StudentNotEligible');
        Route::get('downloadSampleForm/{name}', 'ImportController@downloadSampleForm')->name('downloadSampleForm');
    });

    Route::resource('student', 'StudentController');
    Route::resource('account', 'UserController');
    Route::resource('subject', 'SubjectController');
    Route::resource('room', 'RoomController');
    Route::resource('SubjectClass', 'SubjectClassController');
    Route::resource('exam', 'ExamController');
    Route::resource('scheduling', 'SchedulingController')->middleware('auth:admin');
    Route::resource('registrationStudy', 'RegistrationStudyController');

    Route::prefix('all')->name('all.')->group(function () {
        Route::get('year', 'ExamController@allYear')->name('year');
        Route::get('room', 'RoomController@showAll')->name('room');
        Route::get('account', 'UserController@showAll')->name('account');
        Route::get('student', 'StudentController@showAll')->name('student');
        Route::get('subject', 'SubjectController@showAll')->name('subject');
        Route::get('subjectOfExam/{year}/{semester}', 'SubjectController@getByYearAndSemester')->name('subjectOfExam');/*
        Route::get('subjectClassOfExam/{year}/{semester}', 'SubjectClassController@getByYearAndSemester')->name('subjectClassOfExam');
        Route::get('serialOfSubjectCode/{subjectCode}', 'SubjectClassController@getSerialBySubjectCode')->name('serialOfSubjectCode');
        Route::get('studentOfSubjectCode/{subjectCode}', 'StudentController@getBySubjectCode')->name('studentOfSubjectCode');*/
        Route::get('subjectClassOfExam/{year}/{semester}', 'SubjectClassController@getByYearAndSemester')->name('subjectClassOfExam');
        Route::get('studentOfSubjectCodeAndExamID/{subjectCode}/{exam_id}', 'StudentController@getBySubjectCodeAndExamID')->name('studentOfSubjectCodeAndExamID');
        Route::get('remainingRoomInfoInDateAndExamShift/{date}/{examShift}', 'SchedulingController@getAllRemainingRoomInfoInDayAndExamShift')->name('remainingRoomInfoInDateAndExamShift')->middleware('auth:admin');
        Route::get('schedulingByExamID/{id}', 'SchedulingController@getAllInfoByExamID')->name('schedulingByExamID')->middleware('auth:admin');
        Route::get('roomBySubjectCodeAndExamShift/{subjectCode}/{examShift}/{examID}', 'RoomController@getBySubjectCodeAndExamShift')->name('roomBySubjectCodeAndExamShift');
        Route::get('studentBySchedulingID/{id}/{roomID}', 'StudentController@getAllStudentByExamRegistrationID')->name('studentBySchedulingID');
    });

    Route::get('/examRegistrationResult', 'ExamRegistrationController@result')->name('examRegistrationResult')->middleware('auth:admin');
    Route::get('examActive', 'ExamController@getExamActive')->name('examActive');
});