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

class wptsafExtensionFileChangeLog extends wptsafAbstractLog{

	public function __construct(wptsafAbstractExtension $extension){
		parent::__construct($extension);

		$this->table = WPTSAF_DB_PREFIX . 'file_change_log';
		$this->fieldList = array(
			'date_gmt',
			'added',
			'removed',
			'changed',
			'probably_infected',
			'memory',
			'change_list',
		);
	}


	public function createTable(){
		global $wpdb;
		$wpdb->query(
			"CREATE TABLE IF NOT EXISTS `{$this->table}` (
				 `id` int(11) NOT NULL AUTO_INCREMENT,
				 `date_gmt` int(11) NOT NULL,
				 `added` int(11) NOT NULL,
				 `removed` int(11) NOT NULL,
				 `changed` int(11) NOT NULL,
				 `probably_infected` int(11) NOT NULL,
				 `memory` decimal(10,2) NOT NULL,
				 `change_list` varchar(500) NOT NULL,
				 PRIMARY KEY (`id`)
			)
			DEFAULT CHARACTER SET utf8
  			DEFAULT COLLATE utf8_general_ci"
		);
	}
}
