    $('#contact-submit').click(function () {
        $('.contact-error-field').hide();

        var nameVal = $('input[name=name]').val();
        var emailReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
        var emailVal = $('#ics_contact-email').val();
        var messageVal = $('textarea[name=message]').val();

        //validate

        if (nameVal == '' || nameVal == 'Name *') {
            $('.contact-error-field').html('<span><i class="fa-ics fa-times-ics"></i>Your name is required.</span>').fadeIn();
            return false;
        }
        if (emailVal == "" || emailVal == "Email Address *") {

            $('.contact-error-field').html('<span><i class="fa-ics fa-times-ics"></i>Your email address is required.</span>').fadeIn();
            return false;

        } else if (!emailReg.test(emailVal)) {

            $('.contact-error-field').html('<span><i class="fa-ics fa-times-ics"></i>Invalid email address.</span>').fadeIn();
            return false;
        }
        if (messageVal == '' || messageVal == 'Message *') {
            $('.contact-error-field').html('<span><i class="fa-ics fa-times-ics"></i>Please provide a message.</span>').fadeIn();
            return false;
        }

        var data_string = $('.contact-form').serialize();

        $('.contact-error-field').fadeOut();

        $.ajax({
         type : "post",
         url : document.URL+'/wp-admin/admin-ajax.php',
         data : {
                    action: "ics_send_email_fc",
                    name : jQuery('#ics_name').val(),
                    email : jQuery('#ics_contact-email').val(),
                    message : jQuery('#ics_message').val(),
                },

            //success
            success: function (data) {
                $('.contact-message').html('<span class="contact-success"><i class="fa-ics fa-check-ics"></i>'+window.send_msg_succes+'</span>').fadeIn();
                setTimeout(function(){
                    $('.contact-success').fadeOut(600);
                }, 4000);
            },
            error: function (data) {
                $('.contact-message').html('<span class="contact-error"><i class="fa-ics fa-times-ics"></i>Something went wrong, please try again later.</span>').fadeIn();
            }

        }) //end ajax call
        return false;
    });

// subscribe
$('#subscribe-submit').click(function () {
        $('.subscribe-error-field').hide();
        $('.subscribe-message').hide();

        var emailReg = /^([A-Za-z0-9_\.-]+)@([\dA-Za-z\.-]+)\.([a-z\.]{2,6})$/;
        var emailVal = $('#subscribe-email').val();

        if (emailVal == "" || emailVal == "Email Address *") {
            $('.subscribe-error-field').html('<span><i class="fa-ics fa-times-ics"></i>Email address required.</span>').fadeIn();
            return false;

        } else if (!emailReg.test(emailVal)) {
            $('.subscribe-error-field').html('<span><i class="fa-ics fa-times-ics"></i>Invalid email address.</span>').fadeIn();
            return false;
        }

        var data_string = $('.subscribe-form').serialize();


        $.ajax({
            type : "post",
            url : document.URL+'/wp-admin/admin-ajax.php',
            data : {
                    action: "ics_save_email_subscribe",
                    email : jQuery('#subscribe-email').val(),
                    subscribe_type : window.subscribe_type,
                    //mailchimp_api : window.mailchimp_api,
                    //mailchimp_id_list : window.mailchimp_id_list,
                },

            //success
            success: function (data) {
                if(data==1){
                    $('.subscribe-message').html('<span class="subscribe-success"><i class="fa-ics fa-check-ics"></i>'+window.subscribe_msg+'</span>').fadeIn();
                                    setTimeout(function(){
                                        $('.subscribe-success').fadeOut(600);
                                    }, 4000);
                    $('#subscribe-email').val('');  
                    $('#subscribe-email').removeAttr('placeholder');
                }else{
                    $('.subscribe-message').html('<span class="subscribe-error"><i class="fa-ics fa-times-ics"></i>Something went wrong.</span>').fadeIn();
                }

            },
            error: function (data) {
                $('.subscribe-message').html('<span class="subscribe-error"><i class="fa-ics fa-times-ics"></i>Something went wrong.</span>').fadeIn();
            }

        }) //end ajax call
        return false;
});