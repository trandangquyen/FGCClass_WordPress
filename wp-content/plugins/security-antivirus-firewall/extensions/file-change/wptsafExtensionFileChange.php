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

class wptsafExtensionFileChange extends wptsafAbstractExtension{

	protected static $instance;

	public function __construct(){
		$this->name = 'file-change';
		$this->title = __('Antivirus', 'wptsaf_security');
		$this->description = __("Antivirus module protect your website from infection and heal already infected files in the case if it's already happened. Our antivirus module implemented based on unique 2 level viruses control. On the first level our antivirus scan your server files and detect all infection cases. Second level scan files with online cloud antivirus service, which use more then 50 most powerful antivirus software to scan your files on Cloud. All process optimized to save resources of your system and for detection malware and viruses the best way. With our double stage algorithm any malware and viruses have no chance to survive. All process of scanning is fully automatic and do not require any special skills.", 'wptsaf_security');
		
		parent::__construct();
	}

	public static function getInstance(){
		if (!self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function getSettings(){
		return parent::getSettings();
	}
}
