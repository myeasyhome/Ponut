/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

var ponut_skelton = ponut_skelton || {};


/**
 * App Utils
 */
ponut_skelton.utils = (function (window, document, $) {

    var utils = {

        el: {

        },
        init: function(){

        },
        merge_options: function(object1,object2){
            var object3 = {};
            for (var attrname in object1) { object3[attrname] = object1[attrname]; }
            for (var attrname in object2) { object3[attrname] = object2[attrname]; }
            return object3;
        }
    };

   return {
        merge_options: utils.merge_options,
    };

})(window, document, jQuery);


/**
 * Perform API Requests
 */
ponut_skelton.api = (function (window, document, $) {

    var api = {

        el: {

        },
        init: function(){
            api.config();
        },
        config: function(){
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        },
        post_form: function(args){
            axios.post(args.action, args.form_data).then(args.success_callack).catch(args.error_callback);
        },
        post_request: function(args){
            axios.post(args.action, args.form_data).then(args.success_callack).catch(args.error_callback);
        },
        put_form: function(args){
            axios.put(args.action, args.form_data).then(args.success_callack).catch(args.error_callback);
        },
        put_request: function(args){
            axios.put(args.action, args.form_data).then(args.success_callack).catch(args.error_callback);
        },
        delete_form: function(args){
            axios.delete(args.action, args.form_data).then(args.success_callack).catch(args.error_callback);
        },
        delete_request: function(args){
            axios.delete(args.action, args.form_data).then(args.success_callack).catch(args.error_callback);
        }
    };

    api.init();

    return {
        post_form: api.post_form,
        post_request: api.post_request,
        put_form: api.put_form,
        put_request: api.put_request,
        delete_form: api.delete_form,
        delete_request: api.delete_request
    };

})(window, document, jQuery);


/**
 * Process App Forms
 */
