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

    Route::group(['middleware' => ['doctor']],function() {
        Route::get('patients', 'PatientsController@index')->name('patients.index');
        Route::get('patients/get', 'PatientsController@getMyPatients')->name('patients.getMyPatients');
        Route::get('patients/addPatient/{id}', 'PatientsController@addPatient')->name('patients.addPatient');
        Route::get('patients/rejectPatient/{id}', 'PatientsController@rejectPatient')->name('patients.rejectPatient');
        Route::get('patients/acceptPatient/{id}', 'PatientsController@acceptPatient')->name('patients.acceptPatient');
        Route::resource('schedulePatient', 'SchedulePatientController');
        Route::post('schedulePatient/retrievePatients', 'SchedulePatientController@retrievePatients');
    });

    Route::group(['middleware' => ['patient']],function() {
        Route::get('doctors', 'DoctorsController@index')->name('doctors.index');
        Route::post('doctors/setRating', 'DoctorsController@setRating')->name('doctors.setRating');
        Route::get('doctors/addDoctor/{id}', 'DoctorsController@addDoctor')->name('doctors.addDoctor');
        Route::get('patients/rejectDoctor/{id}', 'DoctorsController@rejectDoctor')->name('doctors.rejectDoctor');
        Route::get('patients/acceptDoctor/{id}', 'DoctorsController@acceptDoctor')->name('doctors.acceptDoctor');
        Route::resource('schedule', 'ScheduleController');
        Route::post('schedule/retrieveDoctors', 'ScheduleController@retrieveDoctors');
    });



    Route::resource('calendar', 'CalendarController');


    Route::get('messenger/', 'MessageController@show')->name('messenger.show');
    Route::get('messenger/{id}', 'MessageController@chatHistory')->name('messenger.read');

    Route::get('notifications/open/{id}', 'NotificationsController@open')->name('notifications.open');


    Route::group(['prefix'=>'ajax', 'as'=>'ajax::'], function() {
        Route::post('message/send', 'MessageController@ajaxSendMessage')->name('message.new');
        Route::delete('message/delete/{id}', 'MessageController@ajaxDeleteMessage')->name('message.delete');

        Route::post('schedule/appointmentsDoctor', 'ScheduleController@ajaxAppointmentsDoctor')->name('schedule.appointmentsDoctor');
        Route::post('schedulePatient/appointmentsPatient', 'SchedulePatientController@ajaxAppointmentsPatient')->name('schedulePatient.appointmentsPatient');
    });

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

Route::group(['middleware' => ['auth'], 'prefix' => 'laboratory', 'as' => 'laboratory.'], function () {
    Route::resource('typeAnalises', 'Laboratory\TypeAnalisisController');
    Route::get('typeAnalises/get', 'Laboratory\Laboratory@getTypeAnalisis');
    Route::resource('analises', 'Laboratory\AnalisisController');
});
