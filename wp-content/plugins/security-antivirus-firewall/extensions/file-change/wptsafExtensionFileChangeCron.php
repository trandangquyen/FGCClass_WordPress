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

class wptsafExtensionFileChangeCron extends wptsafExtensionCron{

	protected $hookNameRunScan;

	protected $hookNameRunScanProcess;

	protected $optionKeyRunScanProcess;

	public function __construct(wptsafAbstractExtension $extension){
		parent::__construct($extension);

		$this->hookNameRunScan = $this->generateHookName('run_scan');
		add_action($this->hookNameRunScan, array($this, 'runScan'));

		$this->optionKeyRunScanProcess = $this->generateHookName('run_scan_process');
		$this->hookNameRunScanProcess = $this->generateHookName('run_scan_process');
		add_action($this->hookNameRunScanProcess, array($this, 'runScanProcess'));
	}

	function initSchedule(){
		parent::initSchedule();

		$settings = $this->extension->getSettings();
		$this->addScheduleSingleEvent(
			$this->hookNameRunScan,
			$settings->get('frequency_running'),
			$settings->get('time_running/h'),
			$settings->get('time_running/m')
		);
	}

	public function clearSchedule(){
		parent::clearSchedule();

		wp_clear_scheduled_hook($this->hookNameRunScan);

		delete_site_option($this->optionKeyRunScanProcess);
		wp_clear_scheduled_hook($this->hookNameRunScanProcess);
	}


	public function runScan(){
		// set next schedule event
		$this->addScheduleSingleEvent(
			$this->hookNameRunScan,
			$this->extension->getSettings()->get('frequency_running'),
			null,
			$this->extension->getSettings()->get('time_running/m')
		);

		$processState = get_site_option($this->optionKeyRunScanProcess);
		if (false === $processState) {
			do_action($this->hookNameRunScanProcess);
		}
	}

	public function runScanProcess(){
		$this->addScheduleSingleEvent($this->hookNameRunScanProcess, '1SEC');

		$processState = get_site_option($this->optionKeyRunScanProcess);
		if (!$processState) {
			$processState = array(
				'is_run' => false,
				'method' => 'runScanCollectDirectories',
				'params' => array()
			);
		}

		if ($processState['is_run']) {
			return;
		}

		$reflection = new \ReflectionClass($this);
		$method = $reflection->getMethod($processState['method']);
		$params = [];
		foreach ($method->getParameters() as $param) {
			/** @var ReflectionParam $param */
			if (isset($processState['params'][$param->name])) {
				$params[$param->name] = $processState['params'][$param->name];
			}
		}

		$processState['is_run'] = true;
		update_site_option($this->optionKeyRunScanProcess, $processState);
		$method->invokeArgs($this, $params);
		
		$processState = get_site_option($this->optionKeyRunScanProcess);
		if ($processState) {
			$processState['is_run'] = false;
			update_site_option($this->optionKeyRunScanProcess, $processState);
		}
	}

	public function runScanCollectDirectories(){
		$scanner = $this->getScanner();

		$scanner->deleteCollectedDirectories();
		$scanner->deleteCollectedFiles();

		$directoriesAmount = count($scanner->collectDirectories());

		$processState = array(
			'method' => 'runScanCollectFiles',
			'params' => array(
				'limit' => wptsafExtensionFileChangeScanner::SCAN_DIRECTORIES_LIMIT,
				'offset' => 0
			),
			'directoriesAmount' => $directoriesAmount
		);
		update_site_option($this->optionKeyRunScanProcess, $processState);
	}

	public function runScanCollectFiles($limit, $offset){
		$scanner = $this->getScanner();
		$directoriesAmount = count($scanner->getCollectedDirectories());
		$processDirectoriesLimit = absint($limit);
		$processDirectoriesOffset = absint($offset);

		$scanner->collectFiles($processDirectoriesLimit, $processDirectoriesOffset);

		$processDirectoriesOffset += $processDirectoriesLimit;
		if ($processDirectoriesOffset < $directoriesAmount) {
			$processState = array(
				'method' => 'runScanCollectFiles',
				'params' => array(
					'limit' => $processDirectoriesLimit,
					'offset' => $processDirectoriesOffset
				),
				'directoriesAmount' => $directoriesAmount
			);
		} else {
			$processState = array(
				'method' => 'runScanBuildChanges',
				'params' => array()
			);
		}
		update_site_option($this->optionKeyRunScanProcess, $processState);
	}


	public function runScanBuildChanges(){
		$scanner = $this->getScanner();
		$scanner->scanBuildChanges();
		$scanResult = $scanner->getScanResult();

		$processState = array(
			'method' => 'addedFilesScanMalware',
			'params' => array(
				'limit' => wptsafExtensionFileChangeScanner::SCAN_FILE_MALWARE_LIMIT,
				'offset' => 0
			),
			'filesAmount' => count($scanResult['change_list']['added'])
		);
		update_site_option($this->optionKeyRunScanProcess, $processState);
	}


	public function addedFilesScanMalware($limit, $offset){
		$scanner = $this->getScanner();
		$scanner->addedFilesScanMalware(absint($limit), absint($offset));
		$scanResult = $scanner->getScanResult();
		$filesAmount = count($scanResult['change_list']['added']);

		$offset += $limit;
		if ($offset < $filesAmount) {
			$processState = array(
				'method' => 'addedFilesScanMalware',
				'params' => array(
					'limit' => $limit,
					'offset' => $offset
				),
				'filesAmount' => $filesAmount
			);
		} else {
			$processState = array(
				'method' => 'changedFilesScanMalware',
				'params' => array(
					'limit' => wptsafExtensionFileChangeScanner::SCAN_FILE_MALWARE_LIMIT,
					'offset' => 0
				),
				'filesAmount' => count($scanResult['change_list']['changed'])
			);
		}
		update_site_option($this->optionKeyRunScanProcess, $processState);
	}


	public function changedFilesScanMalware($limit, $offset){
		$scanner = $this->getScanner();
		$scanner->changedFilesScanMalware(absint($limit), absint($offset));
		$scanResult = $scanner->getScanResult();
		$filesAmount = count($scanResult['change_list']['changed']);

		$offset += $limit;
		if ($offset < $filesAmount) {
			$processState = array(
				'method' => 'changedFilesScanMalware',
				'params' => array(
					'limit' => $limit,
					'offset' => $offset
				),
				'filesAmount' => $filesAmount
			);
		} else {
			$processState = array(
				'method' => 'sendFilesToMalwareScannerExtension',
				'params' => array()
			);
		}
		update_site_option($this->optionKeyRunScanProcess, $processState);
	}

	public function sendFilesToMalwareScannerExtension(){
		$scanner = $this->getScanner();
		$scanner->sendFilesToMalwareScannerExtension();

		$processState = array(
			'method' => 'runScanBuildResult',
			'params' => array()
		);
		update_site_option($this->optionKeyRunScanProcess, $processState);
	}


	public function runScanBuildResult(){
		$scanner = $this->getScanner();
		$scanner->logScanResult();

		delete_site_option($this->optionKeyRunScanProcess);
		wp_clear_scheduled_hook($this->hookNameRunScanProcess);
		do_action('wptsaf_security_file_change_scan_run', $this->extension);
	}


	public function getScanner(){
		return new wptsafExtensionFileChangeScanner($this->extension, 'cron');
	}


	public function getScanProcessState(){
		return get_site_option($this->optionKeyRunScanProcess);
	}
}
