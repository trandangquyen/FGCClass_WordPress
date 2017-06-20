<?php
/*  
 * Security Antivirus Firewall (wpTools S.A.F.)
 * http://wptools.co/wordpress-security-antivirus-firewall
 * Version:           	2.1.23
 * Build:             	34569
 * Author:            	WpTools
 * Author URI:        	http://wptools.co
 * License:           	License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * Date:              	Tue, 17 Jan 2017 18:05:12 GMT
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ) exit;

class wptsafExtensionLoginBruteForceSettings extends wptsafSettings{

	public function __construct(wptsafAbstractExtension $extension){
		$this->optionKey = WPTSAF_OPTION_KEY_PREFIX . 'login_brute_force_settings';
		$this->defaultOptions = array(
			'is_enabled' => false,
			'log_rotation' => -1,
			'count_failed_login_first' => 5,
			'time_counting_login_first' => 5,
			'lock_time_first' => 5,
			'is_notify_admin_first' => 0,
			'count_failed_login_second' => 10,
			'time_counting_login_second' => 15,
			'lock_time_second' => 15,
			'is_notify_admin_second' => 1,
		);

		parent::__construct($extension);
	}
}
