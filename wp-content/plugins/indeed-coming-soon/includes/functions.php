<?php
function ics_return_arr( $type ){
  switch($type){
        case 'content':
            $meta_arr = array(
                                'ics_logo' => ICS_DIR_URL . 'files/images/default-logo.png',
                                'ics_logo_height' => 130,
                                'ics_home_label' => 'Home',
                                'ics_title_1' => 'WP',
                                'ics_title_2' => 'Plugin',
                                'ics_title_3' => 'COMING SOON',
                                'ics_subtitle' => 'A creative plugin like no other',

                                //social media
                                'ics_smb_text' => 'or find us online',
                                'ics_facebook' => '#',
                                'ics_twitter' => '#',
                                'ics_googleplus' => '#',
                                'ics_linkedin' => '#',
                                'ics_instagram' => '#',
                                'ics_pinterest' => '',
                                'ics_youtube' => '',
                                'ics_vk' => '',
                                'ics_vimeo' => '',
                                'ics_dribbble' => '',

                                //copyright text
                                'ics_copyright' => 'Copyright © 2015 - Indeed',

                                //about page
                                'ics_about_page_enable' => 1,
                                'ics_about_label' => 'Our Company',
                                'ics_about_title' => 'A quick overview',
                                'ics_about_text' => '<div>Donec luctus nisi dui, id rhoncus odio blandit vitae. Sed laoreet lectus elit, eu rutrum velit dignissim in. Curabitur ipsum ipsum, tincidunt vewsel metus nec, ultricies molestie purus neque vel.<span style="line-height: 1.714285714; font-size: 1rem;">Pellentesque </span><a style="line-height: 1.714285714; font-size: 1rem;" href="file:///C:/Users/Developer4/Desktop/Transient/MAIN/HTML/Static%20-%20Copy/index.html#">semper quam</a><span style="line-height: 1.714285714; font-size: 1rem;"> in tortor semper, in faucibus odio tempor. Proin aliquam arcu urna. Nullam tempus ante ut nunc dapibus, a blandit ipsum interdum.</span></div>',
                                    //About Icons
                                'fa-camera-ics-text' => 'Photography',
                                'fa-camera-ics-enable' => 1,
                                'fa-bolt-ics-text' => 'Digital Media',
                                'fa-bolt-ics-enable' => 1,
                                'fa-users-ics-text' => 'Marketing',
                                'fa-users-ics-enable' => 1,
                                'fa-circle-o-ics-text' => 'Signage',
                                'fa-circle-o-ics-enable' => 1,
                                'fa-inbox-ics-text' => 'Packaging',
                                'fa-inbox-ics-enable' => 1,
                                'fa-desktop-ics-text' => 'Web',
                                'fa-desktop-ics-enable' => 1,

                                //contact page
                                'ics_contact_page_enable' => 1,
                                'ics_contact_label' => 'Contact',
                                'ics_contact_title' => 'Share with us',
                                'ics_contact_name' => 'Name',
                                'ics_contact_email' => 'Email Address',
                                'ics_contact_message' => 'Message',
                                'ics_contact_submit' => 'Send',
                                'ics_target_email' => 'your@email.com',
                                'ics_contact_s_msg' => 'Your message has been sent.',

                                //more info
                                'ics_enable_more_info' => 1,
								'ics_more_info_text' => 'Find out more',
								'ics_title_more_info' => 'More info',
                                'ics_more_info' => 'Praesent faucibus iaculis nulla, vel placerat dui commodo in. Suspendisse potenti. Fusce dignissim id diam ut imperdiet. Duis venenatis turpis nibh. Mauris egestas turpis in elit vestibulum, nec pretium tortor scelerisque. Mauris non mauris et leo tempor sodales.<h4>Extra content</h4>Morbi quis erat bibendum quam iaculis faucibus. Quisque ornare varius nunc. Nunc interdum nisi non ante bibendum facilisis.Vestibulum ullamcorper, tortor dictum <a href="file:///C:/Users/Developer4/Desktop/Transient/MAIN/HTML/Static%20-%20Copy/index.html#">semper adipiscing</a>, dui mauris vestibulum turpis, at dignissim lectus erat eu nibh. Aenean sit amet laoreet mi.Praesent faucibus iaculis nulla, vel placerat dui commodo in. Suspendisse potenti. Fusce dignissim id diam ut imperdiet. Duis venenatis turpis nibh. Mauris egestas turpis in elit vestibulum, nec pretium tortor scelerisque. Mauris non mauris et leo tempor sodales.',
                              );
        break;
        case 'background':
             $meta_arr = array(
                                'ics_bk_type' => 'solid_color',
                                'ics_background_img' => '',
                                'ics_img_arr' => '',
                                'ics_img_arr_effect' => '',
                                'ics_color_bk' => '#666666',
                                'ics_slide_effect' => 0,
                                'ics_bk_pn' => 'pattern_1.png',
                                'ics_background_d' => '0.4',
                                'ics_video_bk' => '',
                                'ics_sound_on' => 1,
								'ics_video_mobile' => 0,
                                'ics_parallax_image' => '',
                             );
        break;
        case 'general_options':
              $meta_arr = array(
                                  'ics_enable' => 0,
                                  'ics_meta_title' => 'Indeed Coming Soon Plugin',
                                  'ics_meta_keywords' => '',
                                  'ics_meta_description' => 'Indeed Coming Soon Plugin',
                                  'ics_favicon' => '',
								  'ics_custom_css' => '',
                                  'ics_general_color' => '',
                                  'ics_change_page_effect' => 'fadeIn',
                                  'ics_layout' => 1,
                                );
        break;
        case 'timeout':
              $date = date(time() + (7 * 24 * 60 * 60));
              $meta_arr = array(
                                  'ics_count_down_type' => 'digits',
                                  'ics_end_time' => date('H:i'),
                                  'ics_end_date' => date('m/d/y', $date),
				              		//time
				              		'ics_days_word' => 'Days',
				              		'ics_day_word' => 'day',
				              		'ics_hours_word' => 'Hours',
				              		'ics_hour_word' => 'hour',
				              		'ics_minutes_word' => 'Minutes',
				              		'ics_minute_word' => 'minute',
				              		'ics_seconds_word' => 'Seconds',
				              		'ics_second_word' => 'second',
				              		'ics_auto_turnoff' => 0,
                               );
        break;
        case 'subscribe':
              $meta_arr = array(
                                  'ics_enable_subscribe' => 1,
								  'ics_subscribe_text' => 'Subscribe for updates',
                                  'ics_subscribe_label' => 'Email address',
                                  'ics_subscribe_bttn' => 'Go',
                                  'ics_subscribe_msg' => 'You have been subscribed.',
                                  'ics_subscribe_type' => 'email_list',
                                  //mailchimp
                                  'ics_mailchimp_api' => '',
                                  'ics_mailchimp_id_list' => '',
                                  //getresponse
                                  'ics_getResponse_api_key' => '',
                                  'ics_getResponse_token' => '',
                                  //campaign monitor
                                  'ics_cm_list_id' => '',
                                  'ics_cm_api_key' => '',
                                  //icontact
                                  'ics_icontact_user' => '',
                                  'ics_icontact_pass' => '',
                                  'ics_icontact_appid' => '',
                                  'ics_icontact_list_id' => '',
                                  //constant contact
                                  'ics_cc_user' => '',
                                  'ics_cc_pass' => '',
								  'ics_cc_list' => '',
                                  //wysija
                                  'ics_wysija_list_id' => '',
                                  //mymail
                                  'ics_mymail_list_id' => '',
                                  //madmimi
                                  'ics_madmimi_username' => '',
                                  'ics_madmimi_apikey' => '',
                                  'ics_madmimi_listname' => '',
                                  //aweber
                                  'ics_aweber_auth_code' => '',
                                  'ics_aweber_list' => '',
                                );
        	break;
        case 'security':
        	$meta_arr = array(
        						'ics_wp_roles' => '',
        						
        					);
        	break;
  }
    return $meta_arr;
}
function ics_return_arr_val( $type ){
    $meta_arr = ics_return_arr( $type );
    foreach($meta_arr as $k=>$v){
        if( get_option( $k )===FALSE ) add_option($k, $v);
        else $meta_arr[$k] = get_option($k);
    }
    return $meta_arr;
}

