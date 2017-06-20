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

class wptsafExtensionFileChangeAjaxHandle extends wptsafAbstractExtensionAjaxHandle{

	public function __construct(wptsafAbstractExtension $extension){
		parent::__construct($extension);

		$this->logHeader = array(
			'date_gmt' => __('Date', 'wptsaf_security'),
			'added' => __('Added', 'wptsaf_security'),
			'removed' => __('Removed', 'wptsaf_security'),
			'changed' => __('Changed', 'wptsaf_security')/*,
			'probably_infected' => __('Probably Infected', 'wptsaf_security')*/
		);
	}

	public function settings(){
		$view = new wptsafView();
		$response = $view->content(
			$this->extension->getExtensionDir() . 'template/settings.php',
			array(
				'extensionTitle' => $this->extension->getTitle(),
				'frequencyRunning' => $this->extension->getSettings()->getFrequencyRunning(),
				'errors' => array(),
				'settings' => $this->extension->getSettings()->get()
			)
		);
		$this->response->setResponse($response);

		$this->response->addJsCallback('wptsafCallback.popupShowContent');

		return $this->response;
	}

	public function settingsSave(){
		$validator = wptsafValidator::getInstance();
		$settings = $this->extension->getSettings();
		$request = array();
		$errors = array();

		$request['is_enabled'] = isset($_POST['is_enabled'])
			? ((bool)$_POST['is_enabled'])
			: false;

		$request['log_rotation'] = is_numeric($_POST['log_rotation'])
			? intval($_POST['log_rotation'])
			: strip_tags($_POST['log_rotation']);
		$errors['log_rotation'] = $validator->validate('log_rotation', $request['log_rotation']);

		$request['file_dir_list_required'] = $settings->get('file_dir_list_required');

		$request['frequency_running'] = isset($_POST['frequency_running'])
			? strip_tags($_POST['frequency_running'])
			: false;

		$request['time_running']['h'] = isset($_POST['time_running']['h']) && is_numeric($_POST['time_running']['h'])
			? intval($_POST['time_running']['h'])
			: 0;
		$request['time_running']['m'] = isset($_POST['time_running']['m']) && is_numeric($_POST['time_running']['m'])
			? intval($_POST['time_running']['m'])
			: 0;

		$request['file_dir_list'] = isset($_POST['file_dir_list'])
			? strip_tags($_POST['file_dir_list'])
			: '';
		$request['file_dir_list'] = explode("\n", $request['file_dir_list']);
		foreach ($request['file_dir_list'] as $i => $row) {
			$request['file_dir_list'][$i] = str_replace('\\', '/', stripslashes(trim($row)));
		}
		$errors['file_dir_list'] = $validator->validate('file_dir_list', $request['file_dir_list']);

		$request['ignore_file_types'] = isset($_POST['ignore_file_types'])
			? strip_tags($_POST['ignore_file_types'])
			: '';
		$request['ignore_file_types'] = array_map('trim', explode("\n", $request['ignore_file_types']));
		$errors['ignore_file_types'] = $validator->validate('ignore_file_types', $request['ignore_file_types']);

		$errors = array_filter($errors);
		if (empty($errors)) {
			$request['file_dir_list'] = array_filter($request['file_dir_list']);
			$request['ignore_file_types'] = array_filter($request['ignore_file_types']);
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
				'frequencyRunning' => $this->extension->getSettings()->getFrequencyRunning(),
				'errors' => $errors,
				'settings' => $request
			)
		);
		$this->response->setResponse($response);

		if (empty($errors)) {
			$this->response->addMessage(__('Settings are updated', 'wptsaf_security'), wptsafAjaxResponse::MESSAGE_TYPE_SUCCESS);
			$this->response->addJsCallback(['wptsafCallback.updateWidget', $this->extension->getName()]);
			$this->response->addJsCallback('wptsafCallback.popupHide');
		} else {
			$this->response->addJsCallback('wptsafCallback.popupShowContent');
		}

