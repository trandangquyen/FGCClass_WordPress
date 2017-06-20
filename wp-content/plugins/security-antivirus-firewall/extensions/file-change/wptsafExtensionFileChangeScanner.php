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

class wptsafExtensionFileChangeScanner {
	const SCAN_DIRECTORIES_LIMIT = 100;
	const SCAN_FILE_MALWARE_LIMIT = 500;

	protected $extension;
	protected $fileDirList;
	protected $ignoreFileTypes;
	protected $pathFileList;
	protected $dirLog;
	protected $dirProcess;
	protected $uname;
	protected $pathCollectedDirectories;
	protected $pathCollectedFiles;
	protected $pathScanResult;
	protected $collectedDirectories;

	public function __construct(wptsafAbstractExtension $extension, $uname = 'manual') {
		$this->extension = $extension;
		$this->fileDirList = array_merge(
			$this->extension->getSettings()->get('file_dir_list_required'),
			$this->extension->getSettings()->get('file_dir_list')
		);
		$this->ignoreFileTypes = $this->extension->getSettings()->get('ignore_file_types');

		$extensionDir = WPTSAF_DIR . $this->extension->getExtensionDir();
		$this->pathFileList = $extensionDir . 'scan/file-list.data';
		$this->dirLog = $extensionDir . 'scan/log/';
		$this->uname = basename($uname);
		$this->dirProcess = $extensionDir . "scan/process/{$this->uname}/";
		$this->pathCollectedDirectories = $this->dirProcess . 'collected-directories.data';
		$this->pathCollectedFiles = $this->dirProcess . 'collected-files.data';
		$this->pathScanResult = $this->dirProcess . 'scan-result.data';

		if (!file_exists($this->dirProcess) && !mkdir($this->dirProcess, 0755)) {
			throw new Exception(__('Cannot make scan process directory', 'wptsaf_security'));
		}
	}

	protected function saveFileList(array $files){
		return file_put_contents($this->pathFileList, serialize($files));
	}

	protected function getFileList(){
		$files = null;

		if (file_exists($this->pathFileList)) {
			$files = file_get_contents($this->pathFileList);
			$files = unserialize($files);
		}

		return is_array($files) ? $files : array();
	}


	protected function saveCollectedDirectories(array $directories){
		return file_put_contents($this->pathCollectedDirectories, serialize($directories));
	}

	public function getCollectedDirectories(){
		$directories = null;

		if (file_exists($this->pathCollectedDirectories)) {
			$directories = file_get_contents($this->pathCollectedDirectories);
			$directories = unserialize($directories);
		}

		return is_array($directories) ? $directories : array();
	}

	public function deleteCollectedDirectories(){
		if (file_exists($this->pathCollectedDirectories)) {
			unlink($this->pathCollectedDirectories);
		}
	}

	protected function saveCollectedFiles(array $files)
	{
		return file_put_contents($this->pathCollectedFiles, serialize($files));
	}

	public function getCollectedFiles(){
		$files = null;

		if (file_exists($this->pathCollectedFiles)) {
			$files = file_get_contents($this->pathCollectedFiles);
			$files = unserialize($files);
		}

		return is_array($files) ? $files : array();
	}

	public function deleteCollectedFiles(){
		if (file_exists($this->pathCollectedFiles)) {
			unlink($this->pathCollectedFiles);
		}
	}

	protected function saveScanResult(array $result){
		return file_put_contents($this->pathScanResult, serialize($result));
	}

	public function getScanResult(){
		$result = null;

		if (file_exists($this->pathScanResult)) {
			$result = file_get_contents($this->pathScanResult);
			$result = unserialize($result);
		}

		return is_array($result) ? $result : array();
	}

	public function deleteScanResult(){
		if (file_exists($this->pathScanResult)) {
			unlink($this->pathScanResult);
		}
	}

	public function logScanResult(){
		$time = date('Ymd-His', wptsafEnv::getInstance()->getDateGmt());
		$rand = substr(md5(mt_rand()), 0, 5);
		$fileChangeList = "{$time}-{$this->uname}-{$rand}.data";

		$this->saveFileList($this->getCollectedFiles());

		$result = $this->getScanResult();
		$this->saveChangeList($fileChangeList, $result['change_list']);
		$result['change_list'] = $fileChangeList;
		$this->extension->getLog()->insertRow($result);

		$this->deleteCollectedDirectories();
		$this->deleteCollectedFiles();
		$this->deleteScanResult();
	}


