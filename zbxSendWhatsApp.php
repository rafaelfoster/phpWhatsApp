#!/usr/bin/php -q

<?php

if ( isset($argv[1]) && isset($argv[2]) && isset($argv[3]) ) {

	require_once('lib/whatsApi/whatsprot.class.php');

	require_once("user_config.php");

	$debug = true;

	$w = new WhatsProt($username, $nickname, $debug);

	$w->connect(); // Connect to WhatsApp network
	$w->loginWithPassword($password); // logging in with the password we got!
//	$w->sendSetProfilePicture("/var/tmp/Youit_logo01.png");

//	exit();

	$target =  "55" . $argv[1];
	$subject = $argv[2];

//	if ( strpos($subject, strtolower("disaster")) == true)
	$subject = "\xF0\x9F\x9A\xA8 " . $subject . " \xF0\x9F\x9A\xA8";
	
	$message = $subject . "\n\n" . $argv[3];

//	$sync = array($target);
//	$w->sendSync($sync);
//	$w->sendPresenceSubscription($target); 
	$w->sendMessageComposing($target);
	sleep(1);
	$w->sendMessagePaused($target);
	$w->sendMessage($target , $message);
	$w->pollMessage();

}
