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

Route::get('/', 'HomeController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']],function(){
    Route::resource('profile', 'ProfileController');
    Route::resource('patients', 'PatientsController');
    Route::resource('calendar', 'CalendarController');
});


Route::group(['middleware' => ['auth'], 'prefix' => 'administration', 'as' => 'administration.'], function () {
    Route::resource('users', 'Administration\UserController');
    Route::resource('roles', 'Administration\RoleController');
    Route::resource('permissions', 'Administration\PermissionController');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'medical', 'as' => 'medical.'], function () {
    Route::resource('medicalAppointments', 'Medical\MedicalAppointmentController');
    Route::resource('patients', 'Medical\PatientController');
    Route::resource('doctors', 'Medical\DoctorController');
    Route::resource('medicalAppointmentStates', 'Medical\MedicalAppointmentStateController');
    Route::resource('medicalConsultants', 'Medical\MedicalConsultantController');
    Route::resource('medicalSpecialties', 'Medical\MedicalSpecialityController');

});
