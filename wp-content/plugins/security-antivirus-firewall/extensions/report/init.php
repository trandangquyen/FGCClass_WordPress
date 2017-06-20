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

require_once 'wptsafExtensionReport.php';
require_once 'wptsafExtensionReportAjaxHandle.php';
require_once 'wptsafExtensionReportReportBuilder.php';
require_once 'wptsafExtensionReportCron.php';
require_once 'wptsafExtensionReportSettings.php';
require_once 'wptsafExtensionReportWidget.php';

wptsafSecurity::getInstance()->addExtension(wptsafExtensionReport::getInstance());
