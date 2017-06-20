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

class wptsafExtensionAutoUpdateAjaxHandle extends wptsafAbstractExtensionAjaxHandle{

	public function settingsSave(){
		$settings = $this->extension->getSettings();
		$request = array();

		$request['is_update_core'] = isset($_POST['is_update_core'])
			? ((bool)$_POST['is_update_core'])
			: false;

		$request['is_update_plugins'] = isset($_POST['is_update_plugins'])
			? ((bool)$_POST['is_update_plugins'])
			: false;

		$request['is_update_themes'] = isset($_POST['is_update_themes'])
			? ((bool)$_POST['is_update_themes'])
			: false;

		foreach ($request as $field => $value) {
			$settings->set($field, $value);
		}
		$settings->save();
		$request = $settings->get();

		$view = new wptsafView();
		$response = $view->content(
			$this->extension->getExtensionDir() . 'template/settings.php',
			array(
				'extensionTitle' => $this->extension->getTitle(),
				'settings' => $request
			)
		);
		$this->response->setResponse($response);
		$this->response->addMessage(__('Settings are updated', 'wptsaf_security'), wptsafAjaxResponse::MESSAGE_TYPE_SUCCESS);
		$this->response->addJsCallback(['wptsafCallback.updateWidget', $this->extension->getName()]);
		$this->response->addJsCallback('wptsafCallback.popupHide');

		return $this->response;
	}
}
