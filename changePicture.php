#!/usr/bin/php -q

<?php

	require_once('lib/whatsApi/whatsprot.class.php');

	require_once("user_config.php");

	$debug = false;

	$w = new WhatsProt($username, $nickname, $debug);

	$w->connect(); // Connect to WhatsApp network
	$w->loginWithPassword($password); // logging in with the password we got!
	$w->sendSetProfilePicture("/var/tmp/youit_logo.jpg");
