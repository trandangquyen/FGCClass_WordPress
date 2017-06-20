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

?><div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>
					<?php echo $extensionTitle . ': ' . __('Settings', 'wptsaf_security'); ?>
				</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form class="form-horizontal form-label-left">
					<div class="form-group">
						<label class="col-md-3 col-sm-3 col-xs-12 control-label">
							<?php _e('Enable', 'wptsaf_security'); ?>
						</label>

						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="checkbox">
								<label>
									<input type="checkbox" class="js-switch" name="is_enabled" value="1"
									       <?php echo $settings['is_enabled'] ? 'checked' : ''; ?>>
								</label>
							</div>
						</div>
					</div>

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
								<br />
								-1 - <?php _e('Use value from global settings', 'wptsaf_security'); ?>
							</p>
						</div>
					</div>

					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
							<button class="btn btn-default pull-right btn-popup-close">
								<?php _e('Close', 'wptsaf_security'); ?>
							</button>
							
							<button class="btn btn-success pull-right" type="submit"
							        data-action="action=wptsaf_security&extension=404-detection&method=settingsSave">
							<?php _e('Submit', 'wptsaf_security'); ?>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
