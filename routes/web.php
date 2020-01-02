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
	return redirect()->route('home');
});

Route::auth();

Route::middleware('auth')->group(function () {
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

	Route::get('selcourse/TQTransform', 'SelcourseController@listTQTransform')->name('selcourse.listtq');
	Route::post('selcourse/TQTransform/{course}', 'SelcourseController@TQTransform')->name('selcourse.tqtransform');
	Route::get('selcourse/checktime/{course}', 'SelcourseController@checktime');
	Route::get('selcourse/checkretake/{course}', 'SelcourseController@checkretake');
	Route::get('selcourse/deletable', 'SelcourseController@deletable');
	Route::get('selcourse/timetable', 'SelcourseController@timetable');
	Route::get('selcourse/search', 'SelcourseController@showSearchForm');
	Route::get('selcourse/search/{campus}', 'SelcourseController@search');
	Route::get('selcourse/listing/{type}/{campus}', 'SelcourseController@listing')->where('type', 'pubsport|public|require|elect|human|nature|art|other');
	Route::get('selcourse/{type}', ['as' => 'selcourse.show', 'uses' => 'SelcourseController@show'])->where('type', 'pubsport|public|require|elect|human|nature|art|other');
	Route::get('selcourse/history', 'SelcourseController@history');
	Route::delete('selcourse/{type}/{kcxh}', 'SelcourseController@destroy')->name('selcourse.destroy');
	Route::resource('selcourse', 'SelcourseController', ['only' => ['index', 'store']]);

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

	Route::get('xfzh/list', 'XfzhController@list');
	Route::get('xfzh/create', 'XfzhController@create');
	Route::post('xfzh/store', 'XfzhController@store');
	Route::delete('xfzh/delete/{id}', 'XfzhController@delete');

	Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
	Route::get('password/change', 'Auth\PasswordController@showChangeForm');
	Route::put('password/change', 'Auth\PasswordController@change');
});
/*
Route::middleware('auth')->group(function () {
	Route::get('/parent', 'FmxxController@index')->name('fmxx');
	Route::post('/parent', 'FmxxController@parent');
});
*/