		return $this->response;
	}

	public function scanProcessState(){
		$view = new wptsafView();
		/** @var wptsafExtensionFileChangeCron $cron */
		$cron = $this->extension->getCron();
		$scanProcessState = $cron->getScanProcessState();
		$method = isset($scanProcessState['method']) ? $scanProcessState['method'] : null;
		$state = '';

		switch ($method) {
			case 'runScanCollectFiles':
				$state = sprintf(
					__('Collect files in %d of %d directories', 'wptsaf_security'),
					$scanProcessState['params']['offset']
						? $scanProcessState['params']['offset']
						: wptsafExtensionFileChangeScanner::SCAN_DIRECTORIES_LIMIT,
					$scanProcessState['directoriesAmount']

				);
				break;
			
			case 'runScanBuildChanges':
				$state = __('Building changes', 'wptsaf_security');
				break;
			
			case 'addedFilesScanMalware':
				if ($scanProcessState['filesAmount']) {
					$state = sprintf(
						__('Scan added files %d of %d for malware', 'wptsaf_security'),
						$scanProcessState['params']['offset']
							? $scanProcessState['params']['offset']
							: wptsafExtensionFileChangeScanner::SCAN_DIRECTORIES_LIMIT,
						$scanProcessState['filesAmount']
					);
				} else {
					$state = __('Scan added files for malware', 'wptsaf_security');
				}

				break;

			case 'changedFilesScanMalware':
				if ($scanProcessState['filesAmount']) {
					$state = sprintf(
						__('Scan changed files %d of %d for malware', 'wptsaf_security'),
						$scanProcessState['params']['offset']
							? $scanProcessState['params']['offset']
							: wptsafExtensionFileChangeScanner::SCAN_DIRECTORIES_LIMIT,
						$scanProcessState['filesAmount']
					);
				} else {
					$state = __('Scan changed files for malware', 'wptsaf_security');
				}
				break;
			
			case 'runScanBuildResult':
				$state = __('Building scan result', 'wptsaf_security');
				break;
			
			default:
				$state = __('Scan file changes is not running');
		}

		$response = $view->content(
			$this->extension->getExtensionDir() . 'template/scan-proccess-state.php',
			array(
				'extensionTitle' => $this->extension->getTitle(),
				'state' => $state
			)
		);

		$this->response->setResponse($response);
		$this->response->addJsCallback('wptsafCallback.dialogShowContent');

		return $this->response;
	}

	public function logRow($id){
		$row = $this->extension->getLog()->getRow($id);
		$scanner = new wptsafExtensionFileChangeScanner($this->extension);
		$view = new wptsafView();

		if (is_wp_error($row)) {
			$this->response->addError($row);
			return $this->response;
		}

		$row['change_list'] = $scanner->getChangeList($row['change_list']);
		$response = $view->content(
			$this->extension->getExtensionDir() . 'template/log-row.php',
			array(
				'extensionName' => $this->extension->getName(),
				'extensionTitle' => $this->extension->getTitle(),
				'header' => $this->logRowHeader,
				'row' => $row
			)
		);
		$this->response->setResponse($response);
		$this->response->addJsCallback('wptsafCallback.formShowContent');

		return $this->response;
	}

	public function scan(){
		$view = new wptsafView();
		
		$response = $view->content(
			$this->extension->getExtensionDir() . 'template/scan.php',
			array(
				'extensionTitle' => $this->extension->getTitle(),
			)
		);

		$this->response->setResponse($response);
		$this->response->addJsCallback('wptsafCallback.popupShowContent');

		return $this->response;
	}


	public function collectDirectories(){
		$scanner = new wptsafExtensionFileChangeScanner($this->extension);

		$scanner->deleteCollectedDirectories();
		$scanner->deleteCollectedFiles();
		$scanner->deleteScanResult();

		$this->response->setResponse(array(
			'directoriesAmount' => count($scanner->collectDirectories()),
		));

		return $this->response;
	}
	
	public function collectFiles($limit, $offset){
		$scanner = new wptsafExtensionFileChangeScanner($this->extension);
		$scanner->collectFiles(absint($limit), absint($offset));

		return $this->response;
	}

	public function scanBuildChanges(){
		$scanner = new wptsafExtensionFileChangeScanner($this->extension);
		$scanResult = $scanner->scanBuildChanges();

		$this->response->setResponse(array(
			'scanResult' => array(
				'added' => $scanResult['added'],
				'changed' => $scanResult['changed']
			)
		));

		return $this->response;
	}

	public function addedFilesScanMalware($limit, $offset){
		$scanner = new wptsafExtensionFileChangeScanner($this->extension);
		$scanner->addedFilesScanMalware(absint($limit), absint($offset));

		return $this->response;
	}

	public function changedFilesScanMalware($limit, $offset){
		$scanner = new wptsafExtensionFileChangeScanner($this->extension);
		$scanner->changedFilesScanMalware(absint($limit), absint($offset));

		return $this->response;
	}

	public function sendFilesToMalwareScannerExtension(){
		$scanner = new wptsafExtensionFileChangeScanner($this->extension);
		$scanner->sendFilesToMalwareScannerExtension();
		return $this->response;
	}

	public function scanBuildResult(){
		$view = new wptsafView();
		$scanner = new wptsafExtensionFileChangeScanner($this->extension);
		$response = $view->content(
			$this->extension->getExtensionDir() . 'template/log-row.php',
			array(
				'extensionTitle' => $this->extension->getTitle(),
				'row' => $scanner->getScanResult(),
			)
		);
		
		$scanner->logScanResult();
		
		$this->response->setResponse($response);
		$this->response->addJsCallback('wptsafCallback.popupShowContent');
		$this->response->addJsCallback(array('wptsafCallback.updateWidget', $this->extension->getName()));

		return $this->response;
	}
}
