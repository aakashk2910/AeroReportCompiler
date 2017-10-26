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
    //
});

Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/criteria', 'Admin\\CriteriaController');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@index');

	Route::get('/giveRole/{userId}/{role}', 'HomeController@attachRoles');
});

Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/criteria', 'Admin\\CriteriaController');
});

Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/subcriteria', 'Admin\\subCriteriaController');
});
/*
$router->get('/report/{uid?}/{sid?}/{reportId?}', [
	'as' => 'report',
	'middleware' => 'role:super.admin',
	'uses' => 'ReportController@index',
]);*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

	Route::get('/report/{uid?}/{sid?}/{reportId?}', 'ReportController@index');

	Route::get('/kbf1/{uid}/{reportId}','ReportController@kbf1');

	Route::get('/kbf2/{uid}/{reportId}','ReportController@kbf2');

	Route::get('gadmin/report/{uid?}/{sid?}', 'ReportController@adminIndex');

    Route::get('/dashboard', 'HomeController@index');

    Route::get('/groupadmin', 'ReportController@select');

	Route::post('/submit/{uid?}/{sid?}/{labelId?}/{reportId?}', 'ReportController@savedata');

	Route::post('/update/{uid?}/{sid?}/{labelId?}/{id?}/{reportId?}', 'ReportController@updatedata');

	Route::get('/add/{uid?}/{sid?}/{labelId}/{reportId?}', 'ReportController@add');

	Route::get('/delete/{uid?}/{sid?}/{labelId?}/{id?}/{reportId?}', 'ReportController@delete');

	Route::get('/reportassign', 'ReportController@assign');

	Route::post('/reportassigned', 'ReportController@assigned');

	Route::get('/scoreIndex', 'ReportController@scoreMapping');

	Route::post('/mappedScore', 'ReportController@mappedScore');

	Route::post('/updateMappedScore', 'ReportController@updateMappedScore');

	Route::post('setScore/{uid?}/{sid?}/{reportId?}', 'ReportController@SetScore' );

	Route::post('updateScore/{uid?}/{sid?}/{reportId?}', 'ReportController@UpdateScore' );

	Route::post('/selectGA','ReportController@SelectGA');

	Route::get('/createReport', 'ReportController@createNew');

	Route::get('/payment/{uid?}', 'ReportController@payment');

	Route::post('/rform/{uid?}', 'ReportController@rform');

	Route::post('/saveReport/{uid?}', 'ReportController@saveNew');

	Route::get('/openReport/{reportId?}', 'ReportController@OpenReport');

	Route::get('/finalReport/{reportId?}', 'ReportController@FinalReport');

	Route::get('/downloadReport/{reportId?}', 'ReportController@DownloadReport');

	Route::get('/finalScore/{reportId?}', 'ReportController@FinalScore');

	Route::get('/adli/{reportId}', 'ReportController@ADLI');

    Route::get('/profile', 'ReportController@Profile');

    Route::post('/uploadPic', 'ReportController@uploadPic');

	Route::post('/dateRange/{reportId?}', 'ReportController@DateRange');


});

Route::group(['middleware' => 'web'], function () {
	Route::auth();

	Route::get('/kbf1/{uid}/{reportId}','ReportController@kbf1');

	Route::get('/kbf2/{uid}/{reportId}','ReportController@kbf2');

	Route::post('/kbf1save/{uid}/{reportId}/{subId}/{opId}','ReportController@kbf1save');

	Route::post('/kbf2save/{uid}/{reportId}/{subId}/{opId}','ReportController@kbf2save');

});

Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/formlabel', 'Admin\\formLabelController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/groupadmin', 'Admin\\groupAdminController');
});

Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/forminput', 'Admin\\FormInputController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/adminindex', 'Admin\\AdminIndexController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/report', 'Admin\\ReportController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/score', 'Admin\\scoreController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/scoretable', 'Admin\\scoreTableController');
});


Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/selectgroupadmin', 'Admin\\SelectGroupAdminController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/organizationalenv', 'Admin\\OrganizationalEnvController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/organizationalprofile', 'Admin\\OrganizationalProfileController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/suborganizationalprofile', 'Admin\\SubOrganizationalProfileController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/innerorganizationalprofile', 'Admin\\InnerOrganizationalProfileController');
});
Route::resource('admin/pic', 'Admin\\PicController');
Route::resource('admin/time', 'Admin\\TimeController');