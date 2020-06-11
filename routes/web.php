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

/*******************User Routes*************************/
Auth::routes(['register' => false]);


Route::get('/', function () {
      return view('front.welcome');})->name('home');
      Route::get('/user/dashboard','FrontController@home') ->name('dashboard');
  
      Route::get('/contact',[
        'uses'=>'FrontController@contact',
        'as'=>'patient.contact'
    ]);

    Route::get('/doctors/search', [
        'uses'=>'FrontController@doctors_search',
        'as'=>'patient.search_doctor'
    ]);


    Route::get('/patient/register', [
        'uses'=>'FrontController@patient_register',
        'as'=>'patient.register'
    ]);


    Route::get('/book_appointment/{id}', [
        'uses'=>'FrontController@bookAppointment',
        'as'=>'patient.book_appointment'
    ])->middleware('auth');

    Route::get('/appointment_book', [
        'uses'=>'FrontController@appointment_book',
        'as'=>'patient.appointment_book'
    ])->middleware('auth');

    Route::get('/patient_dashboardd', [
        'uses'=>'FrontController@patient_dashboardd',
        'as'=>'patient.patient_dashboardd'

    ]);
    Route::post('/make-payment', 'PaymentsController@pay');
    Route::get('payment/{session}', 'StripePaymentController@stripe2')->name('payment');
    Route::get('payout', 'StripePaymentController@index')->name('withdraw');
    Route::post('payout', 'StripePaymentController@transfer')->name('transfer');
    Route::get('refund/{session}', 'StripePaymentController@refund')->name('refund');
    Route::post('stripe/{session}', 'StripePaymentController@stripePost')->name('stripe.post');
    Route::post('/doctors/search', 'FrontController@search')->name("search");
    Route::get('view_doctor_profile/{doctor}','FrontController@view_doctor_profile')->name('patient.view_doctor_profile');
    

    Route::get('/send/email', 'HomeController@mail');

    Route::get('/calendar/show/{id}', ['uses'=>'HomeController@show','as'=>'calendar.appointments.show']);
    Route::post('users/media', 'Admin\UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'Admin\UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::post('doctors/media', 'Admin\DoctorController@storeMedia')->name('doctors.storeMedia');
    Route::post('doctors/ckmedia', 'Admin\DoctorController@storeCKEditorImages')->name('doctors.storeCKEditorImages');
    Route::delete('sessions/destroy', 'Admin\SessionsController@massDestroy')->name('sessions.massDestroy');
    Route::resource('sessions', 'Admin\SessionsController');

/*******************Admin Routes*************************/

Route::name('admin.')->group(function () {
    Route::get('/home', 'Admin\HomeController@index')->name('dashboard');
    Route::get('system-calendar', 'Admin\SystemCalendarController@index')->name('systemCalendar');

    Route::resource('roles', 'Admin\RolesController');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::resource('users', 'Admin\UsersController');
    Route::resource('doctors', 'Admin\DoctorController');
    Route::resource('patients', 'Admin\PatientsController');
    Route::resource('appointments', 'Admin\AppointmentsController');
    Route::resource('messages', 'Admin\MessagesController');
    Route::resource('doctors', 'Admin\DoctorController');

    Route::get('/join_requests', ['uses'=>'Admin\DoctorController@join_request','as'=>'doctors.join_requests']);
    
    Route::get('/join_request/{id}', ['uses'=>'Admin\DoctorController@approve_doctor','as'=>'approve_doctor']);
    
    Route::get('/accept_doctor/{id}', [
        'uses'=>'Admin\DoctorController@acceptDoctor',
        'as'=>'accept_doctor'
    ]);
    
    Route::get('/reject_doctor/{id}', [
        'uses'=>'Admin\DoctorController@rejectDoctor',
        'as'=>'reject_doctor'
    ]);
    

    });

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('admin/profile', 'HomeController@profile')->name('profile');
// Patients
    Route::delete('patients/destroy', 'PatientsController@massDestroy')->name('patients.massDestroy');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::post('doctors/media', 'DoctorController@storeMedia')->name('doctors.storeMedia');
    Route::post('doctors/ckmedia', 'DoctorController@storeCKEditorImages')->name('doctors.storeCKEditorImages');
    Route::resource('users', 'UsersController');
    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::resource('appointments', 'AppointmentsController');
    // Doctors
    Route::delete('doctors/destroy', 'DoctorController@massDestroy')->name('doctors.massDestroy');


});

