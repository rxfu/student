<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
	return redirect('home');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
 */

Route::group(['middleware' => ['web']], function () {
	Route::auth();

	Route::group(['middleware' => ['auth']], function () {
		Route::resource('home', 'HomeController', ['only' => ['index']]);
		Route::resource('requirement', 'RequirementController', ['only' => ['index']]);
		Route::resource('fresh', 'FreshController', ['only' => ['edit', 'update']]);

		Route::get('profile/upfile', 'ProfileController@showUpfileForm');
		Route::post('profile/upload', 'ProfileController@upload');
		Route::get('profile/portrait', 'ProfileController@portrait');
		Route::get('profile/photo', 'ProfileController@photo');
		Route::resource('profile', 'ProfileController', ['only' => ['index']]);

		Route::get('log/listing', 'LogController@listing');
		Route::resource('log', 'LogController', ['only' => ['index']]);

		Route::get('message/listing', 'MessageController@listing');
		Route::resource('message', 'MessageController', ['only' => ['index']]);

		Route::get('plan/listing', 'PlanController@listing');
		Route::resource('plan', 'PlanController', ['only' => ['index']]);

		Route::get('course/major', 'CourseController@major');
		Route::get('course/listing', 'CourseController@listing');
		Route::resource('course', 'CourseController', ['only' => ['index']]);

		Route::get('score/listing', 'ScoreController@listing');
		Route::get('score/unconfirmed', 'ScoreController@unconfirmed');
		Route::get('score/exam', 'ScoreController@exam');
		Route::resource('score', 'ScoreController', ['only' => ['index', 'show']]);

		Route::get('selcourse/deletable', 'SelcourseController@deletable');
		Route::get('selcourse/timetable', 'SelcourseController@timetable');
		Route::resource('selcourse', 'SelcourseController', ['only' => ['index', 'destroy']]);

		Route::resource('application', 'ApplicationController', ['only' => ['index', 'create', 'store', 'destroy']]);

		Route::get('exam/history', 'ExamController@history');
		Route::resource('exam', 'ExamController', [
			'only'  => ['index', 'edit', 'update', 'destroy'],
			'names' => [
				'edit' => 'exam.register',
			],
		]);

		Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
		Route::get('password/change', 'Auth\PasswordController@showChangeForm');
		Route::put('password/change', 'Auth\PasswordController@change');
	});
});
