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

class wptsafView{

	public function render($template, array $vars = array()){
		if (!file_exists(WPTSAF_DIR . $template)) {
			wptsafExtensionSystemLog::getInstance()->getLog()->addDangerMessage(
				wptsafSecurity::getInstance(),
				sprintf(__('Could not find template "%s"', 'wptsaf_security'), $template)
			);
		}
		extract($vars);
		require WPTSAF_DIR . $template;
	}

	public function content($template, array $vars = array()){
		ob_start();
		$this->render($template, $vars);
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}
}