//Doctor Module Routes
Route::group(['prefix' => 'doctor', 'as' => 'doctor.', 'namespace' => 'Doctor', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('dashboard');
    Route::get('profile', 'HomeController@profile')->name('profile');
    Route::post('/add_treatment', 'PatientsController@store')->name('treatment_record.store');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::get('appointments/new', 'AppointmentsController@appointment_requests')->name('appointments.requests');
    Route::get('sessions/accept/{id}', 'SessionsController@accept')->name('session.accept');
    Route::get('sessions/reject/{id}', 'SessionsController@reject')->name('session.reject');

    Route::resource('appointments', 'AppointmentsController');
    Route::resource('patients', 'PatientsController');
    Route::get('appointment/accept/{id}', 'AppointmentsController@accept')->name('appointment.accept');
    Route::get('appointment/reject/{id}', 'AppointmentsController@reject')->name('appointment.reject');
    Route::get('sessions/requests', 'SessionsController@session_requests')->name('sessions.requests');
    Route::resource('payments', 'PaymentsController');
    // Sessions
    Route::resource('sessions', 'SessionsController');
    Route::get('sessions/{appointment}/create', 'SessionsController@create')->name('sessions.create');

    Route::resource('exercises', 'ExercisesController');
    Route::get('/add_treatment/{session}',[
        'uses'=>'PatientsController@add_treatment',
        'as'=>'patients.add_treatment'
    ]);

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    // Patients
});


//
//Patient Module Routes
Route::group(['prefix' => 'patient', 'as' => 'patient.', 'namespace' => 'Patient', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('dashboard');
    Route::get('profile', 'HomeController@profile')->name('profile');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::get('appointments/new', 'AppointmentsController@appointment_requests')->name('appointments.requests');
    Route::get('sessions/accept/{id}', 'SessionsController@accept')->name('session.accept');
    Route::get('sessions/reject/{id}', 'SessionsController@reject')->name('session.reject');

    Route::resource('appointments', 'AppointmentsController');
    Route::resource('doctors', 'DoctorController');

    Route::get('sessions/requests', 'SessionsController@session_requests')->name('sessions.requests');
    Route::resource('payments', 'PaymentsController');
    // Sessions
    Route::resource('sessions', 'SessionsController');
    Route::get('sessions/{appointment}/create', 'SessionsController@create')->name('sessions.create');
    Route::get('appointments/{session}/start', 'SessionsController@startcall')->name('sessions.startcall');
    Route::get('patient/{patient}/show', 'PatientsController@show')->name('patients.show');

    Route::resource('exercises', 'ExercisesController');
    Route::get('/view_treatment/{session}',[
        'uses'=>'PatientsController@view_treatment',
        'as'=>'view_treatment'
    ]);

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    // Patients
});





Route::get('/doctor_dashboard',[
    'uses'=>'DoctorController@index',
    'as'=>'doctor.index'
    ]);
    Route::get('/appointment',[
        'uses'=>'DoctorController@appointment',
        'as'=>'doctor.appointment'
    ]);
    Route::get('/appointments',[
        'uses'=>'DoctorController@appointments',
        'as'=>'doctor.appointments'
    ]);
    Route::get('/treated_patients',[
        'uses'=>'DoctorController@treated_patients',
        'as'=>'doctor.patients'
    ]);
    Route::get('/unregistered_patient',[
        'uses'=>'DoctorController@unregistered_patient',
        'as'=>'doctor.unregister_patient'
    ]);
    Route::get('/register_patient',[
        'uses'=>'DoctorController@register_patient',
        'as'=>'doctor.patient'
    ]);
    Route::get('/register/doctor', [
        'uses'=>'DoctorController@register_doctor',
        'as'=>'doctor.register'
    ]);
    Route::get('/treatment', [
        'uses'=>'DoctorController@treatment',
        'as'=>'doctor.treatment'
    ]);
    Route::get('/schedule', [
        'uses'=>'DoctorController@schedule',
        'as'=>'doctor.schedule'
    ]);
    Route::get('/video_call', [
        'uses'=>'DoctorController@video_call',
        'as'=>'doctor.video_call'
    ]);
    Route::get('/payment', [
        'uses'=>'DoctorController@payment',
        'as'=>'doctor.payment'
    ]);
    
    Route::post('/home2', [
        'uses' => 'DoctorController@store'
    ]);
    