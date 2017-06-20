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

?><div class="row detection-404-enable-dialog">
	<div class="col-md-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?php echo $extensionTitle; ?></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="alert alert-info alert-dismissible fade in" >
					<h2>
						<?php echo $extensionTitle . ' ' . __('is enabled', 'wptsaf_security'); ?>
					</h2>
				</div>
				<br />
				<div>
					<?php _e('Please make sure that .htaccess contains this settings:', 'wptsaf_security'); ?>
				</div>
				<br/>
<?php if (is_multisite()) : ?>
<textarea rows="17">
	# BEGIN SAF: 404 Detection
	&lt;IfModule mod_rewrite.c&gt;
	    RewriteEngine On
	    RewriteBase /

	    RewriteCond %{REQUEST_FILENAME} -d
	    RewriteCond %{REQUEST_FILENAME}/index\.php !-f
	    RewriteCond %{REQUEST_FILENAME}/index\.html !-f
	    RewriteRule . index.php [L]

	    RewriteCond %{REQUEST_FILENAME} !-d
	    RewriteCond %{REQUEST_FILENAME} !-f
	    RewriteRule . index.php [L]
	&lt;/IfModule&gt;
	# END SAF: 404 Detection
</textarea>
<?php else : ?>
<textarea rows="12">
	# BEGIN SAF: 404 Detection
	&lt;IfModule mod_rewrite.c&gt;
		RewriteEngine On
		RewriteBase /
		RewriteCond %{REQUEST_FILENAME} -d
		RewriteCond %{REQUEST_FILENAME}/index\.php !-f
		RewriteCond %{REQUEST_FILENAME}/index\.html !-f
		RewriteRule . index.php [L]
	&lt;/IfModule&gt;
	# END SAF: 404 Detection
</textarea>
<?php endif; ?>
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
