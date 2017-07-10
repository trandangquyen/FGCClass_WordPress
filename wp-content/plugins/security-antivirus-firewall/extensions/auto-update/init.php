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

require_once 'wptsafExtensionAutoUpdate.php';
require_once 'wptsafExtensionAutoUpdateAjaxHandle.php';
require_once 'wptsafExtensionAutoUpdateSettings.php';
require_once 'wptsafExtensionAutoUpdateWidget.php';

wptsafSecurity::getInstance()->addExtension(wptsafExtensionAutoUpdate::getInstance());