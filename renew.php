<?php

	session_start();
//	require_once('lib/whatsApi/whatsprot.class.php');
	require_once('lib/whatsApi/Registration.php');

	if (isset($_GET['code']) && !is_null($_GET['code']) ){
		$celular = "55" . $_SESSION['celular'];

		$debug = true;
		$w = new Registration($celular, $debug);

//		$fWhats = file_get_contents("whatsregister.dat");
//		$w = unserialize($fWhats);

		try {
			$code = str_replace("-", "", $_GET['code']);
			$result = $w->codeRegister(trim($code));
		} catch(Exception $e) {
			echo $e->getMessage();
			exit(0);
		}

		$fp = @fopen("user_config.php", "a+");
		if ($fp) {
			fwrite($fp, '$password = "' . $result->pw . '"' . ";\n" );
			fclose($fp);
			echo "OK";
			exit();
		}
 		exit();

	} else {

		$_SESSION['celular'] = $_GET['celular'];

		//header("Content-type: text/html; charset=utf-8");

		$debug = true;

		//echo "\n\nUsername (country code + number without + or 00): ";
		$username = trim("55" . $_GET['celular']);
		$nome = trim($_GET['nome']);

		$fCode = $_GET['celular'] . ".dat";

		$w = new Registration($username, $debug);
//		$w = new WhatsProt($username, '', $debug);

		$option = "sms";

		// $w->checkCredentials();
	
		try {
			$w->codeRequest(trim($option));
			$fp = @fopen("user_config.php", "w");
			if ($fp) {
				fwrite($fp, '<?php' . "\n");
				fwrite($fp, '$username = "' . $username . '"' . ";\n");
				fwrite($fp, '$nickname = "' . $nome . '"' . ";\n");
				fclose($fp);
			}
			echo "OK";
		} catch(Exception $e) {
			// echo $e->getMessage();
			exit(0);
		}

	}

	exit();
