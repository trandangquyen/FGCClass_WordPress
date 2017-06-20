<?php
/*
Plugin Name: Indeed Coming Soon
Plugin URI: http://www.wpindeed.com/
Description: The Ultimate Coming Soon Plugin Fully Responsive with multiple Background and CountDown Options.
Version: 3.5
Author: indeed
Author URI: http://www.wpindeed.com
*/
define('ICS_PROTOCOL', ics_site_protocol());
define('ICS_DIR_PATH', plugin_dir_path(__FILE__));
define('ICS_DIR_URL',  plugin_dir_url(__FILE__));

function ics_site_protocol() {
	if(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&  $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'){
		return 'https://';
	}
	return 'http://';
}
require_once( ICS_DIR_PATH . 'includes/functions.php' );

add_action ( 'admin_menu', 'ics_menu', 81 );
function ics_menu() {
	add_menu_page ( 'Coming Soon', 'Coming Soon', 'manage_options', 'ics_admin', 'ics_admin', ICS_DIR_URL . 'files/images/icon.png' );
}
$ext_menu = 'ics_admin';
include_once plugin_dir_path(__FILE__) . 'extensions_plus/index.php';

//admin scripts & style
add_action("admin_enqueue_scripts", 'ics_be_head');
function ics_be_head(){
    if(!isset($_REQUEST['page']) || $_REQUEST['page']!='ics_admin') return;
        wp_enqueue_style ( 'ics_jquery-ui.css', ICS_DIR_URL . 'files/css/jquery-ui.css' );
        wp_enqueue_style ( 'ics_jquery.timepicker.css', ICS_DIR_URL . 'files/css/jquery.timepicker.css' );
        wp_enqueue_style ( 'ics_back_end_style.css', ICS_DIR_URL . 'files/css/back_end_style.css' );
        wp_enqueue_style ( 'ics_font-awesome.min.css', ICS_DIR_URL . 'files/css/font-awesome.min.css' );
        wp_enqueue_style ( 'ics_colorpicker-css', ICS_DIR_URL . 'files/css/colorpicker.css' );

	    wp_enqueue_script ( 'jquery' );
        wp_enqueue_script( 'jquery-ui-datepicker' );

    if( function_exists( 'wp_enqueue_media' ) ){
        wp_enqueue_media();
        wp_enqueue_script ( 'open_media_3_5', ICS_DIR_URL . 'files/js/open_media_3_5.js', array(), null );
    }else{
        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'thickbox' );
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_script ( 'open_media_3_4', ICS_DIR_URL . 'files/js/open_media_3_4.js', array(), null );
    }
        wp_enqueue_script ( 'ics_jquery.timepicker.min', ICS_DIR_URL . 'files/js/jquery.timepicker.min.js', array(), null );
        wp_enqueue_script ( 'ics_colorpicker-js', ICS_DIR_URL . 'files/js/colorpicker.js', array(), null );
        wp_enqueue_script ( 'ics_ics_admin', ICS_DIR_URL . 'files/js/ics_admin.js', array(), null );
}

function ics_admin(){
    require( ICS_DIR_PATH . 'includes/ics_admin.php' );
}