function ics_return_arr_update( $type ){
    $meta_arr = ics_return_arr( $type );
    foreach($meta_arr as $k=>$v){
        if(get_option($k)===FALSE){
            if(!isset($_REQUEST[$k])){
                add_option($k, '');
                //return;
            }elseif(is_array($_REQUEST[$k])){
                add_option($k, serialize($_REQUEST[$k]));
            }else { add_option($k, $_REQUEST[$k]);}
        }else{
            if(!isset($_REQUEST[$k])){
                update_option($k, '');
                //return;
            }elseif(is_array($_REQUEST[$k])){
                update_option($k, serialize($_REQUEST[$k]));
            }else{
                update_option($k, $_REQUEST[$k]);
            }
        }
    }

}
function ics_checkSelected($val1, $val2, $type){
    // check if val1 is equal with val2 and return an select attribute for checkbox, radio or select tag
    if($val1==$val2){
        if($type=='select') return 'selected="selected"';
        else return 'checked="checked"';
    }else return '';
}

function ics_return_general_color( $color ){
    $str = "
              ::-moz-selection {
                  background: #ICS_GENERAL_COLOR#;
              }
              ::selection {
                  background: #ICS_GENERAL_COLOR#;
              }
              p a:hover {
                  border-color: #ICS_GENERAL_COLOR#;
              }
              .modal-header .close {
                  color: #ICS_GENERAL_COLOR#;
                  border: solid 1px #ICS_GENERAL_COLOR#;
              }
              .modal h4 {
              	color: #ICS_GENERAL_COLOR#;
              }
              .modal p a:hover {
                  border-color: #ICS_GENERAL_COLOR#;
              }
              .site-logo {
              	background: #ICS_GENERAL_COLOR#;
              }
              .tooltip-show {
                  background: #ICS_GENERAL_COLOR#;
              }
              .tooltip-show .tooltip-arrow {
                  border-right-color: #ICS_GENERAL_COLOR#;
              }
              nav a:hover {
                  color: #ICS_GENERAL_COLOR#;
              }
              nav .active {
                  color: #ICS_GENERAL_COLOR#;
              }
              .nav-container:hover .nav-toggle {
                  color: #ICS_GENERAL_COLOR#;
              }
              .nav-toggle.active {
                   color: #ICS_GENERAL_COLOR#;
              }
              #subscribe-email {
                  outline-color: #ICS_GENERAL_COLOR#;
              }
              #subscribe-submit:hover {
                  color: #ICS_GENERAL_COLOR#;
              }
              .contact-form input, .contact-form textarea {
                  outline-color: #ICS_GENERAL_COLOR#;
              }
              .btn-contact:hover {
                  color: #ICS_GENERAL_COLOR#;
              }
              .social-media a:hover {
                  color: #ICS_GENERAL_COLOR#;
              }
              .circleG {
                  background-color: #ICS_GENERAL_COLOR#;
              }
			  
              nav li a:hover {
                  color: #ICS_GENERAL_COLOR#;
              }
              @media (min-width: 768px) and (max-width: 991px) {
                  .tooltip-show .tooltip-arrow {
                      border-bottom-color: #ICS_GENERAL_COLOR#;
              	}
			  }
			  @media (max-width: 767px) {
              	nav li a:hover {
                 	 background: #ICS_GENERAL_COLOR# !important;
					 color:#fff;
              	}
				nav li a{
				  color: #ICS_GENERAL_COLOR#;
			    }
              }
			  
              .tooltip-show .tooltip-arrow {
                  border-bottom-color: #ICS_GENERAL_COLOR#;
              }
    ";
    $style = str_replace('#ICS_GENERAL_COLOR#', $color, $str);
    return $style;
}

