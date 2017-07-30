/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

var ponut_app = ponut_app || {};

ponut_app.layout = (function (window, document, $) {

    var setup = {

        el: {
            iCheck : $('.i-checks'),
        },

        init: function(){
            if( setup.el.iCheck.length ){
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green'
                });
            }
        }
    };

   return {
        init: setup.init
    };

})(window, document, jQuery);


ponut_app.setup = (function (window, document, $) {

    var setup = {

        el: {
            second_setup_step: $('form#second_setup_step'),
            third_setup_step: $('form#third_setup_step'),
            second_setup_step_submit: $('form#second_setup_step button[type="submit"]'),
            third_setup_step_submit: $('form#third_setup_step button[type="submit"]')
        },

        init: function(){
            ponut_skelton.forms.simple_form_submit({
                form_element: setup.el.second_setup_step,
                form_submit_element: setup.el.second_setup_step_submit,
                success_form_clear: false,
                error_form_clear: false,
                success_reload: true,
                error_reload: false,
            }, 'post');
            ponut_skelton.forms.simple_form_submit({
                form_element: setup.el.third_setup_step,
                form_submit_element: setup.el.third_setup_step_submit,
                success_form_clear: false,
                error_form_clear: false,
                success_reload: true,
                error_reload: false,
            }, 'post');
        },
    };

   return {
        init: setup.init
    };

})(window, document, jQuery);

ponut_app.login = (function (window, document, $) {

    var login = {

        el: {
            login_form: $('form#login_form'),
            login_form_submit: $('form#login_form button[type="submit"]'),
        },

        init: function(){
            ponut_skelton.forms.simple_form_submit({
                form_element: login.el.login_form,
                form_submit_element: login.el.login_form_submit,
                success_form_clear: false,
                error_form_clear: false,
                success_reload: true,
                error_reload: false,
            }, 'post');
        },
    };

   return {
        init: login.init
    };

})(window, document, jQuery);


ponut_app.fpwd = (function (window, document, $) {

    var fpwd = {

        el: {
            forgot_password_form: $('form#forgot_password_form'),
            forgot_password_form_submit: $('form#forgot_password_form button[type="submit"]'),
            reset_password_form: $('form#reset_password_form'),
            reset_password_form_submit: $('form#reset_password_form button[type="submit"]'),
        },

        init: function(){
            ponut_skelton.forms.simple_form_submit({
                form_element: fpwd.el.forgot_password_form,
                form_submit_element: fpwd.el.forgot_password_form_submit,
                success_form_clear: true,
                error_form_clear: false,
                success_reload: false,
                error_reload: false,
            }, 'post');
            ponut_skelton.forms.simple_form_submit({
                form_element: fpwd.el.reset_password_form,
                form_submit_element: fpwd.el.reset_password_form_submit,
                success_form_clear: true,
                error_form_clear: false,
                success_reload: false,
                error_reload: false,
            }, 'post');

        },
    };

   return {
        init: fpwd.init
    };

})(window, document, jQuery);


ponut_app.push_notification = (function (window, document, $) {

    var push_notification = {

        el: {

        },

        init: function(){
            app_globals.running_intervals['notify'] = setInterval(function(){
                ponut_skelton.api.post_request({
                    action: app_globals.notify_url,
                    form_data: {},
                    success_callack: function (response) {
                        if( response.data != '' ){
                            ponut_skelton.notifications.popup_notify({
                                type: response.data.status,
                                title: '',
                                message: response.data.message
                            });
                        }else{
                            clearInterval(app_globals.running_intervals['notify']);
                        }
                        console.log(response);
                    },
                    error_callback: function (error) {
                        console.log(error);
                        clearInterval(app_globals.running_intervals['notify']);
                    }
                });
            }, 10000);
        }
    };

   return {
        init: push_notification.init
    };

})(window, document, jQuery);


