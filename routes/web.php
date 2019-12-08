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

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    Route::prefix('import')->group(function () {
        Route::get('StudentAccount', 'UserController@showStudentAccountImportForm')->name('admin.import.StudentAccount');
        Route::post('StudentAccount', 'ImportController@importStudentAccount')->name('admin.import.StudentAccount');

        Route::get('StudentInfo', 'StudentController@showStudentInfoImportForm')->name('admin.import.StudentInfo');
        Route::post('StudentInfo', 'ImportController@importStudentInfo')->name('admin.import.StudentInfo');

        Route::get('Subject', 'SubjectController@showSubjectImportForm')->name('admin.import.subject');
        Route::post('Subject', 'ImportController@importSubject')->name('admin.import.subject');

        Route::get('RoomList', 'RoomController@showRoomImportForm')->name('admin.import.room');
        Route::post('RoomList', 'ImportController@importRoom')->name('admin.import.room');

        Route::get('SubjectClass', 'SubjectClassController@showSubjectClassImportForm')->name('admin.import.SubjectClass');
        Route::post('SubjectClass', 'ImportController@importSubjectClass')->name('admin.import.SubjectClass');
    });

    Route::resource('student', 'StudentController')->names([
        'edit' => 'admin.student.edit',
        'update' => 'admin.student.update',
        'destroy' => 'admin.student.delete',
    ]);

    Route::resource('account', 'UserController')->names([
        'edit' => 'admin.user.edit',
        'update' => 'admin.user.update',
        'destroy' => 'admin.user.delete'
    ]);

    Route::resource('subject', 'SubjectController')->names([
        'edit' => 'admin.subject.edit',
        'update' => 'admin.subject.update',
        'destroy' => 'admin.subject.delete'
    ]);

    Route::resource('room', 'RoomController')->names([
        'edit' => 'admin.room.edit',
        'update' => 'admin.room.update',
        'destroy' => 'admin.room.delete'
    ]);

    Route::resource('subjectClass', 'SubjectClassController')->names([
        'edit' => 'admin.SubjectClass.edit',
        'update' => 'admin.SubjectClass.update',
        'destroy' => 'admin.SubjectClass.delete'
    ]);

    Route::prefix('create')->group(function () {
        Route::get('exam', 'ExamController@showCreateForm')->name('admin.create.exam');
    });
});
