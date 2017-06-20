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

echo $extensionTitle; ?>

==================================================
<?php _e('Total Scans', 'wptsaf_security'); echo ': '.$rowsAmount; ?>

<?php _e('Current Scans', 'wptsaf_security'); echo ': '.$rowsAmountForPeriod; ?>

<?php _e('Added', 'wptsaf_security'); ?>: <?php echo $addedByPeriod; ?> | <?php _e('Removed', 'wptsaf_security'); ?>: <?php echo $removedByPeriod; ?> | <?php _e('Changed', 'wptsaf_security'); ?>: <?php echo $changedByPeriod; ?>