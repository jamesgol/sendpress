<?php
// Prevent loading this file directly
if ( !defined('SENDPRESS_VERSION') ) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

global $wpdb;

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

$subscriber_events_table =  SendPress_DB_Tables::subscriber_event_table();

$wpdb->flush();

if($wpdb->get_var("show tables like '$subscriber_events_table'") != $subscriber_events_table) {
	  $sqltable = "CREATE TABLE ".$subscriber_events_table." (
	  `eventID` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `subscriberID` int(11) unsigned NOT NULL,
	  `reportID` int(11) unsigned NOT NULL,
	  `urlID` int(11) unsigned DEFAULT NULL,
	  `eventdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	  `ip`  varchar(400) DEFAULT NULL,
	  `devicetype`  varchar(50) DEFAULT NULL,
	  `device`  varchar(50) DEFAULT NULL,
	  `type` varchar(50) DEFAULT NULL,
	  PRIMARY KEY (`eventID`),
	  KEY `subscriberID` (`subscriberID`),
	  KEY `reportID` (`reportID`),
	  KEY `urlID` (`urlID`),
	  KEY `eventdate` (`eventdate`),
	  KEY `type` (`type`)
	)"; 
	dbDelta($sqltable); 
}
