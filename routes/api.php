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


Route::post( 'action/setup/options', ['as' => 'api.action.setup.options', 'uses' => 'API\SetupController@siteOptions'] );
Route::post( 'action/setup/admin', ['as' => 'api.action.setup.admin', 'uses' => 'API\SetupController@siteAdmin'] );
Route::post( 'action/fpwd/generate_token', ['as' => 'api.action.fpwd.generate_token', 'uses' => 'API\FpwdController@generateToken'] );
Route::post( 'action/fpwd/reset_password', ['as' => 'api.action.fpwd.reset_password', 'uses' => 'API\FpwdController@resetPassword'] );
Route::post( 'action/login/auth', ['as' => 'api.action.login.auth', 'uses' => 'API\LoginController@auth'] );

Route::group(['as' => 'api.', 'prefix' => '/', 'middleware' => 'auth:api'], function () {

	# Entities CRUD Endpoints
	Route::post( 'candidates', ['as' => 'candidates.add', 'uses' => 'API\CandidatesController@addCandidate'] );
	Route::put( 'candidates/{id}', ['as' => 'candidates.edit', 'uses' => 'API\CandidatesController@editCandidate'] )->where('id', '[0-9]+');
	Route::delete( 'candidates/{id}', ['as' => 'candidates.delete', 'uses' => 'API\CandidatesController@deleteCandidate'] )->where('id', '[0-9]+');

	Route::post( 'departments', ['as' => 'departments.add', 'uses' => 'API\DepartmentsController@addDepartment'] );
	Route::put( 'departments/{id}', ['as' => 'departments.edit', 'uses' => 'API\DepartmentsController@editDepartment'] )->where('id', '[0-9]+');
	Route::delete( 'departments/{id}', ['as' => 'departments.delete', 'uses' => 'API\DepartmentsController@deleteDepartment'] )->where('id', '[0-9]+');

	Route::post( 'jobs', ['as' => 'jobs.add', 'uses' => 'API\JobsController@addJob'] );
	Route::put( 'jobs/{id}', ['as' => 'jobs.edit', 'uses' => 'API\JobsController@editJob'] )->where('id', '[0-9]+');
	Route::delete( 'jobs/{id}', ['as' => 'jobs.delete', 'uses' => 'API\JobsController@deleteJob'] )->where('id', '[0-9]+');

	Route::post( 'roles', ['as' => 'roles.add', 'uses' => 'API\SettingsController@addRole'] );
	Route::put( 'roles/{id}', ['as' => 'roles.edit', 'uses' => 'API\SettingsController@editRole'] )->where('id', '[0-9]+');
	Route::delete( 'roles/{id}', ['as' => 'roles.delete', 'uses' => 'API\SettingsController@deleteRole'] )->where('id', '[0-9]+');

	Route::post( 'permissions', ['as' => 'permissions.add', 'uses' => 'API\SettingsController@addPermission'] );
	Route::put( 'permissions/{id}', ['as' => 'permissions.edit', 'uses' => 'API\SettingsController@editPermission'] )->where('id', '[0-9]+');
	Route::delete( 'permissions/{id}', ['as' => 'permissions.delete', 'uses' => 'API\SettingsController@deletePermission'] )->where('id', '[0-9]+');

	Route::post( 'users', ['as' => 'users.add', 'uses' => 'API\UsersController@addUser'] );
	Route::put( 'users/{id}', ['as' => 'users.edit', 'uses' => 'API\UsersController@editUser'] )->where('id', '[0-9]+');
	Route::delete( 'users/{id}', ['as' => 'users.delete', 'uses' => 'API\UsersController@deleteUser'] )->where('id', '[0-9]+');

	Route::delete( 'routes/{id}', ['as' => 'routes.delete', 'uses' => 'API\SettingsController@deleteRoute'] )->where('id', '[0-9]+');
	Route::put( 'routes/{id}/permission', ['as' => 'routes.set_permission', 'uses' => 'API\SettingsController@updateRoutePermission'] )->where('id', '[0-9]+');

	# Specific Actions Endpoints
	Route::post( 'action/theme/activate', ['as' => 'action.theme.activate', 'uses' => 'API\AppearanceController@activateTheme'] );
	Route::post( 'action/theme/delete', ['as' => 'action.theme.delete', 'uses' => 'API\AppearanceController@deleteTheme'] );
	Route::post( 'action/theme/customize', ['as' => 'action.theme.customize', 'uses' => 'API\AppearanceController@customizeTheme'] );

	Route::post( 'action/department/generate_slug', ['as' => 'action.department.generate_slug', 'uses' => 'API\DepartmentsController@buildDepartmentSlug'] );

	Route::post( 'action/notifications/notify', ['as' => 'action.notifications.notify', 'uses' => 'API\NotificationController@notify'] );

	Route::post( 'action/plugin/activate', ['as' => 'action.plugin.activate', 'uses' => 'API\PluginsController@activatePlugin'] );
	Route::post( 'action/plugin/deactivate', ['as' => 'action.plugin.deactivate', 'uses' => 'API\PluginsController@deactivatePlugin'] );
	Route::post( 'action/plugin/delete', ['as' => 'action.plugin.delete', 'uses' => 'API\PluginsController@deletePlugin'] );

	Route::post( 'action/profile/update_profile', ['as' => 'action.profile.update_profile', 'uses' => 'API\ProfileController@updateProfile'] );
	Route::post( 'action/profile/update_password', ['as' => 'action.profile.update_password', 'uses' => 'API\ProfileController@updatePassword'] );

	Route::post( 'action/settings/update_general_settings', ['as' => 'action.settings.update_general_settings', 'uses' => 'API\SettingsController@updateGeneralSettings'] );
	Route::post( 'action/settings/update_advanced_settings', ['as' => 'action.settings.update_advanced_settings', 'uses' => 'API\SettingsController@updateAdvancedSettings'] );
	Route::post( 'action/settings/sync_routes', ['as' => 'action.settings.sync_routes', 'uses' => 'API\SettingsController@updateRoutes'] );
});