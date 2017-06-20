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
?>
<?php _e("Your website stay safe because S.A.F. - wpTools Security Report guard your website!", 'wptsaf_security'); ?>
<?php if(WPTSAF_PRO){ ?>
<?php _e("Make your website even more safe with S.A.F. Premium version http://wptools.co/security-antivirus-firewall/#pricing", 'wptsaf_security'); ?>
<?php } ?>
<?php _e("If you have some kind of problems or new features request feel free to contact us http://wptools.co/security-antivirus-firewall/#get-in-touch", 'wptsaf_security'); ?>


==========================
<?php _e("Report for period from", 'wptsaf_security'); echo ' '.$dateFrom.' '.__('to', 'wptsaf_security').' '.$dateTo; ?>

==========================


<?php _e("Issues Detected", 'wptsaf_security'); ?>

=========================
<?php _e("Total Issues Detected", 'wptsaf_security'); ?>: <?php echo $rowsAmount; ?>

<?php _e("Current Issues Detected", 'wptsaf_security'); echo ': '.$rowsAmountForPeriod; ?>



<?php echo $reports; ?>



<?php _e("Your website stay safe because S.A.F. - wpTools Security Report guard your website!", 'wptsaf_security'); ?>
<?php if(WPTSAF_PRO){ ?>
<?php _e("Make your website even more safe with S.A.F. Premium version http://wptools.co/security-antivirus-firewall/#pricing", 'wptsaf_security'); ?>
<?php } ?>

<?php _e("Support", 'wptsaf_security'); ?>

==================================================
<?php _e("If you have some kind of problems or new features request feel free to contact us: http://wptools.co/security-antivirus-firewall/#get-in-touch", 'wptsaf_security'); ?>