ponut_app.test_script = (function (window, document, $) {

    var test_script = {

        el: {

        },

        init: function(){
            if( $('form#request_data_id').length ){

                $('form#request_data_id select[name="action"]').on('change', function(event){
                    event.preventDefault();
                    var _self = $(this);
                    $('form#request_data_id textarea').val(_self.val());
                });

                $('form#request_data_id').on('submit', function(event){
                    event.preventDefault();
                    var _self = $(this);
                    _self = _self.find('textarea');
                    var action_data = _self.val().split("\n");
                    var actionlength = action_data.length;
                    var action_data_obj = {};
                    for ( var i = 0; i < actionlength; i++ ) {
                        action_data[i] = action_data[i].split(':');
                        action_data_obj[action_data[i][0]] = action_data[i][1];
                    }
                    var start_time = new Date().getTime();

                    var _method = $('form#request_data_id select[name="method"]').val();

                    if( _method == 'post' ){

                        axios.post(action_data_obj['action'], action_data_obj)
                          .then(function (response) {
                            $('pre#request').html(JSON.stringify(action_data_obj, null, 4));
                            $('pre#response').html(JSON.stringify(response, null, 4));
                            var request_time = new Date().getTime() - start_time;
                            $('pre#time').html("Time:" + request_time + " milliseconds" + "\n" + "Time:" + request_time/1000 + " seconds");
                          })
                          .catch(function (error) {
                            $('pre#request').html(JSON.stringify(action_data_obj, null, 4));
                            $('pre#response').html(JSON.stringify(error, null, 4));
                            var request_time = new Date().getTime() - start_time;
                            $('pre#time').html("Time:" + request_time + " milliseconds" + "\n" + "Time:" + request_time/1000 + " seconds");
                        });

                    }else if( _method == 'get' ){

                        axios.get(action_data_obj['action'], action_data_obj)
                          .then(function (response) {
                            $('pre#request').html(JSON.stringify(action_data_obj, null, 4));
                            $('pre#response').html(JSON.stringify(response, null, 4));
                            var request_time = new Date().getTime() - start_time;
                            $('pre#time').html("Time:" + request_time + " milliseconds" + "\n" + "Time:" + request_time/1000 + " seconds");
                          })
                          .catch(function (error) {
                            $('pre#request').html(JSON.stringify(action_data_obj, null, 4));
                            $('pre#response').html(JSON.stringify(error, null, 4));
                            var request_time = new Date().getTime() - start_time;
                            $('pre#time').html("Time:" + request_time + " milliseconds" + "\n" + "Time:" + request_time/1000 + " seconds");
                        });

                    }else if( _method == 'head' ){

                        axios.head(action_data_obj['action'], action_data_obj)
                          .then(function (response) {
                            $('pre#request').html(JSON.stringify(action_data_obj, null, 4));
                            $('pre#response').html(JSON.stringify(response, null, 4));
                            var request_time = new Date().getTime() - start_time;
                            $('pre#time').html("Time:" + request_time + " milliseconds" + "\n" + "Time:" + request_time/1000 + " seconds");
                          })
                          .catch(function (error) {
                            $('pre#request').html(JSON.stringify(action_data_obj, null, 4));
                            $('pre#response').html(JSON.stringify(error, null, 4));
                            var request_time = new Date().getTime() - start_time;
                            $('pre#time').html("Time:" + request_time + " milliseconds" + "\n" + "Time:" + request_time/1000 + " seconds");
                        });

                    }else if( _method == 'delete' ){

                        axios.delete(action_data_obj['action'], action_data_obj)
                          .then(function (response) {
                            $('pre#request').html(JSON.stringify(action_data_obj, null, 4));
                            $('pre#response').html(JSON.stringify(response, null, 4));
                            var request_time = new Date().getTime() - start_time;
                            $('pre#time').html("Time:" + request_time + " milliseconds" + "\n" + "Time:" + request_time/1000 + " seconds");
                          })
                          .catch(function (error) {
                            $('pre#request').html(JSON.stringify(action_data_obj, null, 4));
                            $('pre#response').html(JSON.stringify(error, null, 4));
                            var request_time = new Date().getTime() - start_time;
                            $('pre#time').html("Time:" + request_time + " milliseconds" + "\n" + "Time:" + request_time/1000 + " seconds");
                        });

                    }else if( _method == 'options' ){

                        axios.options(action_data_obj['action'], action_data_obj)
                          .then(function (response) {
                            $('pre#request').html(JSON.stringify(action_data_obj, null, 4));
                            $('pre#response').html(JSON.stringify(response, null, 4));
                            var request_time = new Date().getTime() - start_time;
                            $('pre#time').html("Time:" + request_time + " milliseconds" + "\n" + "Time:" + request_time/1000 + " seconds");
                          })
                          .catch(function (error) {
                            $('pre#request').html(JSON.stringify(action_data_obj, null, 4));
                            $('pre#response').html(JSON.stringify(error, null, 4));
                            var request_time = new Date().getTime() - start_time;
                            $('pre#time').html("Time:" + request_time + " milliseconds" + "\n" + "Time:" + request_time/1000 + " seconds");
                        });

                    }else if( _method == 'put' ){

                        axios.put(action_data_obj['action'], action_data_obj)
                          .then(function (response) {
                            $('pre#request').html(JSON.stringify(action_data_obj, null, 4));
                            $('pre#response').html(JSON.stringify(response, null, 4));
                            var request_time = new Date().getTime() - start_time;
                            $('pre#time').html("Time:" + request_time + " milliseconds" + "\n" + "Time:" + request_time/1000 + " seconds");
                          })
                          .catch(function (error) {
                            $('pre#request').html(JSON.stringify(action_data_obj, null, 4));
                            $('pre#response').html(JSON.stringify(error, null, 4));
                            var request_time = new Date().getTime() - start_time;
                            $('pre#time').html("Time:" + request_time + " milliseconds" + "\n" + "Time:" + request_time/1000 + " seconds");
                        });

                    }
                });
            }
        }
    };

   return {
        init: test_script.init
    };

})(window, document, jQuery);


jQuery(document).ready(function($){
    ponut_app.setup.init();
    ponut_app.login.init();
    ponut_app.fpwd.init();
    ponut_app.push_notification.init();
    ponut_app.test_script.init();
    ponut_app.layout.init();
});