ponut_skelton.forms = (function (window, document, $) {

    var forms = {

        el: {

        },
        init: function(){

        },

        simple_form_submit: function(args, method = 'post'){

            args = ponut_skelton.utils.merge_options({
                form_element: false,
                form_submit_element: false,
                success_form_clear: false,
                error_form_clear: false,
                success_reload: false,
                error_reload: false,
            }, args);

            if( !args.form_element.length || !args.form_submit_element.length ){
                return false;
            }

            args.form_submit_element.removeAttr('disabled');
            args.form_submit_element.ladda();

            args.form_element.on('submit', function(event){
                event.preventDefault();
                args.form_submit_element.attr('disabled', 'disabled');
                args.form_submit_element.ladda( 'start' );

                if( method == 'post' ){

                    ponut_skelton.api.post_form({
                        action: args.form_element.attr('action'),
                        form_data: forms.form_data({form_element: args.form_element}),
                        success_callack: function (response) {

                            for(var messageObj of response.data.messages.messages) {
                                ponut_skelton.notifications.popup_notify({
                                    type: messageObj.type,
                                    title: '',
                                    message: messageObj.message
                                });
                                break;
                            }
                            if( args.success_form_clear && response.data.success == true ){
                                args.form_submit_element.removeAttr('disabled');
                                args.form_submit_element.ladda('stop');
                                args.form_element.trigger('reset');
                            }else if( args.error_form_clear && response.data.success == false ){
                                args.form_submit_element.removeAttr('disabled');
                                args.form_submit_element.ladda('stop');
                                args.form_element.trigger('reset');
                            }else if( args.success_reload && response.data.success == true ){
                                for (var key in app_globals.running_intervals) {
                                    clearInterval(app_globals.running_intervals[key]);
                                }
                                setTimeout(function() {
                                    args.form_submit_element.removeAttr('disabled');
                                    args.form_submit_element.ladda('stop');
                                    location.reload();
                                }, 2000);
                            }else if( args.error_reload && response.data.success == false ){
                                for (var key in app_globals.running_intervals) {
                                    clearInterval(app_globals.running_intervals[key]);
                                }
                                setTimeout(function() {
                                    args.form_submit_element.removeAttr('disabled');
                                    args.form_submit_element.ladda('stop');
                                    location.reload();
                                }, 2000);
                            }else{
                                args.form_submit_element.removeAttr('disabled');
                                args.form_submit_element.ladda('stop');
                            }
                            console.log(response);
                        },
                        error_callback: function (error) {
                            console.log(error);
                        }
                    });

                }else if(method == 'put'){

                    ponut_skelton.api.put_form({
                        action: args.form_element.attr('action'),
                        form_data: forms.form_data({form_element: args.form_element}),
                        success_callack: function (response) {
                            for(var messageObj of response.data.messages.messages) {
                                ponut_skelton.notifications.popup_notify({
                                    type: messageObj.type,
                                    title: '',
                                    message: messageObj.message
                                });
                                break;
                            }
                            if( args.success_form_clear && response.data.success == true ){
                                args.form_submit_element.removeAttr('disabled');
                                args.form_submit_element.ladda('stop');
                                args.form_element.trigger('reset');
                            }else if( args.error_form_clear && response.data.success == false ){
                                args.form_submit_element.removeAttr('disabled');
                                args.form_submit_element.ladda('stop');
                                args.form_element.trigger('reset');
                            }else if( args.success_reload && response.data.success == true ){
                                for (var key in app_globals.running_intervals) {
                                    clearInterval(app_globals.running_intervals[key]);
                                }
                                setTimeout(function() {
                                    args.form_submit_element.removeAttr('disabled');
                                    args.form_submit_element.ladda('stop');
                                    location.reload();
                                }, 2000);
                            }else if( args.error_reload && response.data.success == false ){
                                for (var key in app_globals.running_intervals) {
                                    clearInterval(app_globals.running_intervals[key]);
                                }
                                setTimeout(function() {
                                    args.form_submit_element.removeAttr('disabled');
                                    args.form_submit_element.ladda('stop');
                                    location.reload();
                                }, 2000);
                            }else{
                                args.form_submit_element.removeAttr('disabled');
                                args.form_submit_element.ladda('stop');
                            }
                            console.log(response);
                        },
                        error_callback: function (error) {
                            console.log(error);
                        }
                    });

                }else if(method == 'delete'){

                    ponut_skelton.api.delete_form({
                        action: args.form_element.attr('action'),
                        form_data: forms.form_data({form_element: args.form_element}),
                        success_callack: function (response) {
                            for(var messageObj of response.data.messages.messages) {
                                ponut_skelton.notifications.popup_notify({
                                    type: messageObj.type,
                                    title: '',
                                    message: messageObj.message
                                });
                                break;
                            }
                            if( args.success_form_clear && response.data.success == true ){
                                args.form_submit_element.removeAttr('disabled');
                                args.form_submit_element.ladda('stop');
                                args.form_element.trigger('reset');
                            }else if( args.error_form_clear && response.data.success == false ){
                                args.form_submit_element.removeAttr('disabled');
                                args.form_submit_element.ladda('stop');
                                args.form_element.trigger('reset');
                            }else if( args.success_reload && response.data.success == true ){
                                for (var key in app_globals.running_intervals) {
                                    clearInterval(app_globals.running_intervals[key]);
                                }
                                setTimeout(function() {
                                    args.form_submit_element.removeAttr('disabled');
                                    args.form_submit_element.ladda('stop');
                                    location.reload();
                                }, 2000);
                            }else if( args.error_reload && response.data.success == false ){
                                for (var key in app_globals.running_intervals) {
                                    clearInterval(app_globals.running_intervals[key]);
                                }
                                setTimeout(function() {
                                    args.form_submit_element.removeAttr('disabled');
                                    args.form_submit_element.ladda('stop');
                                    location.reload();
                                }, 2000);
                            }else{
                                args.form_submit_element.removeAttr('disabled');
                                args.form_submit_element.ladda('stop');
                            }
                            console.log(response);
                        },
                        error_callback: function (error) {
                            console.log(error);
                        }
                    });

                }

            });
        },

        form_data : function(args){
            args = ponut_skelton.utils.merge_options({
                form_element: false
            }, args);

            var inputs = {};
            args.form_element.serializeArray().map(function(item, index) {
                inputs[item.name] = item.value;
            });
            return inputs;
        }
    };

    forms.init();

    return {
        simple_form_submit: forms.simple_form_submit,
    };

})(window, document, jQuery);


/**
 * Build App Charts
 */
ponut_skelton.charts = (function (window, document, $) {

    var charts = {

        el: {

        },
        init: function(){

        }
    };

    charts.init();

    return {

    };

})(window, document, jQuery);


/**
 * Build App Widgets
 */
ponut_skelton.widgets = (function (window, document, $) {

    var widgets = {

        el: {

        },
        init: function(){

        }
    };

    widgets.init();

    return {

    };

})(window, document, jQuery);


/**
 * Push Popup Notifications
 */
ponut_skelton.notifications = (function (window, document, $) {

    var notifications = {

        el: {

        },
        init: function(){
            notifications.config();
        },
        config: function(){
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-center",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "10000",
              "hideDuration": "1000",
              "timeOut": "10000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
        },
        popup_notify: function(args){
            if( args.type == 'warning' ){
                toastr.clear();
                toastr.warning(args.message, args.title);
            }else if( args.type == 'success' ){
                toastr.clear();
                toastr.success(args.message, args.title);
            }else if( args.type == 'error' ){
                toastr.clear();
                toastr.error(args.message, args.title);
            }
        }
    };

    notifications.init();

   return {
        popup_notify: notifications.popup_notify,
    };

})(window, document, jQuery);