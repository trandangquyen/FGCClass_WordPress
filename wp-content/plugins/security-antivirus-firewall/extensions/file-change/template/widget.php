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
		        data-action="action=wptsaf_security&extension=file-change&method=setEnable&args[isEnabled]=<?php echo $isEnabled ? 0 : 1; ?>">
			<?php 
				if($isEnabled){
					echo __('Deactivate', 'wptsaf_security');
				} else {
					echo __('Activate', 'wptsaf_security');
				}
			?>
		</button>
		<button class="btn btn-default btn-xs" type="button"
		        data-action="action=wptsaf_security&extension=file-change&method=settings">
			<?php echo __('Settings', 'wptsaf_security'); ?>
		</button>
		<button class="btn btn-default btn-xs" type="button"
		        data-action="action=wptsaf_security&extension=file-change&method=scanProcessState">
			<?php echo __('Cron Scan Process State', 'wptsaf_security'); ?>
		</button>
	</h2>
	<div class="clearfix"></div>
</div>

<div class="x_content">
	<p>
		<?php echo $description; ?>
	</p>

	<div class="alert alert-success alert-dismissible wpsaf_nobottom">
		<strong><?php echo __('Files changes monitoring', 'wptsaf_security'); ?></strong>
	</div>
	
	<table class="table table-hover">
		<thead>
		<tr>
			<?php foreach ($logHeader as $title) : ?>
				<th>
					<?php echo $title; ?>
				</th>
			<?php endforeach; ?>
		</tr>
		</thead>
		<tbody>
		<?php $columns = array_keys($logHeader); ?>
		<?php foreach ($rows as $row) : ?>
			<tr data-action="action=wptsaf_security&extension=file-change&method=logRow&args[id]=<?php echo $row['id']; ?>">
				<?php foreach ($columns as $column) : ?>
					<td><?php echo $row[$column]; ?></td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>


	<div class="buttons">
		<button class="btn btn-info col-md-4 col-sm-4 col-md-offset-1" type="button"
		        data-action="action=wptsaf_security&extension=file-change&method=log">
			<?php _e('Detailed log', 'wptsaf_security'); ?>
		</button>

		<button class="btn btn-info col-md-4 col-sm-4 col-md-offset-1" type="button"
		        data-action="action=wptsaf_security&extension=file-change&method=scan">
			<?php _e('Scan', 'wptsaf_security'); ?>
		</button>
	</div>
</div>
