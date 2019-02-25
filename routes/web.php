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
    return redirect()->route('login');
});

// Auth::routes();
// Authentication Routes...
	$this->get('/login', 'Auth\LoginController@showLoginForm')->name('login');
	$this->post('/login', 'Auth\LoginController@login');
	$this->post('/logout', 'Auth\LoginController@logout')->name('logout');

/*	// Registration Routes...
	$this->get('/naNljDFJvX', 'Auth\RegisterController@showRegistrationForm')->name('register');
	$this->post('/naNljDFJvX', 'Auth\RegisterController@register');

	// Password Reset Routes...
	$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	 $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	$this->get('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	$this->post('password/reset', 'Auth\ResetPasswordController@reset');*/


Route::get('/home', 'HomeController@index')->name('home');

// faculty routes
Route::get('faculties', 'FacultyController@index')->name('faculty.index');
Route::get('faculty/create', 'FacultyController@create')->name('faculty.create');
Route::post('faculty/create', 'FacultyController@store')->name('faculty.store');
Route::get('faculty/{id}/edit', 'FacultyController@edit')->name('faculty.edit');
// Route::get('faculty/{id}', 'FacultyController@show')->name('faculty.show');
Route::get('/faculty/show', 'FacultyController@show')->name('faculty.show');
Route::match(['PUT', 'PATCH'], 'faculty/{id}/edit', 'FacultyController@update')->name('faculty.update');
Route::delete('faculty/{id}/delete', 'FacultyController@destroy')->name('faculty.destroy');
Route::get('faculty/{id}/schedule', 'FacultyController@schedule')->name('faculty.schedule');

// subject routes
Route::get('subjects', 'SubjectController@index')->name('subject.index');
Route::get('subject/create', 'SubjectController@create')->name('subject.create');
Route::post('subject/create', 'SubjectController@store')->name('subject.store');
Route::get('subject/{id}/edit', 'SubjectController@edit')->name('subject.edit');
// Route::get('subject/{id}', 'SubjectController@show')->name('subject.show');
Route::get('/subject/show', 'SubjectController@show')->name('subject.show');
Route::match(['PUT', 'PATCH'], 'subject/{id}/edit', 'SubjectController@update')->name('subject.update');
Route::delete('subject/{id}/delete', 'SubjectController@destroy')->name('subject.destroy');

// section routes
Route::get('sections', 'SectionController@index')->name('section.index');
Route::get('section/create', 'SectionController@create')->name('section.create');
Route::post('section/create', 'SectionController@store')->name('section.store');
Route::get('section/{id}/edit', 'SectionController@edit')->name('section.edit');
// Route::get('section/{id}', 'SectionController@show')->name('section.show');
Route::get('/section/show', 'SectionController@show')->name('section.show');
Route::match(['PUT', 'PATCH'], 'section/{id}/edit', 'SectionController@update')->name('section.update');
Route::delete('section/{id}/delete', 'SectionController@destroy')->name('section.destroy');
Route::get('section/{id}/schedule/create', 'SectionController@scheduleCreate')->name('section.schedule.create');
Route::post('section/{id}/schedule/store', 'SectionController@scheduleStore')->name('section.schedule.store');
Route::get('section/{id}/schedule', 'SectionController@schedule')->name('section.schedule');