	protected function saveChangeList($fileChangeList, array $changeList){
		if (!file_put_contents($this->dirLog . $fileChangeList, serialize($changeList))) {
			throw new Exception(__('Cannot save scan change list', 'wptsaf_security'));
		};
	}

	public function getChangeList($fileChangeList){
		$pathChangeList = $this->dirLog . $fileChangeList;
		$changeList = null;

		if (!file_exists($pathChangeList)) {
			throw new Exception(__('Not found scan change list', 'wptsaf_security'));
		}
		$changeList = unserialize(file_get_contents($pathChangeList));

		return is_array($changeList) ? $changeList : array();
	}

	public function collectDirectories() {
		$this->collectedDirectories = array();
		$fileDirList = array();

		foreach (array_unique($this->fileDirList) as $item) {
			$nesting = count(array_filter(explode('/', $item)));
			$md5 = md5($item);
			$fileDirList["{$nesting}-{$md5}"] = $item;
		}
		ksort($fileDirList);

		wptsafEnv::getInstance()->setMinimumMemoryLimit('256M');
		foreach ($fileDirList as $relativePath) {
			$this->collectDirectoriesByPath($relativePath);
		}
		$this->saveCollectedDirectories($this->collectedDirectories);

		return $this->collectedDirectories;
	}

	protected function collectDirectoriesByPath($relativePath) {
		$relativePath = '/' . trim($relativePath, '/');
		$absPath = ABSPATH . trim($relativePath, '/');

		if (is_file($absPath)) {
			return;
		}
		if (in_array($relativePath, $this->collectedDirectories)) {
			return;
		}

		$this->collectedDirectories[] = $relativePath;

		$directoryHandle = opendir($absPath);
		if (!$directoryHandle) {
			wptsafExtensionSystemLog::getInstance()->getLog()->addDangerMessage(
				$this->extension,
				sprintf(__('Could not open directory "%s"', 'wptsaf_security'), $relativePath)
			);
			return;
		}

		while (false !== ($item = readdir($directoryHandle))) {
			if ( '.' == $item || '..' == $item ) {
				continue;
			}

			$relativeItemPath = $relativePath . '/' . $item;
			$absItemPath = ABSPATH . trim($relativeItemPath, '/');

			if (is_dir($absItemPath) && 'dir' == filetype($absItemPath)) {
				$this->collectDirectoriesByPath($relativeItemPath);
			}
		}
		closedir($directoryHandle);

		$this->collectedDirectories = array_unique($this->collectedDirectories);
	}

	public function collectFiles($limit, $offset) {
		$directories = array_slice($this->getCollectedDirectories(), $offset, $limit);
		$files = array();

		if (0 === $offset) {
			foreach ($this->fileDirList as $relativeItemPath) {
				$absItemPath = ABSPATH . trim($relativeItemPath, '/');

				if (is_dir($absItemPath) && 'dir' == filetype($absItemPath)) {
					continue;
				}

				if ($this->isCheckableFile($absItemPath)) {
					$files[$relativeItemPath] = array();
					$files[$relativeItemPath]['d'] = filemtime($absItemPath);
					$files[$relativeItemPath]['h'] = md5_file($absItemPath);
				}
			}
		}

		foreach ($directories as $relativePath) {
			$absPath = ABSPATH . trim($relativePath, '/');

			$directoryHandle = opendir($absPath);
			if (!$directoryHandle) {
				wptsafExtensionSystemLog::getInstance()->getLog()->addDangerMessage(
					$this->extension,
					sprintf(__('Could not open directory "%s"', 'wptsaf_security'), $relativePath)
				);
				continue;
			}

			while (false !== ($item = readdir($directoryHandle))) { 
				if ( '.' == $item || '..' == $item ){
					continue;
				}

				$relativeItemPath = rtrim($relativePath, '/') . '/' . $item;
				$absItemPath = ABSPATH . trim($relativeItemPath, '/');

				if (is_dir($absItemPath) && 'dir' == filetype($absItemPath)) {
					continue;
				}

				if ($this->isCheckableFile($absItemPath)) {
					$files[$relativeItemPath] = array();
					$files[$relativeItemPath]['d'] = filemtime($absItemPath);
					$files[$relativeItemPath]['h'] = md5_file($absItemPath);
				}
			}
			closedir($directoryHandle); 
		}

		$files = array_merge($files, $this->getCollectedFiles());
		$this->saveCollectedFiles($files);
	}

