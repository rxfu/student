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
		Route::get('course/match', 'CourseController@match');
		Route::resource('course', 'CourseController', ['only' => ['index']]);

		Route::get('score/listing', 'ScoreController@listing');
		Route::get('score/unconfirmed', 'ScoreController@unconfirmed');
		Route::get('score/exam', 'ScoreController@exam');
		Route::resource('score', 'ScoreController', ['only' => ['index', 'show']]);

		Route::get('selcourse/checktime/{course}', 'SelcourseController@checktime');
		Route::get('selcourse/deletable', 'SelcourseController@deletable');
		Route::get('selcourse/timetable', 'SelcourseController@timetable');
		Route::get('selcourse/search', 'SelcourseController@showSearchForm');
		Route::get('selcourse/search/{campus}', 'SelcourseController@search');
		Route::get('selcourse/listing/{type}/{campus}', 'SelcourseController@listing')->where('type', 'pubsport|public|require|elect|human|nature|art|other');
		Route::get('selcourse/{type}', ['as' => 'selcourse.show', 'uses' => 'SelcourseController@show'])->where('type', 'pubsport|public|require|elect|human|nature|art|other');
		Route::resource('selcourse', 'SelcourseController', ['only' => ['index', 'store', 'destroy']]);

		Route::get('application/is_selected/{course}', 'ApplicationController@isSelected');
		Route::resource('application', 'ApplicationController', ['only' => ['index', 'create', 'store', 'destroy']]);

		Route::get('exam/history', 'ExamController@history');
		Route::resource('exam', 'ExamController', [
			'only'  => ['index', 'edit', 'update', 'destroy'],
			'names' => [
				'edit' => 'exam.register',
			],
		]);

		Route::get('thesis/search', 'ThesisController@showSearchForm');
		Route::get('thesis/searchThesis', 'ThesisController@search');

		Route::get('dcxm/list', 'DcxmController@getList');
		Route::get('dcxm/pdf/{id}', 'DcxmController@getPdf');
		Route::get('dcxm/pdf/download/{id}', 'DcxmController@getDownloadPdf');
		Route::get('dcxm/xmxx', 'DcxmController@getInfo');
		Route::post('dcxm/xmxx', 'DcxmController@postInfo');
		Route::get('dcxm/xmxx/{id}/edit', 'DcxmController@getEditInfo');
		Route::post('dcxm/xmxx/{id}', 'DcxmController@postEditInfo');
		Route::delete('dcxm/xmxx/{id}', 'DcxmController@deleteDeleteInfo');
		Route::get('dcxm/xmsq/{id}', 'DcxmController@getApplication');
		Route::post('dcxm/xmsq/{id}', 'DcxmController@postApplication');
		Route::get('dcxm/zmcl/{id}', 'DcxmController@getFile');
		Route::get('dcxm/xmjf/{id}', 'DcxmController@getFund');
		Route::post('dcxm/xmjf/{id}', 'DcxmController@postFund');
		Route::get('dcxm/xmcy', 'DcxmController@getStudent');
		Route::get('dcxm/zdjs', 'DcxmController@getTeacher');

		Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
		Route::get('password/change', 'Auth\PasswordController@showChangeForm');
		Route::put('password/change', 'Auth\PasswordController@change');
	});
});