class IndeedMailServices{
    public $dir_path = '';

    public function indeed_getResponse($api_key, $token, $e_mail){
		require_once $this->dir_path . '/email_services/getresponse/jsonRPCClient.php';
		$api = new jsonRPCClient('http://api2.getresponse.com');
		$args = array(
			    'campaign'  => $token,
			    'email' => $e_mail,
    	);
        $res = $api->add_contact($api_key, $args);
        if($res) echo 1;
        else echo 0;
    }

    public function indeed_mailChimp($mailchimp_api, $mailchimp_id_list, $e_mail){
		
			if($mailchimp_api !='' && $mailchimp_id_list !=''){
				
				if(!class_exists('MailChimp'))
   					require_once $this->dir_path . '/email_services/mailchimp/MailChimp.php';
				
				$MailChimp = new MailChimp($mailchimp_api);

                $result = $MailChimp->call('lists/subscribe', array(
                                'id'                => $mailchimp_id_list,
                                'email'             => array('email'=>$e_mail),
                                'double_optin'      => 0,
                                'update_existing'   => true,
                                'replace_interests' => false,
                                'send_welcome'      => 0,
                            ));

                if(!empty($result['email']) && !empty($result['euid']) && !empty($result['leid'])) {
                    echo 1;
                }else
                	echo 0;
			}
    }

