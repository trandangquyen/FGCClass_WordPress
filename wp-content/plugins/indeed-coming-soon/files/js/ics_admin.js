jQuery(document).ready(function(){
    jQuery('.time').timepicker({
            'showDuration': true,
            'timeFormat': 'H:i',
            'step': 10
    });
    jQuery('.ics-datepicker-field').datepicker({
             dateFormat : "dd-mm-yy", //
            'autoclose': true
    });
});
function check_and_h(from, where) {
	if (jQuery(from).is(":checked")) {
        jQuery(where).val(1);
	} else {
		jQuery(where).val(0);
	}
}

function check_and_h_num(from, where) {
	if (jQuery(from).is(":checked")) {
        jQuery(where).val(1);
	} else {
		jQuery(where).val(0);
	}
}

jQuery(function() {
    jQuery( "#sortable" ).sortable({
        revert: true
    });
    jQuery( "#sortable2" ).sortable({
        revert: true
    });
    //jQuery( "ul, li" ).disableSelection();
});

jQuery(document).on('click', '#add_row', function() {
  	  var parent = jQuery(this).parent();
	  var ul = parent.find('ul');
	  ul.append('<li class="ui-state-default slider_li_t"><img onclick="jQuery(this).parent().remove();" class="close_slide_icon" src="'+window.ics_url+'files/images/close_2.png" ><input type="text" class="indeed_large_input_text" value="" name="ics_img_arr[]" onclick="open_media_up(this);" /></li>');
});
jQuery(document).on('click', '#add_row_2', function() {
  	  var parent = jQuery(this).parent();
	  var ul = parent.find('ul');
	  ul.append('<li class="ui-state-default slider_li_t"><img onclick="jQuery(this).parent().remove();" class="close_slide_icon" src="'+window.ics_url+'files/images/close_2.png" ><input type="text" class="indeed_large_input_text" value="" name="ics_img_arr_effect[]" onclick="open_media_up(this);" /></li>');
});

function ics_generalColor(id, value, where ){
    jQuery('#colors_ul li').each(function(){
        jQuery(this).attr('class', 'color_scheme_item');
    });
    jQuery(id).attr('class', 'color_scheme_item-selected');
    jQuery(where).val(value);
}

function updateViewEmailS( selectTarget ){
    //reset
    id_arr = ['#mailchimp_settings',
              '#get_response_settings',
              '#campaign_monitor_settings',
              '#icontact_settings',
              '#constant_contact_settings',
              '#wysija_settings',
              '#mymail_settings',
              '#madmimi_settings',
              '#aweber_settings'];
    for(i=0;i<id_arr.length;i++){
        jQuery(id_arr[i]).css('display', 'none');
    }

    switch(jQuery(selectTarget).val()){
        case 'aweber':
            jQuery('#aweber_settings').css('display', 'table-row');
        break;
        case 'mailchimp':
            jQuery('#mailchimp_settings').css('display', 'table-row');
        break;
        case 'get_response':
            jQuery('#get_response_settings').css('display', 'table-row');
        break;
        case 'campaign_monitor':
            jQuery('#campaign_monitor_settings').css('display', 'table-row');
        break;
        case 'icontact':
            jQuery('#icontact_settings').css('display', 'table-row');
        break;
        case 'constant_contact':
            jQuery('#constant_contact_settings').css('display', 'table-row');
        break;
        case 'wysija':
            jQuery('#wysija_settings').css('display', 'table-row');
        break;
        case 'mymail':
            jQuery('#mymail_settings').css('display', 'table-row');
        break;
        case 'madmimi':
            jQuery('#madmimi_settings').css('display', 'table-row');
        break;
        case 'email_list':
        break;
    }
}

function connect_aweber( textarea ){
    jQuery.ajax({
            type : "post",
            url : ics_base_url+'/wp-admin/admin-ajax.php',
            data : {
                    action: "ics_update_aweber",
                    auth_code: jQuery( textarea ).val()
                },
            success: function (data) {
            	alert('Connected');
            }
    });
}

function get_cc_list( ics_cc_user,ics_cc_pass ){
    jQuery("#ics_cc_list").find('option').remove();
	jQuery.ajax({
            type : "post",
			dataType: 'JSON',
            url : ics_base_url+'/wp-admin/admin-ajax.php',
            data : {
                    action: "ics_get_cc_list",
                    ics_cc_user: jQuery( ics_cc_user ).val(),
                    ics_cc_pass: jQuery( ics_cc_pass ).val()
                },
            success: function (data) {
				jQuery.each(data, function(i, option)
				{
					jQuery("<option/>").val(i).text(option.name).appendTo("#ics_cc_list");
				});
                
            }
	});
}

function isc_select_bk_type_radio(id){
	arr = ['#solid_color', '#single_image', '#parallax', '#slides', '#slides_with_effect', '#video'];
	for(i=0;i<arr.length;i++){
		if(id==arr[i]) jQuery(id).addClass('ics-selected');
		else jQuery(arr[i]).removeClass('ics-selected');
	}
}

function ics_change_layout(num){
	if(num==1){
		jQuery('#ics-layout-1').addClass('ics-selected-img');
		jQuery('#ics-layout-2').removeClass('ics-selected-img');
		jQuery('#ics_layout').val(1);
	}else{
		jQuery('#ics-layout-1').removeClass('ics-selected-img');
		jQuery('#ics-layout-2').addClass('ics-selected-img');		
		jQuery('#ics_layout').val(2);		
	}
}

function ics_make_inputh_string(divCheck, showValue, hidden_input_id){
    str = jQuery(hidden_input_id).val();
    if(str==-1) str = '';
    if(str!='') show_arr = str.split(',');
    else show_arr = new Array();
    if(jQuery(divCheck).is(':checked')){
        show_arr.push(showValue);
    }else{
        var index = show_arr.indexOf(showValue);
        show_arr.splice(index, 1);
    }
    str = show_arr.join(',');
    if(str=='') str = -1;
    jQuery(hidden_input_id).val(str);
}

function ics_remove_visible_link(l, t, n){
    jQuery.ajax({
        type : "post",
        url : ics_base_url+'/wp-admin/admin-ajax.php',
        data : {
                action: "ics_delete_visible_link",
                value: l,
                type: t
            },
        success: function (r) {
        	jQuery('#ics_visible_' + t + '_'+n).fadeOut(300);
        }
    });
}