	public function scanBuildChanges() {
		wptsafEnv::getInstance()->setMinimumMemoryLimit('256M');

		$loggedFiles          = $this->getFileList();
		$currentFiles         = $this->getCollectedFiles(); //scan current files
		$filesAdded           = @array_diff_assoc($currentFiles, $loggedFiles); 
		$filesRemoved         = @array_diff_assoc($loggedFiles, $currentFiles); 
		$currentMinusAdded    = @array_diff_key($currentFiles, $filesAdded); 
		$loggedMinusDeleted   = @array_diff_key($loggedFiles, $filesRemoved);
		$filesChanged         = array(); //array of changed files

		foreach ($currentMinusAdded as $currentFile => $currentAttr) {
			if (array_key_exists($currentFile, $loggedMinusDeleted)) {
				if (
					0 != strcmp($currentAttr['d'], $loggedMinusDeleted[$currentFile]['d'])
					|| 0 != strcmp($currentAttr['h'], $loggedMinusDeleted[$currentFile]['h'])
				) {
					$filesChanged[$currentFile] = $currentAttr;
				}
			}
		}

		$result = array(
			'added'   => sizeof($filesAdded),
			'removed' => sizeof($filesRemoved),
			'changed' => sizeof($filesChanged),
			'probably_infected' => 0,
			'memory' => round((memory_get_peak_usage()/1000000), 2),
			'change_list' => array(
				'added'   => $filesAdded,
				'removed' => $filesRemoved,
				'changed' => $filesChanged,
				'probably_infected' => array()
			),
		);
		$this->saveScanResult($result);

		unset($filesAdded);
		unset($filesRemoved);
		unset($filesChanged);
		unset($currentFiles);

		return $result;
	}

	public function addedFilesScanMalware($limit, $offset){
		wptsafEnv::getInstance()->setMinimumMemoryLimit('256M');

		$scanResult = $this->getScanResult(); ;
		$files = array_slice($scanResult['change_list']['added'], $offset, $limit);
		$fileProbablyInfected = array();

		/** add task to malware  **/
		if(class_exists('wptsafExtensionMalwareScanner')){
			$malwareScannerLog = wptsafExtensionMalwareScanner::getInstance()->getLog();
			$malwareScannerLog->addFiles(array_keys($files));
			do_action('wptsaf_security_malware-scanner_cron_run_scan');	
		}

		$scanResult['change_list']['probably_infected'] = array_merge($scanResult['change_list']['probably_infected'], $fileProbablyInfected);
		$scanResult['probably_infected'] = sizeof($scanResult['change_list']['probably_infected']);
		$this->saveScanResult($scanResult);
	}

	public function changedFilesScanMalware($limit, $offset){
		wptsafEnv::getInstance()->setMinimumMemoryLimit('256M');

		$scanResult = $this->getScanResult(); ;
		$files = array_slice($scanResult['change_list']['changed'], $offset, $limit);
		$fileProbablyInfected = array();

		/** add task to malware  **/
		if(class_exists('wptsafExtensionMalwareScanner')){
			$malwareScannerLog = wptsafExtensionMalwareScanner::getInstance()->getLog();
			$malwareScannerLog->addFiles(array_keys($files));
			do_action('wptsaf_security_malware-scanner_cron_run_scan');	
		}

		$scanResult['change_list']['probably_infected'] = array_merge($scanResult['change_list']['probably_infected'], $fileProbablyInfected);
		$scanResult['probably_infected'] = sizeof($scanResult['change_list']['probably_infected']);
		$this->saveScanResult($scanResult);
	}

	public function sendFilesToMalwareScannerExtension(){
		$result = $this->getScanResult();

		$malwareScannerLog = wptsafExtensionMalwareScanner::getInstance()->getLog();
		$malwareScannerLog->addFiles(array_keys($result['change_list']['added']));
		$malwareScannerLog->addFiles(array_keys($result['change_list']['changed']));
		do_action('wptsaf_security_malware-scanner_cron_run_scan');
	}

	private function isCheckableFile($file) {
		$extension = pathinfo($file, PATHINFO_EXTENSION);
		return !in_array($extension, $this->ignoreFileTypes);
	}
}
