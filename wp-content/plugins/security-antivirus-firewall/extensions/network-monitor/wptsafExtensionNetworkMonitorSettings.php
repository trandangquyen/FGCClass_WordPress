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

class wptsafExtensionNetworkMonitorSettings extends wptsafSettings{
	
	public function __construct(wptsafAbstractExtension $extension){
		$this->optionKey = WPTSAF_OPTION_KEY_PREFIX . 'settings_network_monitor';
		$this->defaultOptions = array(
			'is_enabled' => false,
			'log_rotation' => -1,
			'lock_duration' => 3,
			'lock_duration_second' => 10,
		);
		parent::__construct($extension);
	}
}