    public function indeed_campaignMonitor($listId, $apiID, $e_mail){
			require_once $this->dir_path .'/email_services/campaignmonitor/csrest_subscribers.php';
			$obj = new CS_REST_Subscribers($listId, $apiID);
			$args = array(
				'EmailAddress' => $e_mail,
				'Resubscribe' => true
			);
			$result = $obj->add($args);
			if ($result->was_successful())echo 1;
			else echo 0;
    }

    public function indeed_iContact( $apiUser, $appId, $apiPass, $listId ,$e_mail ){
			require_once $this->dir_path .'/email_services/icontact/iContactApi.php';
			iContactApi::getInstance()->setConfig(array(
				'appId' => $appId,
				'apiPassword' => $apiPass,
				'apiUsername' => $apiUser,
			));
			$oiContact = iContactApi::getInstance();
			$res1 = $oiContact->addContact($e_mail, null, null, '', '', null, null, null, null, null, null, null, null, null);
            if ($res1->contactId) {
                if($oiContact->subscribeContactToList($res1->contactId, $listId, 'normal')) echo 1;
                else echo 0;
            }else echo 0;
    }

    public function indeed_constantContact($apiUser, $apiPass, $listId, $e_mail){
			require_once $this->dir_path .'/email_services/constantcontact/class.cc.php';
			$cc = new cc($apiUser, $apiPass);
			$contact = $cc->query_contacts($e_mail);
			if ($contact){
                $status = $cc->update_contact($contact['id'], $e_mail, $listId, '');
                if($status) echo 1;
                else echo 0;
			}
            else{
                $new_id = $cc->create_contact($e_mail, $listId, '');
                if($new_id)echo 1;
                else echo 0; 
            }
			
    }

    public function indeed_wysija_subscribe( $listId, $e_mail ){
			$user_data = array(
				'email' => $e_mail,
				'firstname' => '',
				'lastname' => '');
			$data = array(
				'user' => $user_data,
				'user_list' => array('list_ids' => array($listId))
			);
			$helper = &WYSIJA::get('user', 'helper');
			if($helper->addSubscriber($data))echo 1;
            else echo 0;
    }

    public function indeed_returnWysijaList(){
        //returning list from mail poet
      	$list = array();
      	if(class_exists('WYSIJA')){
      		$get_list = &WYSIJA::get('list','model');
      		$lists = $get_list->get(array('name','list_id'),array('is_enabled'=>1));
      		if(isset($lists) && count($lists)>0){
      			foreach($lists as $value){
      				$list_arr[$value['list_id']] = $value['name'];
      			}      			
      		}
      	}
      	if (!isset($list_arr) || count($list_arr) == 0) return 0;
      	else return $list_arr;
    }

    public function indeed_myMailSubscribe( $listId, $e_mail ){
      $userdata = array(
				'firstname' => '',
				'lastname' => ''
			    );
        if(function_exists('mymail_subscribe')){
			$return = mymail_subscribe( $e_mail, $userdata, array($listId), 0);
			if ( !is_wp_error($return) ) echo 1;
            else echo 0;
        }else echo 0;
    }

    public function indeed_getMyMailLists(){
        //return mymail lists
    	if(function_exists('mymail') ){
    		//my mail >=2
    		$lists = mymail('lists')->get();
    		if(isset($lists) && count($lists)>0){
    			foreach($lists as $v){
    				if(isset($v->slug) && isset($v->name) ) $list_arr[$v->slug] = $v->name;
    			}
    			return $list_arr;
    		}
    		return FALSE;
    	}else{
	    	$args = array(
	    		'orderby'       => 'name',
	    		'order'         => 'ASC',
	    		'hide_empty'    => false,
	    		'exclude'       => array(),
	    		'exclude_tree'  => array(),
	    		'include'       => array(),
	    		'fields'        => 'all',
	    		'hierarchical'  => true,
	    		'child_of'      => 0,
	    		'pad_counts'    => false,
	    		'cache_domain'  => 'core'
	    	);
	    	$lists = get_terms( 'newsletter_lists', $args );
	        if(isset($lists)){
	        	foreach($lists as $v){
	        	    if( isset($v->slug) && isset($v->name) ) $list_arr[$v->slug] = $v->name;
	        	}
	        	if (!isset($list_arr) || count($list_arr) == 0) $list_arr[0] = 'none';
	        	return $list_arr;
	        }else return 0;
    	}
    }

