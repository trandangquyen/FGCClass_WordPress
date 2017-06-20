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

?>
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?php echo $extensionTitle . ': ' . __('Scan', 'wptsaf_security'); ?></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div id="progress-bar">
					<?php _e('Scanning...', 'wptsaf_security'); ?>
				</div>
				<br>

				<div id="scan-result"></div>
			</div>
		</div>
	</div>
</div>

<script>
	(function($) {
		var translation = {
			'scan_dir_list': '<?php _e('Collect directory list...', 'wptsaf_security'); ?>',
			'scan_file_list': '<?php _e('Collect files in {0} of {1} directories...', 'wptsaf_security'); ?>',
			'scan_build_changes': '<?php _e('Building changes...', 'wptsaf_security'); ?>',
			'scan_added_file_malware': '<?php _e('Scan added files {0} of {1} for malware...', 'wptsaf_security'); ?>',
			'scan_changed_file_malware': '<?php _e('Scan changed files {0} of {1} for malware...', 'wptsaf_security'); ?>',
			'send_files_to_malware_scanner_extension': '<?php _e('Send files to Malware scanner extension...', 'wptsaf_security'); ?>',
			'scan_build_result': '<?php _e('Building scan result...', 'wptsaf_security'); ?>'
		},
		$progressBar = $('#progress-bar'),
		directoriesAmount = 0,
		processDirectoriesLimit = <?php echo wptsafExtensionFileChangeScanner::SCAN_DIRECTORIES_LIMIT; ?>,
		processDirectoriesOffset = 0,
		scanResult = null,
		scanFileMalwareLimit = <?php echo wptsafExtensionFileChangeScanner::SCAN_FILE_MALWARE_LIMIT; ?>,
		scanFileMalwareOffset = 0;


		function collectDirectories() {
			$progressBar.html(translation.scan_dir_list);

			wptsafDataAction.processAction(
				null,
				'action=wptsaf_security&extension=file-change&method=collectDirectories',
				null,
				false,
				function ($target, response) {
					directoriesAmount = response.directoriesAmount || 0;
					collectFiles();
				}
			);
		}

		function collectFiles() {
			$progressBar.html(translation.scan_file_list
				.replace('{0}', processDirectoriesOffset ? processDirectoriesOffset : processDirectoriesLimit)
				.replace('{1}', directoriesAmount)
			);

			wptsafDataAction.processAction(
				null,
				'action=wptsaf_security&extension=file-change&method=collectFiles&args[limit]=' + processDirectoriesLimit + '&args[offset]=' + processDirectoriesOffset,
				null,
				false,
				function ($target, response) {
					processDirectoriesOffset += processDirectoriesLimit;

					if (processDirectoriesOffset < directoriesAmount) {
						collectFiles();
					} else {
						scanBuildChanges();
					}
				}
			);
		}

		function scanBuildChanges() {
			$progressBar.html(translation.scan_build_changes);
			
			wptsafDataAction.processAction(
				null,
				'action=wptsaf_security&extension=file-change&method=scanBuildChanges',
				null,
				false,
				function ($target, response) {
					scanResult = response.scanResult || {added: 0, changed: 0};
					addedFilesScanMalware();
				}
			);
		}

		function addedFilesScanMalware() {
			if (0 == scanResult.added) {
				scanFileMalwareOffset = 0;
				changedFilesScanMalware();
				return;
			}

			var strOffset = scanFileMalwareOffset ? scanFileMalwareOffset : scanFileMalwareLimit;
			strOffset = scanResult.added > strOffset ? strOffset : scanResult.added;
			$progressBar.html(translation.scan_added_file_malware
				.replace('{0}', strOffset)
				.replace('{1}', scanResult.added)
			);

			wptsafDataAction.processAction(
				null,
				'action=wptsaf_security&extension=file-change&method=addedFilesScanMalware&args[limit]=' + scanFileMalwareLimit + '&args[offset]=' + scanFileMalwareOffset,
				null,
				false,
				function ($target, response) {
					scanFileMalwareOffset += scanFileMalwareLimit;

					if (scanFileMalwareOffset < scanResult.added) {
						addedFilesScanMalware();
					} else {
						scanFileMalwareOffset = 0;
						changedFilesScanMalware();
					}
				}
			);
		}

		function changedFilesScanMalware() {
			if (0 == scanResult.changed) {
				scanBuildResult();
				return;
			}

			var strOffset = scanFileMalwareOffset ? scanFileMalwareOffset : scanFileMalwareLimit;
			strOffset = scanResult.changed > strOffset ? strOffset : scanResult.changed;
			$progressBar.html(translation.scan_changed_file_malware
				.replace('{0}', strOffset)
				.replace('{1}', scanResult.changed)
			);

			wptsafDataAction.processAction(
				null,
				'action=wptsaf_security&extension=file-change&method=changedFilesScanMalware&args[limit]=' + scanFileMalwareLimit + '&args[offset]=' + scanFileMalwareOffset,
				null,
				false,
				function ($target, response) {
					scanFileMalwareOffset += scanFileMalwareLimit;

					if (scanFileMalwareOffset < scanResult.changed) {
						changedFilesScanMalware();
					} else {
						sendFilesToMalwareScannerExtension();
					}
				}
			);
		}

		function sendFilesToMalwareScannerExtension() {
			$progressBar.html(translation.send_files_to_malware_scanner_extension);

			wptsafDataAction.processAction(
				$('#scan-result'),
				'action=wptsaf_security&extension=file-change&method=sendFilesToMalwareScannerExtension',
				null,
				false,
				function () {
					scanBuildResult()
				}
			);
		}

		function scanBuildResult() {
			$progressBar.html(translation.scan_build_result);

			wptsafDataAction.processAction(
				$('#scan-result'),
				'action=wptsaf_security&extension=file-change&method=scanBuildResult',
				null,
				false
			);
		}

		collectDirectories();
	})(jQuery);
</script>
