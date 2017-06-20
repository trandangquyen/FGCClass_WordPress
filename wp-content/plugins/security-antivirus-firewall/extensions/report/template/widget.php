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

?><div class="x_title">
	<h2>
		<?php wpToolsSAFHelperClass::getCheckIcon($isEnabled);  ?>
		<?php echo $title; ?>
		&nbsp;
		<button class="btn btn-xs <?php echo $isEnabled ? 'btn-default' : 'btn-success'; ?>" type="button"
		        data-action="action=wptsaf_security&extension=report&method=setEnable&args[isEnabled]=<?php echo $isEnabled ? 0 : 1; ?>">
			<?php 
				if($isEnabled){
					echo __('Deactivate', 'wptsaf_security');
				} else {
					echo __('Activate', 'wptsaf_security');
				}
			?>
		</button>
		<button class="btn btn-default btn-xs" type="button"
		        data-action="action=wptsaf_security&extension=report&method=settings">
			<?php echo __('Settings', 'wptsaf_security'); ?>
		</button>
	</h2>
	<div class="clearfix"></div>
</div>

<div class="x_content">
	<p>
		<?php echo $description; ?>
	</p>
</div>
