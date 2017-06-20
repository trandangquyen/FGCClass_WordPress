<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>
					<?php echo __('Step', 'wpsaf_security').' 3 : '.$extensionTitle.__(' Wizard', 'wpsaf_security'); ?>
				</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div  style="max-width: 600px;">
					<p>
						<?php _e("Pay attention to Google reCaptcha module. You can enable and configure it in S.A.F. modules section. When you enable Google reCaptcha make sure that you define google key in settings section.", 'wpsaf_security'); ?>
					</p>
				</div>

				<div class="clear"></div>

				<div class="ln_solid"></div>
				<div class="buttons">
					<button class="btn btn-default pull-right" data-action="action=wptsaf_security&extension=wptsaf-security&method=hideWizard&args[type]=1">
						<?php _e('Finish', 'wpsaf_security'); ?>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
