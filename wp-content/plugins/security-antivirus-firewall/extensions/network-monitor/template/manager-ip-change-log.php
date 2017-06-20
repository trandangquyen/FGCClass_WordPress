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
?>
<table class="log table table-striped table-bordered">
	<thead>
		<tr>
			<?php foreach ($header as $title) : ?>
				<th>
					<?php echo __($title, 'wptsaf_security'); ?>
				</th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php $columns = array_keys($header); ?>
		<?php foreach ($rows as $row) : ?>
			<tr>
				<?php foreach ($columns as $column) : ?>
					<td class="pre"><?php echo $row[$column]; ?></td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
