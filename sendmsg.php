<?php
header("Content-type: text/html; charset=utf-8");
require_once('lib/whatsApi/whatsprot.class.php');

require_once("user_config.php");

$debug = false;

// Create a instance of WhastPort.
$w = new WhatsProt($username, $nickname, $debug);

$w->connect(); // Connect to WhatsApp network
$w->loginWithPassword($password); // logging in with the password we got!

$target ="55" . $_GET['sendTO'];
$message = $_GET['msg'];

$sync = array($target);
$w->sendSync($sync); // Sincronizamos el contacto
$w->sendPresenceSubscription($target); 

$w->sendMessage($target , $message);
$w->pollMessage();

//while($w->pollMessage());

