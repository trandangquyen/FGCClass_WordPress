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

class wptsafExtensionGoogleCaptchaWidget extends wptsafAbstractExtensionWidget{

	public function content(){
		$this->extension->getBlogSettings()->init();

		$view = new wptsafView();

		return $view->content(
			$this->extension->getExtensionDir() . 'template/widget.php',
			array(
				'title' => $this->extension->getTitle(),
				'description' => $this->extension->getDescription(),
				'isEnabled' => $this->extension->isEnabled(),
				'rows' => $this->extension->getBlogSettings()->getRows(10, 0, 'ASC')
			)
		);
	}
}
