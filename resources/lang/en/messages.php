<?php

return [

    // General Strings
	'copyrights' => 'Copyright © 2017 Clivern',
	'setup_page_title' => 'Ponut - Setup',
	'database_error_form' => 'Oops! Something Goes Wrong.',


	// setup-step-2.blade.php
	'setup_form_2_title' => 'Setup Step 2',
	'setup_form_2_site_title' => 'Site Title',
	'setup_form_2_site_email' => 'Site Email',
	'setup_form_2_site_url' => 'Site URL',
	'setup_form_2_next_button' => 'Next',


	// API/SetupController.php
	'setup_error_site_title_required' => 'Error! Site title is required.',
	'setup_error_site_title_min' => 'Error! Site title is invalid.',
	'setup_error_site_title_max' => 'Error! Site title is invalid.',
	'setup_error_site_email_required' => 'Error! Site email is required.',
	'setup_error_site_email_email' => 'Error! Site email is invalid.',
	'setup_error_site_email_max' => 'Error! Site email is invalid.',
	'setup_error_site_url_required' => 'Error! Site URL is required.',
	'setup_error_site_url_url' => 'Error! Site URL is invalid.',
	'setup_error_site_url_max' => 'Error! Site URL is invalid.',
    'setup_step_2_success' => 'Setup step 2 succeeded.',


    // setup-step-3.blade.php
    'setup_form_3_title' => 'Setup Step 3',
    'setup_form_3_username' => 'Username',
    'setup_form_3_email' => 'Email',
    'setup_form_3_password' => 'Password',
    'setup_form_3_finish_button' => 'Finish',


    // API/SetupController.php
	'setup_error_username_required' => 'Error! Username is required.',
	'setup_error_username_username' => 'Error! Username is invalid.',
	'setup_error_username_unique' => 'Error! Username is invalid.',
	'setup_error_email_required' => 'Error! Email is required.',
	'setup_error_email_email' => 'Error! Email is invalid.',
	'setup_error_email_unique' => 'Error! Email is invalid.',
	'setup_error_password_required' => 'Error! Password is required.',
	'setup_error_password_password' => 'Error! Password is invalid.',
    'setup_step_3_success' => 'Setup step 3 succeeded.',


    // login.blade.php
    'login_form_title' => 'Login',
    'login_form_username_email' => 'Username or Email',
    'login_form_password' => 'Password',
    'login_form_remember_me' => 'Remember Me',
    'login_form_login_button' => 'Login',
    'login_form_forgot_password_button' => 'Forgot Password',


    // forgot-password.blade.php
    'forgot_password_form_title' => 'Forgot Password',
    'forgot_password_form_username_email' => 'Username or Email',
    'forgot_password_form_submit_button' => 'Submit',
    'forgot_password_form_login_button' => 'Login',


    // reset-password.blade.php
    'reset_password_form_title' => 'Reset Password',
    'reset_password_form_new_password' => 'New Password',
    'reset_password_form_submit_button' => 'Submit',
    'reset_password_form_login_button' => 'Login',


    // Web/FpwdController.php
    'forgot_password_page_title' => 'Forgot Password',
    'reset_password_page_title' => 'Reset Password',


    // API/LoginController.php
    'login_error_username_required' => 'Error! Please insert your username or email.',
    'login_error_password_required' => 'Error! Please insert your password',
    'login_success_message' => 'You logged in successfully.',
    'login_error_message' => 'Error! Invalid Username or Password.',


    // Jobs/SendForgotPasswordEmail.php
    'reset_password_email_subject' => 'Reset Password',


    // API/FpwdController.php
    'forgot_password_form_username_required' => 'Error! Please insert username or email.',
    'forgot_password_form_username_username_or_email_invalid' => 'Error! Please insert a valid username or email.',
    'forgot_password_reset_email_sent' => 'Reset email sent successfully.',
    'reset_password_form_new_password_required' => 'Error! Please insert a new password.',
    'reset_password_form_new_password_invalid' => 'Error! Password inserted is invalid.',
    'reset_password_form_token_expired_message' => 'Error! Reset tocken expired or invalid.',
    'reset_password_pasword_changed' => 'Your profile password changed successfully.',
    'after_install_thank_you_message' => 'Thank You for Using Ponut',


    // API/ProfileController.php
    'profile_update_error_username_required' => 'Error! Please insert username.',
    'profile_update_error_username_username' => 'Error! Username is invalid.',
    'profile_update_error_username_max' => 'Error! Username is invalid.',
    'profile_update_error_first_name_required' => 'Error! Please insert first name.',
    'profile_update_error_first_name_max' => 'Error! First name is invalid.',
    'profile_update_error_last_name_required' => 'Error! Please insert last name.',
    'profile_update_error_last_name_max' => 'Error! Last name is invalid.',
    'profile_update_error_email_required' => 'Error! Please insert email.',
    'profile_update_error_email_email' => 'Error! Email in invalid.',
    'profile_update_error_email_max' => 'Error! Email in invalid.',
    'profile_update_error_language_required' => 'Error! Please select a language.',
    'profile_update_error_language_max' => 'Error! Language is invalid.',
    'profile_update_error_job_title_required' => 'Error! Please insert job title.',
    'profile_update_error_job_title_max' => 'Error! Job title is invalid.',
    'profile_update_error_username_notvalid' => 'Error! Username is used before.',
    'profile_update_error_email_notvalid' => 'Error! Email is used before.',
    'profile_update_success_message' => 'Your profile updated successfully.',
    'profile_update_error_message' => 'Oops! Something Goes Wrong.',
    'profile_update_error_old_password_required' => 'Error! Please insert old password.',
    'profile_update_error_new_password_required' => 'Error! Please insert the new password.',
    'profile_update_error_new_password_password' => 'Error! New Password is invalid.',
    'profile_update_error_old_password_notvalid' => 'Error! Old password is invalid.',
    'profile_password_update_success_message' => 'Your password updated successfully. You will need to login again.',
    'profile_password_update_error_message' => 'Oops! Something Goes Wrong.',


    // API/PluginsController.php
    'activate_plugin_error_plugin_required' => 'Error! Invalid Request.',
    'activate_plugin_success_message' => 'Plugin activated successfully.',
    'activate_plugin_error_message' => 'Oops! Something Goes Wrong.',
    'deactivate_plugin_error_plugin_required' => 'Error! Invalid Request.',
    'deactivate_plugin_success_message' => 'Plugin deactivated successfully.',
    'deactivate_plugin_error_message' => 'Oops! Something Goes Wrong.',
    'delete_plugin_error_plugin_required' => 'Error! Invalid Request.',
    'delete_plugin_success_message' => 'Plugin deleted successfully.',
    'delete_plugin_error_message' => 'Oops! Something Goes Wrong.',


    // API/AppearanceController.php
    'activate_theme_error_theme_required' => 'Error! Invalid Request.',
    'activate_theme_success_message' => 'Theme activated successfully.',
    'activate_theme_error_message' => 'Oops! Something Goes Wrong.',
    'delete_theme_error_theme_required' => 'Error! Invalid Request.',
    'delete_theme_success_message' => 'Theme deleted successfully.',
    'delete_theme_error_message' => 'Oops! Something Goes Wrong.',
    'customize_theme_error_font_required' => 'Error! Font is required.',
    'customize_theme_error_skin_required' => 'Error! Skin is required.',
    'customize_theme_success_message' => 'Customize settings updated successfully.',
    'customize_theme_error_message' => 'Oops! Something Goes Wrong.',


    // API/DepartmentsController.php
    'add_department_error_name_required' => 'Error! Department name is required.',
    'add_department_error_slug_required' => 'Error! Department slug is required.',
    'add_department_error_slug_exist' => 'Error! Department slug is used before.',
    'add_department_success_message' => 'Department insert successfully.',
    'add_department_error_message' => 'Oops! Something Goes Wrong.',
    'edit_department_error_id_required' => 'Error! Invalid Request.',
    'edit_department_error_name_required' => 'Error! Department name is required.',
    'edit_department_error_slug_required' => 'Error! Department slug is required.',
    'edit_department_error_slug_exist' => 'Error! Department slug is used before.',
    'edit_department_success_message' => 'Department updated successfully.',
    'edit_department_error_message' => 'Oops! Something Goes Wrong.',
    'delete_department_error_invalid_id' => 'Error! Invalid Request.',
    'delete_department_success_message' => 'Department deleted successfully.',
    'delete_department_error_message' => 'Oops! Something Goes Wrong.',
    'build_department_slug_error_name_required' => 'Error! Department name is required to build a slug.',
    'build_department_slug_success_message' => 'Department slug created successfully.',


    // API/UsersController.php
    'add_user_error_username_required' => 'Error! Username is required.',
    'add_user_error_username_username' => 'Error! Username is invalid.',
    'add_user_error_username_unique' => 'Error! Username used before.',
    'add_user_error_first_name_required' => 'Error! First name is required.',
    'add_user_error_last_name_required' => 'Error! Last name is required.',
    'add_user_error_email_required' => 'Error! Email is required.',
    'add_user_error_email_email' => 'Error! Email is invalid.',
    'add_user_error_email_unique' => 'Error! Email used before.',
    'add_user_error_language_required' => 'Error! Language is required.',
    'add_user_error_job_title_required' => 'Error! Job title is required.',
    'add_user_error_password_required' => 'Error! Password is required.',
    'add_user_error_password_password' => 'Error! Password is invalid.',
    'add_user_error_status_required' => 'Error! Status is required.',
    'add_user_success_message' => 'User inserted successfully.',
    'add_user_error_message' => 'Oops! Something Goes Wrong.',
    'edit_user_error_id_required' => 'Error! Invalid Request.',
    'edit_user_error_id_integer' => 'Error! Invalid Request.',
    'edit_user_error_username_required' => 'Error! Username is required.',
    'edit_user_error_username_username' => 'Error! Username is invalid.',
    'edit_user_error_first_name_required' => 'Error! First name is required.',
    'edit_user_error_last_name_required' => 'Error! Last name is required.',
    'edit_user_error_email_required' => 'Error! Email is required.',
    'edit_user_error_email_email' => 'Error! Email is invalid.',
    'edit_user_error_language_required' => 'Error! Language is required.',
    'edit_user_error_job_title_required' => 'Error! Job title is required.',
    'edit_user_error_status_required' => 'Error! Status is required.',
    'edit_user_error_password_required' => 'Error! Password is required.',
    'edit_user_error_password_password' => 'Error! Password is invalid.',
    'edit_user_error_username_unique' => 'Error! Username used before.',
    'edit_user_error_email_unique' => 'Error! Email used before.',
    'edit_user_success_message' => 'User updated successfully.',
    'edit_user_error_message' => 'Oops! Something Goes Wrong.',
    'delete_user_error_id_required' => 'Error! Invalid Request.',
    'delete_user_error_id_integer' => 'Error! Invalid Request.',
    'delete_user_success_message' => 'User deleted successfully.',
    'delete_user_error_message' => 'Oops! Something Goes Wrong.',


    // API/SettingsController.php
    'update_general_settings_error_site_title_required' => 'Error! Site title is required.',
    'update_general_settings_error_site_email_required' => 'Error! Site email is required.',
    'update_general_settings_error_site_emails_sender_required' => 'Error! Site emails sender is required.',
    'update_general_settings_error_site_url_required' => 'Error! Site url is required.',
    'update_general_settings_error_site_lang_required' => 'Error! Site language is required.',
    'update_general_settings_error_site_timezone_required' => 'Error! Site timezone is required.',
    'update_general_settings_error_site_maintainance_mode_required' => 'Error! Site maintainance mode is required.',
    'update_general_settings_success_message' => 'Site general settings updated successfully.',
    'update_general_settings_error_message' => 'Oops! Something Goes Wrong.',
    'update_route_permission_error_id_required' => 'Error! Invalid Request.',
    'update_route_permission_error_id_integer' => 'Error! Invalid Request.',
    'update_route_permission_error_permission_id_required' => 'Error! Invalid Request.',
    'update_route_permission_error_enabled_required' => 'Error! Invalid Request.',
    'update_route_permission_success_message' => 'Route permission updated successfully.',
    'update_route_permission_error_message' => 'Oops! Something Goes Wrong.',
    'add_role_error_name_required' => 'Error! Role name is required.',
    'add_role_error_display_name_required' => 'Error! Role display name is required.',
    'add_role_error_name_unique' => 'Error! Role name used before.',
    'add_role_success_message' => 'Role inserted successfully.',
    'add_role_error_message' => 'Oops! Something Goes Wrong.',
    'edit_role_error_id_required' => 'Error! Invalid Request.',
    'edit_role_error_name_required' => 'Error! Role name is required.',
    'edit_role_error_display_name_required' => 'Error! Role display name is required.',
    'edit_role_error_name_unique' => 'Error! Role name used before.',
    'edit_role_success_message' => 'Role updated successfully.',
    'edit_role_error_message' => 'Oops! Something Goes Wrong.',
    'delete_role_error_id_required' => 'Error! Invalid Request.',
    'delete_role_error_id_integer' => 'Error! Invalid Request.',
    'delete_role_success_message' => 'Role deleted successfully.',
    'delete_role_error_message' => 'Oops! Something Goes Wrong.',
    'add_permission_error_name_required' => 'Error! Permission name is required.',
    'add_permission_error_display_name_required' => 'Error! Permission display name is required.',
    'add_permission_error_name_unique' => 'Error! Permission name used before.',
    'add_permission_success_message' => 'Permission inserted successfully.',
    'add_permission_error_message' => 'Oops! Something Goes Wrong.',
    'edit_permission_error_id_required' => 'Error! Invalid Request.',
    'edit_permission_error_name_required' => 'Error! Permission name is required.',
    'edit_permission_error_display_name_required' => 'Error! Permission display name is required.',
    'edit_permission_error_name_unique' => 'Error! Permission name used before.',
    'edit_permission_success_message' => 'Permission updated successfully.',
    'edit_permission_error_message' => 'Oops! Something Goes Wrong.',
    'delete_permission_error_id_required' => 'Error! Invalid Request.',
    'delete_permission_error_id_integer' => 'Error! Invalid Request.',
    'delete_permission_success_message' => 'Permission deleted successfully.',
    'delete_permission_error_message' => 'Oops! Something Goes Wrong.',
    'update_routes_success_message' => 'Routes updated successfully.',
    'update_routes_error_message' => 'Oops! Something Goes Wrong.',
    'delete_route_error_id_required' => 'Error! Invalid Request.',
    'delete_route_error_id_integer' => 'Error! Invalid Request.',
    'delete_route_success_message' => 'Route deleted successfully.',
    'delete_route_error_message' => 'Oops! Something Goes Wrong.',

    // API/JobsController.php
    'delete_job_error_id_required' => 'Error! Invalid Request.',
    'delete_job_error_id_integer' => 'Error! Invalid Request.',
    'delete_job_success_message' => 'Job deleted successfully.',
    'delete_job_error_message' => 'Oops! Something Goes Wrong.',


    // API/CandidatesController.php
    'delete_candidate_error_id_required' => 'Error! Invalid Request.',
    'delete_candidate_error_id_integer' => 'Error! Invalid Request.',
    'delete_candidate_success_message' => 'Candidate deleted successfully.',
    'delete_candidate_error_message' => 'Oops! Something Goes Wrong.',


    // 404.blade.php
    "error_404_head" => "Page Not Found",
    "error_404_main" => "Sorry, but the page you are looking for has note been found. Try checking the URL for error, then hit the refresh button on your browser or try found something else in our app.",
    "error_404_button" => "Go back to dashboard",

    // 503.blade.php
    "error_503_head" => "Internal Server Error",
    "error_503_main" => "The server encountered something unexpected that didn't allow it to complete the request. We apologize.",
    "error_503_button" => "Go back to dashboard",
];