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

?><form method="post" class="form-horizontal form-label-left">
	<div class="form-group">
		<label for="log_rotation" class="control-label col-md-3 col-sm-3 col-xs-12">
			<?php echo __('Log rotation(day)', 'wptsaf_security'); ?>
		</label>
		<div class="col-md-9 col-sm-9 col-xs-12">
			<?php if (!empty($errors['log_rotation'])) : ?>
				<ul class="parsley-errors-list filled">
					<li><?php echo $errors['log_rotation']; ?></li>
				</ul>
			<?php endif; ?>
			<input type="text" id="log_rotation" class="form-control"
			       name="log_rotation"
			       value="<?php echo $settings['log_rotation'] ?>">
			<p class="field-description">
				&nbsp;0 - <?php _e('Never clean log', 'wptsaf_security'); ?>
			</p>
		</div>
	</div>

	<div class="form-group">
		<label for="notification_emails" class="control-label col-md-3 col-sm-3 col-xs-12">
			<?php echo __('Notification emails', 'wptsaf_security'); ?>
		</label>
		<div class="col-md-9 col-sm-9 col-xs-12">
			<?php if (!empty($errors['notification_emails'])) : ?>
				<ul class="parsley-errors-list filled">
					<li><?php echo $errors['notification_emails']; ?></li>
				</ul>
			<?php endif; ?>
			<textarea id="notification_emails" class="form-control"
			          cols="30" rows="8"
			          name="notification_emails"
			><?php echo implode("\n", $settings['notification_emails']); ?></textarea>
			<p class="field-description">
				<?php _e('Each email in new line', 'wptsaf_security'); ?>
			</p>
		</div>
	</div>

	<div class="ln_solid"></div>
	<div class="form-group">
		<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
			<button type="submit" class="btn btn-success pull-right">Save</button>
		</div>
	</div>
</form>