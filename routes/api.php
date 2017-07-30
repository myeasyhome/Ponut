<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['as' => 'api.', 'prefix' => '/'], function () {

	# Action specific endpoints
	Route::post( 'action/setup/options', ['as' => 'action.setup.options', 'uses' => 'API\SetupController@siteOptions'] );
	Route::post( 'action/setup/admin', ['as' => 'action.setup.admin', 'uses' => 'API\SetupController@siteAdmin'] );

});