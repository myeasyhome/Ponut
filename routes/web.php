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

Route::get( 'setup', ['as' => 'home.setup.render', 'uses' => 'Web\SetupController@setup'] );
Route::get( '/', ['as' => 'home.index.render', 'uses' => 'Web\HomeController@landing'] );
Route::get( '404', ['as' => 'home.notfound.render', 'uses' => 'Web\HomeController@notfound'] );
Route::get( '503', ['as' => 'home.error.render', 'uses' => 'Web\HomeController@error'] );
Route::get( 'jobs/{dept_slug?}/{job_slug?}', ['as' => 'home.jobs.render', 'uses' => 'Web\HomeController@jobs'] );
Route::get( 'forgot-password', ['as' => 'home.forgot_password.render', 'uses' => 'Web\FpwdController@forgotPassword'] );
Route::get( 'reset-password/{hash}', ['as' => 'home.reset_password.render', 'uses' => 'Web\FpwdController@resetPassword'] );
Route::get( 'login', ['as' => 'login', 'uses' => 'Web\LoginController@login'] );

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get( '/', ['as' => 'dashboard.index.render', 'uses' => 'Web\DashboardController@dashboard'] );
    Route::get( 'profile', ['as' => 'profile.index.render', 'uses' => 'Web\ProfileController@profile'] );
    Route::get( 'notifications', ['as' => 'notifications.index.render', 'uses' => 'Web\ProfileController@notifications'] );

    Route::group(['as' => 'candidates.', 'prefix' => 'candidates'], function () {
        Route::get( '/', ['as' => 'index.render', 'uses' => 'Web\CandidatesController@candidatesList'] );
        Route::get( 'add', ['as' => 'add.render', 'uses' => 'Web\CandidatesController@addCandidate'] );
        Route::get( 'view/{id}', ['as' => 'view.render', 'uses' => 'Web\CandidatesController@viewCandidate'] );
    });

    Route::group(['as' => 'departments.', 'prefix' => 'departments'], function () {
        Route::get( '/', ['as' => 'index.render', 'uses' => 'Web\DepartmentsController@departmentsList'] );
        Route::get( 'add', ['as' => 'add.render', 'uses' => 'Web\DepartmentsController@addDepartment'] );
        Route::get( 'edit/{id}', ['as' => 'edit.render', 'uses' => 'Web\DepartmentsController@editDepartment'] );
        Route::get( 'view/{id}', ['as' => 'view.render', 'uses' => 'Web\DepartmentsController@viewDepartment'] );
    });

    Route::group(['as' => 'jobs.', 'prefix' => 'jobs'], function () {
        Route::get( '/', ['as' => 'index.render', 'uses' => 'Web\JobsController@jobsList'] );
        Route::get( 'add', ['as' => 'add.render', 'uses' => 'Web\JobsController@addJob'] );
        Route::get( 'edit/{id}', ['as' => 'edit.render', 'uses' => 'Web\JobsController@editJob'] );
        Route::get( 'view/{id}', ['as' => 'view.render', 'uses' => 'Web\JobsController@viewJob'] );
    });

    Route::group(['as' => 'users.', 'prefix' => 'users'], function () {
        Route::get( '/', ['as' => 'index.render', 'uses' => 'Web\UsersController@usersList'] );
        Route::get( 'add', ['as' => 'add.render', 'uses' => 'Web\UsersController@addUser'] );
        Route::get( 'edit/{id}', ['as' => 'edit.render', 'uses' => 'Web\UsersController@editUser'] );
    });

    Route::get( 'calendar', ['as' => 'calendar.index.render', 'uses' => 'Web\CalendarController@calendar'] );

    Route::group(['as' => 'appearance.', 'prefix' => 'appearance'], function () {
        Route::get( 'themes', ['as' => 'themes.render', 'uses' => 'Web\AppearanceController@themesList'] );
        Route::get( 'customize', ['as' => 'customize.render', 'uses' => 'Web\AppearanceController@customizeTheme'] );
    });

    Route::get( 'plugins', ['as' => 'plugins.index.render', 'uses' => 'Web\PluginsController@plugins'] );

    Route::group(['as' => 'tools.', 'prefix' => 'tools'], function () {
        Route::get( 'export', ['as' => 'export.render', 'uses' => 'Web\ToolsController@export'] );
        Route::get( 'import', ['as' => 'import.render', 'uses' => 'Web\ToolsController@import'] );
        Route::get( 'backups', ['as' => 'backups.render', 'uses' => 'Web\ToolsController@backups'] );
    });

    Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {
        Route::get( 'general', ['as' => 'general.render', 'uses' => 'Web\SettingsController@general'] );
        Route::get( 'advanced', ['as' => 'advanced.render', 'uses' => 'Web\SettingsController@advanced'] );
        Route::get( 'routes', ['as' => 'routes.render', 'uses' => 'Web\SettingsController@routes'] );
        Route::get( 'roles', ['as' => 'roles.render', 'uses' => 'Web\SettingsController@roles'] );
        Route::get( 'permissions', ['as' => 'permissions.render', 'uses' => 'Web\SettingsController@permissions'] );
        Route::get( 'about', ['as' => 'about.render', 'uses' => 'Web\SettingsController@about'] );
    });
});

Route::get( 'test/{flag}', ['as' => 'test', 'uses' => 'Web\HomeController@test'] );