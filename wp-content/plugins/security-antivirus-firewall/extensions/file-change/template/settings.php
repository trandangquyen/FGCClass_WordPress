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

$linkInfoWindow = 'action=wptsaf_security&extension=404-detection&method=dialog&args[name]=pro';
?>
<div class="row">
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
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">
							<?php _e('Cron Frequency Running:'); ?>
						</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div  class="col-md-3 col-sm-6 col-xs-12" <?php if( !WPTSAF_PRO ) echo 'data-action="'.$linkInfoWindow.'"'; ?> > 
								<select class="form-control" name="frequency_running"
										<?php if( !WPTSAF_PRO ) echo 'disabled '; ?>
								>
									<?php foreach ($frequencyRunning as $value => $title) : ?>
										<option value="<?php echo $value; ?>"
											<?php echo $settings['frequency_running'] == $value ? 'selected' : ''; ?> >
											<?php echo $title; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<?php if( !WPTSAF_PRO ){ ?>
								<div class="col-md-3 col-sm-6 col-xs-12">
									<button class="btn btn-danger" data-action="<?php echo $linkInfoWindow;?>"><?php _e('pro feature', 'wptsaf_security'); ?></button>
								</div>
							<?php } ?>

						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">
							<?php _e('Cron Time Running:'); ?>
						</label>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<select name="time_running[h]">
								<?php for ($h = 0; $h <= 23; $h++) : ?>
									<option value="<?php echo $h; ?>"
										<?php echo $settings['time_running']['h'] == $h ? 'selected' : ''; ?> >
										<?php printf('%02d', $h); ?>
									</option>
								<?php endfor; ?>
							</select>
							<select name="time_running[m]">
								<?php for ($m = 0; $m <= 60; $m++) : ?>
									<option value="<?php echo $m; ?>"
										<?php echo $settings['time_running']['m'] == $m ? 'selected' : ''; ?> >
										<?php printf('%02d', $m); ?>
									</option>
								<?php endfor; ?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="file_dir_list_required" class="control-label col-md-3 col-sm-3 col-xs-12">
							<?php echo __('Required Files and Folders List', 'wptsaf_security'); ?>
						</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea id="file_dir_list_required" class="form-control"
							          cols="30" rows="3"
							          disabled
							><?php echo implode("\n", $settings['file_dir_list_required']); ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="file_dir_list" class="control-label col-md-3 col-sm-3 col-xs-12">
							<?php echo __('Files and Folders List', 'wptsaf_security'); ?>
						</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<?php if (!empty($errors['file_dir_list'])) : ?>
								<ul class="parsley-errors-list filled">
									<li><?php echo $errors['file_dir_list']; ?></li>
								</ul>
							<?php endif; ?>
							<textarea id="file_dir_list" class="form-control"
							          cols="30" rows="3"
							          name="file_dir_list"
							><?php echo implode("\n", $settings['file_dir_list']); ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="ignore_file_types" class="control-label col-md-3 col-sm-3 col-xs-12">
							<?php echo __('Ignore File Types', 'wptsaf_security'); ?>
						</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<?php if (!empty($errors['ignore_file_types'])) : ?>
								<ul class="parsley-errors-list filled">
									<li><?php echo $errors['ignore_file_types']; ?></li>
								</ul>
							<?php endif; ?>
							<textarea id="ignore_file_types" class="form-control"
							          cols="30" rows="4"
							          name="ignore_file_types"
							><?php echo implode("\n", $settings['ignore_file_types']); ?></textarea>
						</div>
					</div>

					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
							<button class="btn btn-default pull-right btn-popup-close">
								<?php _e('Close', 'wptsaf_security'); ?>
							</button>

							<button class="btn btn-success pull-right" type="submit"
							        data-action="action=wptsaf_security&extension=file-change&method=settingsSave">
							<?php _e('Submit', 'wptsaf_security'); ?>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
