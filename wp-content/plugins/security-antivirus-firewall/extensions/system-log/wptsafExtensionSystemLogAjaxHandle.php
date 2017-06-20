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


class wptsafExtensionSystemLogAjaxHandle extends wptsafAbstractExtensionAjaxHandle{

	public function __construct(wptsafAbstractExtension $extension){
		parent::__construct($extension);

		$this->logHeader = array(
			'date_gmt' 	=> __('Date', 'wptsaf_security'),
			'username' 	=> __('Username', 'wptsaf_security'),
			'extension' => __('Extension', 'wptsaf_security'),
			'message' 	=> __('Message', 'wptsaf_security'),
			'type' 		=> __('Type', 'wptsaf_security')
		);

		$this->logRowHeader = array(
			'date_gmt' 	=> __('Date', 'wptsaf_security'),
			'username' 	=> __('Username', 'wptsaf_security'),
			'extension' => __('Extension', 'wptsaf_security'),
			'message' 	=> __('Message', 'wptsaf_security'),
			'type' 		=> __('Type', 'wptsaf_security')
		);
	}


	public function settingsSave(){
		$validator = wptsafValidator::getInstance();
		$settings = $this->extension->getSettings();
		$request = array();
		$errors = array();
		
		$request['log_rotation'] = is_numeric($_POST['log_rotation'])
			? intval($_POST['log_rotation'])
			: strip_tags($_POST['log_rotation']);
		$errors['log_rotation'] = $validator->validate('log_rotation', $request['log_rotation']);

		$errors = array_filter($errors);
		if (empty($errors)) {
			foreach ($request as $field => $value) {
				$settings->set($field, $value);
			}
			$settings->save();
			$request = $settings->get();
		}

		$view = new wptsafView();
		$response = $view->content(
			$this->extension->getExtensionDir() . 'template/settings.php',
			array(
				'extensionTitle' => $this->extension->getTitle(),
				'errors' => $errors,
				'settings' => $request
			)
		);
		$this->response->setResponse($response);

		if (empty($errors)) {
			$this->response->addMessage(__('Settings are updated', wptsafAjaxResponse::MESSAGE_TYPE_SUCCESS));
			$this->response->addJsCallback(['wptsafCallback.updateWidget', $this->extension->getName()]);
			$this->response->addJsCallback('wptsafCallback.popupHide');
		} else {
			$this->response->addJsCallback('wptsafCallback.popupShowContent');
		}
		return $this->response;
	}


	public function addMessage($message, $type = 'danger'){
		$this->extension->getLog()->insertRow(array(
			'extension' => wptsafSecurity::getInstance()->getTitle(),
			'message' => (string)$message,
			'type' => strip_tags($type)
		));
	}
}
