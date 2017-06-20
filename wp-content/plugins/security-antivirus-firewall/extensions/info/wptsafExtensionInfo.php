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

class wptsafExtensionInfo extends wptsafAbstractExtension{
	
	protected static $instance;

	public function __construct(){
		$this->name = 'info';
		$this->title = 'Info';
		$this->description = 'Info description';
		parent::__construct();
	}

	public static function getInstance(){
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	protected function init(){
		add_action('wptsaf_security_admin_page_before_content', array($this, 'actionAdminPageBeforeContent'));
	}

	public function actionAdminPageBeforeContent(){
		$view = new wptsafView();
		$view->render($this->getExtensionDir() . 'dialogs/contacts.php');
	}

	public function isEnabled(){
		return true;
	}
}
