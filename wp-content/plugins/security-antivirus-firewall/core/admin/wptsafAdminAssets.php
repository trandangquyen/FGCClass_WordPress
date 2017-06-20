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

class wptsafAdminAssets{

	protected $allowScreens = array(
		wptsafAdminPageExtensions::MENU_SLUG,
		wptsafAdminPageSettings::MENU_SLUG,
		wptsafAdminPageMalwareScanner::MENU_SLUG,
	);

	protected $isAllowScreen;

	public function __construct(){
		add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
		add_filter('admin_body_class', array($this, 'adminBodyClass'));
	}

	public function enqueueScripts(){

		wp_enqueue_style('wptsaf-allpages-css', 	WPTSAF_URL . 'assets/dist/css/wpsaf.allpages.css', array(), 1);

		if (!$this->isAllowScreen()) {
			return;
		}


	   /*wp_deregister_script('jquery');
	   wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js", false, null);
	   wp_enqueue_script('jquery');*/


		wp_enqueue_style('wptsafVendor-css', 		WPTSAF_URL . 'assets/dist/css/vendor.css', array(), 1);
		wp_enqueue_style('wptsafPlugin-css', 		WPTSAF_URL . 'assets/dist/css/plugin.css', array(), 1);
		wp_enqueue_style('wptsafPlugin-custom-css', WPTSAF_URL . 'assets/dist/css/custom.css', array(), 1);

		wp_enqueue_script('wptsafVendor-js', 		WPTSAF_URL . 'assets/dist/js/vendor.js', array('jquery'), false, true);
		wp_enqueue_script('wptsafPlugin-js', 		WPTSAF_URL . 'assets/dist/js/plugin.js', array('jquery'), false, true);
		wp_enqueue_script('wptsafPlugin-mnr-js', 	WPTSAF_URL . 'assets/dist/js/masonry.pkgd.min.js', array('jquery'), false, true);

		wp_localize_script( 'wptsafPlugin-js', 'wptsafSecurity', array(
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'ajaxNonce' => wp_create_nonce(WPTSAF_NONCE),
			'translations' => array(
				'ajax_invalid' => 		__('An "invalid format" error prevented the request from completing as expected. The format of data returned could not be recognized. This could be due to a plugin/theme conflict or a server configuration issue.', 'wptsaf_security'),
				'ajax_forbidden' => 	__('A "request forbidden" error prevented the request from completing as expected. The server returned a 403 status code, indicating that the server configuration is prohibiting this request. This could be due to a plugin/theme conflict or a server configuration issue. Please try refreshing the page and trying again. If the request continues to fail, you may have to alter plugin settings or server configuration that could account for this AJAX request being blocked.', 'wptsaf_security'),
				'ajax_not_found' => 	__('A "not found" error prevented the request from completing as expected. The server returned a 404 status code, indicating that the server was unable to find the requested admin-ajax.php file. This could be due to a plugin/theme conflict, a server configuration issue, or an incomplete WordPress installation. Please try refreshing the page and trying again. If the request continues to fail, you may have to alter plugin settings, alter server configurations, or reinstall WordPress.', 'wptsaf_security'),
				'ajax_server_error' => 	__('A "internal server" error prevented the request from completing as expected. The server returned a 500 status code, indicating that the server was unable to complete the request due to a fatal PHP error or a server problem. This could be due to a plugin/theme conflict, a server configuration issue, a temporary hosting issue, or invalid custom PHP modifications. Please check your server\'s error logs for details about the source of the error and contact your hosting company for assistance if required.', 'wptsaf_security'),
				'ajax_unknown' => 		__('An unknown error prevented the request from completing as expected. This could be due to a plugin/theme conflict or a server configuration issue.', 'wptsaf_security'),
				'ajax_timeout' => 		__('A timeout error prevented the request from completing as expected. The site took too long to respond. This could be due to a plugin/theme conflict or a server configuration issue.', 'wptsaf_security'),
				'ajax_parsererror' => 	__('A parser error prevented the request from completing as expected. The site sent a response that jQuery could not process. This could be due to a plugin/theme conflict or a server configuration issue.', 'wptsaf_security'),
			),
			'daterangepicker' => array(
				'settings' => array(
					'format' => WPTSAF_DATE_FORMAT_DATEPICKER,
					'locale' => array(
						'applyLabel' => 	__('Apply', 'wptsaf_security'),
		                'cancelLabel' => 	__('Cancel', 'wptsaf_security'),
		                'fromLabel' => 		__('From', 'wptsaf_security'),
		                'toLabel' => 		__('To', 'wptsaf_security'),
		                'customRangeLabel' => __('Custom', 'wptsaf_security'),
		                'weekLabel' => 		__('W', 'wptsaf_security'),
		                'daysOfWeek' => array(
			                __('Su', 'wptsaf_security'),
			                __('Mo', 'wptsaf_security'),
			                __('Tu', 'wptsaf_security'),
			                __('We', 'wptsaf_security'),
			                __('Th', 'wptsaf_security'),
			                __('Fr', 'wptsaf_security'),
			                __('Sa', 'wptsaf_security')
		                ),
						'monthNames' => array(
							__('January', 'wptsaf_security'),
							__('February', 'wptsaf_security'),
							__('March', 'wptsaf_security'),
							__('April', 'wptsaf_security'),
							__('May', 'wptsaf_security'),
							__('June', 'wptsaf_security'),
							__('July', 'wptsaf_security'),
							__('August', 'wptsaf_security'),
							__('September', 'wptsaf_security'),
							__('October', 'wptsaf_security'),
							__('November', 'wptsaf_security'),
							__('December', 'wptsaf_security'),
						),
		                'firstDay' => 1
					)
				)
			)
		));
	}

	public function adminBodyClass($classes){
		if ($this->isAllowScreen()) {
			$classes .= ' ' . WPTSAF_BODY_CLASS;;
		}
		return $classes;
	}

	protected function isAllowScreen(){
		if (null === $this->isAllowScreen) {
			$this->isAllowScreen = false;
			$screen = get_current_screen();
			foreach ($this->allowScreens as $allowScreen) {
				if (false !== strpos($screen->base, $allowScreen)) {
					$this->isAllowScreen = true;
					break;
				}
			}
		}

		return $this->isAllowScreen;
	}
}
