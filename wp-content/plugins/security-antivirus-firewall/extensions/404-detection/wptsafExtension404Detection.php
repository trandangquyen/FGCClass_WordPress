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

class wptsafExtension404Detection extends wptsafAbstractExtension{
	const TYPE_404_DIR = 'dir';
	const TYPE_404_FILE = 'file';
	const TYPE_404_PAGE = 'page';

	protected static $instance;

	public function __construct(){
		$this->name = '404-detection';
		$this->title = __('404 Detection', 'wptsaf_security');
		$this->description = __("Hackers are always looking for vulnerabilities on your site that can be exploited. Some of these vulnerabilities can be found by scanning of the content on the front end of the website. Such links research will be detected by 404 detector module. Here you'll see list of such action and you get access to ban tools.", 'wptsaf_security');
		parent::__construct();
	}

	public static function getInstance(){
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function init(){
		parent::init();
		add_action('wp_head', array($this, 'check404'));
	}

	public function check404() {
		if (!is_404()){
			return;
		}

		$url = wptsafEnv::getInstance()->getUrl();
		$type = null;

		if (preg_match('/\.[a-z0-9]+$/', $url)) {
			$type = self::TYPE_404_FILE;
		}

		if (!$type) {
			$filePath = rtrim(ABSPATH) . $url;
			if (is_dir($filePath)) {
				$type = self::TYPE_404_DIR;
			}
		}

		if (!$type) {
			$type = self::TYPE_404_PAGE;
		}

		$this->log->insertRow(array(
			'type' => $type
		));
	}
}