    public function indeed_aWebberSubscribe( $consumer_key, $consumer_secret, $access_key, $access_secret, $aw_list, $e_mail ){
       require_once $this->dir_path .'/email_services/aweber/aweber_api.php';
       try{
			$aweber = new AWeberAPI($consumer_key, $consumer_secret);
			$account = $aweber->getAccount($access_key, $access_secret);
			
			$list = $account->loadFromUrl('/accounts/' . $account->id . '/lists/' . $aw_list);
	
			$subscriber = array(
							'email' => $e_mail,
							'ip' => $_SERVER['REMOTE_ADDR'],
							'name' => ''
						);
			$list->subscribers->create($subscriber);
			echo 1;
	   }
	   catch (AWeberException $e){		
			echo 0;
			}
    }

    public function indeed_madMimi($username, $api_key, $listName, $e_mail){
        require $this->dir_path .'/email_services/madmimi/MadMimi.class.php';
        $mailer = new MadMimi( $username, $api_key );
        $user = array( 'email' => $e_mail,
                       'firstName' => '',
                       'lastName' => '',
                       'add_list' => $listName,
                       );
        If($mailer){
            $mailer->AddUser($user);
            echo 1;
        }else echo 0;
    }

}

function ics_test_meta_return_js_var($name, $meta){
	if(isset($meta)) return "$name = '$meta';";
}

function ics_return_video_controllers($meta_arr){
	if(!class_exists('Mobile_Detect'))
	require ICS_DIR_PATH . 'includes/Mobile_Detect.php';
	$detect = new Mobile_Detect();
	if( ($detect->isMobile()) || ($detect->isTablet()) ) return;
	if($meta_arr['ics_bk_type']=='video' && isset($meta_arr['ics_sound_on']) && $meta_arr['ics_sound_on']==1){
		?>
					<div class="ics_video_controllers">
						<div class="tubular-play ics_v_c">
							<i class="ics-icon-fa ics-play"></i>
						</div>
						<div class="tubular-pause ics_v_c">
							<i class="ics-icon-fa ics-pause"></i>
						</div>
						<div class="tubular-volume-up ics_v_c">
							<i class="ics-icon-fa ics-volume-up"></i>
						</div>
						<div class="tubular-volume-down ics_v_c">
							<i class="ics-icon-fa ics-volume-down"></i>
						</div>
						<div class="tubular-mute ics_v_c">
							<i class="ics-icon-fa ics-mute"></i>
						</div>
					</div>
				<?php 
			}	
}

function isb_admin_check_selection($check1, $check2, $return_value){
	if($check1==$check2) echo $return_value;
	return '';
}

function ics_sm_types(){
	//return an array with social media types
	$arr = array(
			'ics_facebook' => 'facebook',
			'ics_twitter' => 'twitter',
			'ics_googleplus' => 'google-plus',
			'ics_linkedin' => 'linkedin',
			'ics_instagram' => 'instagram',
			'ics_pinterest' => 'pinterest',
			'ics_youtube' => 'youtube',
			'ics_vk' => 'vk',
			'ics_vimeo' => 'vimeo',
			'ics_dribbble' => 'dribbble',
	);
	return $arr;
}

function ics_sm_style_header($meta_arr){
	//Extra style for social media icons
	$style = '';
	$arr = ics_sm_types();
	$i = 0;
	foreach($arr as $k=>$v){
		if(isset($meta_arr[$k]) && $meta_arr[$k]!=''){
			$i++;
		}
	}
	if($i>6){
		if(!class_exists('Mobile_Detect')) require ICS_DIR_PATH . 'includes/Mobile_Detect.php';
		$detect = new Mobile_Detect();
		if( ($detect->isMobile()) || ($detect->isTablet()) ){
			//some padding for mobile
			$style .= '.social-media li .fa-ics{ padding-bottom:10px;}';
		}
	}
	if($i>6 && $i<=8){
		$style .= '.social-media li {
						padding-right: 25px;
					}';
   	}elseif($i>8){
		$style .= '.social-media li{
						padding-right: 13px;
					}';
	}
	return $style;
}