add_action('init', 'ics_indeed_coming_soon');
function ics_indeed_coming_soon(){
	/*
	 * @param none
	 * @return string
	 */
	if (get_option('ics_enable')!=1) return;
	
	/// its ajax -> out
	if (defined('DOING_AJAX') && DOING_AJAX) return;
	
	///its cron -> out
	if (defined('DOING_CRON') && DOING_CRON) return;
	
	//admin can view anything
    if( is_admin() || current_user_can( 'manage_options' ) || in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')) ) return;  
    
	if (get_option('ics_auto_turnoff')){
		/// check time
		$expire_data = get_option('ics_end_date');
		$expire_time = get_option('ics_end_time');
		if ($expire_data && $expire_time){
			$timeout = strtotime($expire_data . ' ' .  $expire_time);
			if ($timeout && time()>$timeout){
				return;
			}			
		}
	}
	
    //check user role
    global $current_user;
    if (!empty($current_user) && !empty($current_user->ID)){
    	$user = new WP_User( $current_user->ID );
    	if ($user && !empty($user->roles) && !empty($user->roles[0])){
    		$allowed_roles = get_option('ics_wp_roles');
    		if ($allowed_roles){
    			$roles = explode(',', $allowed_roles);
    			if ($roles && is_array($roles) && in_array($user->roles[0], $roles)){
    				return;
    			}
    		}
    	}    	
    }
    
    $current_uri = ics_site_protocol().$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    
    //check visible urls
    $data = get_option('ics_visible_urls');
    if ($data && is_array($data)){
    	if (in_array($current_uri, $data)){
    		return;
    	}	
    }
    //check url based on keyword
    $data = get_option('ics_visible_urls_keywords');
    if ($data && is_array($data)){
    	foreach ($data as $keyword){
    		if (strpos($current_uri, $keyword)!==FALSE){
    			return;
    		}
    	}
    }    
    
    $meta_arr = array_merge(ics_return_arr_val('content'), ics_return_arr_val('background'));
    $meta_arr = array_merge(ics_return_arr_val('general_options'), $meta_arr);
    $meta_arr = array_merge(ics_return_arr_val('timeout'), $meta_arr);
    $meta_arr = array_merge(ics_return_arr_val('subscribe'), $meta_arr);

	
    if($current_uri != get_option('siteurl').'/' && $current_uri != get_option('siteurl')){
    	header( 'Location: ' . get_option('siteurl') );
    	exit;
    }

	if(isset($meta_arr['ics_layout'])){
		//LAYOUT 1
		if( $meta_arr['ics_layout']==1 ) require ICS_DIR_PATH . 'includes/ics_view_1.php';
		//LAYOUT 2
		elseif( $meta_arr['ics_layout']==2 ) require ICS_DIR_PATH . 'includes/ics_view_2.php';
	}else{
		//DEFAULT
		require ICS_DIR_PATH . 'includes/ics_view.php';
	}
    exit();
}

//ajax
add_action( 'wp_ajax_ics_send_email_fc', 'ics_send_email_fc' );
add_action('wp_ajax_nopriv_ics_send_email_fc', 'ics_send_email_fc');
function ics_send_email_fc() {
    @$to = get_option('ics_target_email');
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    if($to!='' && isset($_REQUEST)){
		$content = "<html><head></head><body><strong>Name: </strong>".$_REQUEST['name']."<br/><br/>".
					"<strong>Email: </strong>".$_REQUEST['email']."<br/><br/>".
					"<strong>Message: </strong>".$_REQUEST['message']."<br/><br/></body></html>";
        wp_mail( $to, 'Coming Soon '.get_bloginfo( 'name' ).' >> Contact Message', $content, $headers);
    }
    else echo 0;
    die();
}
add_action( 'wp_ajax_ics_save_email_subscribe', 'ics_save_email_subscribe' );
add_action('wp_ajax_nopriv_ics_save_email_subscribe', 'ics_save_email_subscribe');
function ics_save_email_subscribe() {
    if (isset($_REQUEST['email'])){
       
        $indeed_mail = new IndeedMailServices();
        $indeed_mail->dir_path = ICS_DIR_PATH . 'includes';
        switch($_REQUEST['subscribe_type']){
            case 'aweber':
                $aw_list = str_replace('awlist', '', get_option('ics_aweber_list'));
                $consumer_key = get_option( 'aweber_consumer_key' );
                $consumer_secret = get_option( 'aweber_consumer_secret' );
                $access_key = get_option( 'aweber_acces_key' );
                $access_secret = get_option( 'aweber_acces_secret' );
                $indeed_mail->indeed_aWebberSubscribe( $consumer_key, $consumer_secret, $access_key, $access_secret, $aw_list, $_REQUEST['email'] );
            break;

            case 'email_list':
                $email_list = get_option('ics_email_list');
                $email_list .= $_REQUEST['email'] . ',';
                update_option('ics_email_list', $email_list);
            	echo 1;
            break;

            case 'mailchimp':
			    $mailchimp_api = get_option( 'ics_mailchimp_api' );
                $mailchimp_id_list = get_option( 'ics_mailchimp_id_list' );
                $indeed_mail->indeed_mailChimp( $mailchimp_api, $mailchimp_id_list, $_REQUEST['email'] );
            break;

            case 'get_response':
			    $api_key = get_option('ics_getResponse_api_key');
                $token = get_option('ics_getResponse_token');
                $indeed_mail->indeed_getResponse( $api_key, $token, $_REQUEST['email'] );
            break;

            case 'campaign_monitor':
			    $listId = get_option('ics_cm_list_id');
                $apiID = get_option('ics_cm_api_key');
                $indeed_mail->indeed_campaignMonitor( $listId, $apiID, $_REQUEST['email'] );
            break;

            case 'icontact':
                $appId = get_option('ics_icontact_appid');
                $apiPass = get_option('ics_icontact_pass');
                $apiUser = get_option('ics_icontact_user');
                $listId = get_option('ics_icontact_list_id');
                $indeed_mail->indeed_iContact( $apiUser, $appId, $apiPass, $listId, $_REQUEST['email'] );
            break;

            case 'constant_contact':
			    $apiUser = get_option('ics_cc_user');
                $apiPass = get_option('ics_cc_pass');
				$listId = get_option('ics_cc_list');
                $indeed_mail->indeed_constantContact($apiUser, $apiPass, $listId, $_REQUEST['email']);
            break;

            case 'wysija':
			    $listID = get_option('ics_wysija_list_id');
                $indeed_mail->indeed_wysija_subscribe( $listID, $_REQUEST['email'] );
            break;

            case 'mymail':
			    $listID = get_option('ics_mymail_list_id');
                $indeed_mail->indeed_myMailSubscribe( $listID, $_REQUEST['email'] );
            break;

            case 'madmimi':
                 $username = get_option('ics_madmimi_username');
                 $api_key =  get_option('ics_madmimi_apikey');
                 $listName = get_option('ics_madmimi_listname');
                 $indeed_mail->indeed_madMimi($username, $api_key, $listName, $_REQUEST['email']);
            break;

        }
    }
    else echo 0;
    die();
}

add_action( 'wp_ajax_ics_update_aweber', 'ics_update_aweber' );
function ics_update_aweber(){
        require_once ICS_DIR_PATH .'includes/email_services/aweber/aweber_api.php';
        list($consumer_key, $consumer_secret, $access_key, $access_secret) = AWeberAPI::getDataFromAweberID(  $_REQUEST['auth_code'] );
        if(get_option('aweber_consumer_key')==false){
            add_option('aweber_consumer_key', $consumer_key);
            add_option('aweber_consumer_secret', $consumer_secret);
            add_option('aweber_acces_key', $access_key);
            add_option('aweber_acces_secret', $access_secret);
        }else{
            update_option( 'aweber_consumer_key', $consumer_key );
            update_option( 'aweber_consumer_secret', $consumer_secret );
            update_option( 'aweber_acces_key', $access_key );
            update_option( 'aweber_acces_secret', $access_secret );
        }
        echo 1;
        die();
}
add_action( 'wp_ajax_ics_get_cc_list', 'ics_get_cc_list' );
function ics_get_cc_list(){
	echo json_encode(ics_return_cc_list($_REQUEST['ics_cc_user'],$_REQUEST['ics_cc_pass']));
	die();
}
function ics_return_cc_list($ics_cc_user, $ics_cc_pass){
        require_once ICS_DIR_PATH .'includes/email_services/constantcontact/class.cc.php';
        $list = array();
		$cc = new cc($ics_cc_user, $ics_cc_pass);
		$lists = $cc->get_lists('lists');
		if ($lists){
			foreach ((array) $lists as $v){
				
				$list[$v['id']] = array('name' => $v['Name']);
			}
		}
       return $list;
       
}

add_action('wp_ajax_ics_delete_visible_link', 'ics_delete_visible_link' );
add_action('wp_ajax_nopriv_ics_delete_visible_link', 'ics_delete_visible_link');
function ics_delete_visible_link(){
	/*
	 * @param none
	 * @return none
	 */
	if (!empty($_REQUEST['value'])){
		if ($_REQUEST['type']=='url'){
			$data_key = 'ics_visible_urls';
		} else {
			$data_key = 'ics_visible_urls_keywords';
		}
		
		$data = get_option($data_key);
		if ($data && is_array($data)){
			$key = array_search($_REQUEST['value'], $data);
			if ($key!==FALSE){
				unset($data[$key]);
			}
			update_option($data_key, $data);	
		}
	}
	die();
}
