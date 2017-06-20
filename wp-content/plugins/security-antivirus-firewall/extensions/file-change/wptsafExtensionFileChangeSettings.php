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

class wptsafExtensionFileChangeSettings extends wptsafSettings{

	protected $frequencyRunning;

	public function __construct(wptsafAbstractExtension $extension){
		$this->frequencyRunning = array(
			'24H' => __('per 24 hour', 'wptsaf_security'),
			'48H' => __('per 48 hour', 'wptsaf_security'),
			'72H' => __('per 72 hour', 'wptsaf_security'),
			'1W' => __('per week', 'wptsaf_security'),
			'1M' => __('per month', 'wptsaf_security'),
		);

		$this->optionKey = WPTSAF_OPTION_KEY_PREFIX . 'file_change_settings';
		$this->defaultOptions = array(
			'is_enabled' => false,
			'log_rotation' => -1,
			'frequency_running' => '1M',
			'time_running' => array(
				'h' => 23,
				'm' => 0
			),
			'file_dir_list_required' => array(
				'/wp-config.php',
				'/wp-content'
			),
			'file_dir_list' => array(),
			'ignore_file_types' => array(
				'jpg', 'jpeg', 'png', 'gif',
				'log',
				'mo', 'po',
				'zip', 'rar', 'tar', 'gz', 'gzip', 'bz2', 'tgz',
				'data',
				'mov', 'swf', 'mp4',
			)
		);

		parent::__construct($extension);
	}


	public function getFrequencyRunning(){
		return $this->frequencyRunning;
	}
}
