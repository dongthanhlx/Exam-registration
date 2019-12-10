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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

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
        Route::get('StudentAccount', 'UserController@showStudentAccountImportForm')->name('StudentAccount');
        Route::post('StudentAccount', 'ImportController@importStudentAccount')->name('StudentAccount');

        Route::get('StudentInfo', 'StudentController@showStudentInfoImportForm')->name('.StudentInfo');
        Route::post('StudentInfo', 'ImportController@importStudentInfo')->name('StudentInfo');

        Route::get('Subject', 'SubjectController@showSubjectImportForm')->name('subject');
        Route::post('Subject', 'ImportController@importSubject')->name('subject');

        Route::get('RoomList', 'RoomController@showRoomImportForm')->name('room');
        Route::post('RoomList', 'ImportController@importRoom')->name('room');

        Route::get('SubjectClass', 'SubjectClassController@showSubjectClassImportForm')->name('SubjectClass');
        Route::post('SubjectClass', 'ImportController@importSubjectClass')->name('SubjectClass');

        Route::get('test', 'RoomController@test')->name('test');
    });

    Route::resource('student', 'StudentController')->names([
        'edit' => 'student.edit',
        'update' => 'student.update',
        'destroy' => 'student.delete',
    ]);

    Route::resource('account', 'UserController')->names([
        'edit' => 'user.edit',
        'update' => 'user.update',
        'destroy' => 'user.delete'
    ]);

    Route::resource('subject', 'SubjectController')->names([
        'edit' => 'subject.edit',
        'update' => 'subject.update',
        'destroy' => 'subject.delete'
    ]);

    Route::resource('room', 'RoomController')->names([
        'edit' => 'room.edit',
        'update' => 'room.update',
        'destroy' => 'room.delete'
    ]);

    Route::resource('subjectClass', 'SubjectClassController')->names([
        'edit' => 'SubjectClass.edit',
        'update' => 'SubjectClass.update',
        'destroy' => 'SubjectClass.delete'
    ]);

    Route::resource('exam', 'ExamController');

    Route::get('test', function () {
        return view('admin.scheduling');
    })->name('test');

});

Route::get('test', 'RoomController@test');