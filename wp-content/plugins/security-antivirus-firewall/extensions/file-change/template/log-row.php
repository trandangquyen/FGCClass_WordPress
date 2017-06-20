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

$tabs = array(
	'added' => __('Added', 'wptsaf_security'),
	'removed' => __('Removed', 'wptsaf_security'),
	'changed' => __('Changed', 'wptsaf_security'),
	/*'probably_infected' => __('Probably Infected', 'wptsaf_security'),*/
);

?>
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>
					<?php
						echo $extensionTitle . ': '
							. __('Scan result', 'wptsaf_security')
							. (isset($row['id']) ? " #{$row['id']}" : '')
					?>
				</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div data-example-id="togglable-tabs" role="tabpanel" class="">
					<ul role="tablist" class="nav nav-tabs bar_tabs" id="myTab">
						<?php $isFirst = true; ?>
						<?php foreach ($tabs as $name => $title) : ?>
							<li class="<?php echo $isFirst ? 'active' : ''; ?>" role="presentation">
								<a aria-expanded="<?php echo $isFirst ? 'true' : ''; ?>" data-toggle="tab"
								   id="<?php echo $name; ?>_tab" role="tab" href="#<?php echo $name; ?>_content">
									<?php echo "{$title} ($row[$name])"; ?>
								</a>
							</li>

							<?php $isFirst = false; ?>
						<?php endforeach; ?>
					</ul>
					<div class="tab-content" id="myTabContent">
						<?php $isFirst = true; ?>
						<?php foreach ($tabs as $name => $title) : ?>
							<div id="<?php echo $name; ?>_content" class="tab-pane fade <?php echo $isFirst ? 'active in' : ''; ?>"
							     aria-labelledby="<?php echo $name; ?>_content-tab" role="tabpanel">

								<?php if ($row[$name]) : ?>
									<table class="log table table-striped table-bordered">
										<thead>
										<tr>
											<th>
												<?php _e('Date', 'wptsaf_security'); ?>
											</th>
											<th>
												<?php _e('File', 'wptsaf_security'); ?>
											</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($row['change_list'][$name] as $path => $attr) : ?>
											<tr>
												<td><?php echo date(WPTSAF_DATE_FORMAT, $attr['d']); ?></td>
												<td><?php echo $path; ?></td>
											</tr>
										<?php endforeach; ?>
										</tbody>
									</table>
								<?php else : ?>
									<p><?php _e('Empty list', 'wptsaf_security'); ?></p>
								<?php endif; ?>
							</div>

							<?php $isFirst = false; ?>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="clear"></div>

				<div class="ln_solid"></div>
				<div class="buttons">
					<button class="btn btn-default pull-right btn-popup-close">
						<?php _e('Close', 'wptsaf_security'); ?>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
