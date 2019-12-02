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
        Route::get('StudentAccount', 'ImportController@showStudentAccountImportForm')->name('admin.import.StudentAccount');
        Route::post('StudentAccount', 'ImportController@importStudentAccount')->name('admin.import.StudentAccount');

        Route::get('StudentInfo', 'ImportController@showStudentInfoImportForm')->name('admin.import.StudentInfo');
        Route::post('StudentInfo', 'ImportController@importStudentInfo')->name('admin.import.StudentInfo');

        Route::get('StudentListOfSubject', 'ImportController@showStudentListOfSubjectImportForm')->name('admin.import.StudentListOfSubject');
        Route::post('StudentListOfSubject', 'ImportController@importStudentListOfSubject')->name('admin.import.StudentListOfSubject');
    });
});
