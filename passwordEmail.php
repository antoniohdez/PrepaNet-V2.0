<?php
	if(!isset($_POST["mat"])){
		header("location: login.php");
	}
	include "view.php";
	$pass = "";
	$possible = "01234567890123456789bcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	for($i = 0; $i < 8; $i++){
		$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
		$pass .= $char;
	}
	$datos = setPasswordEmail(md5($pass), $_POST["mat"]);
	$mail = $datos["Mail"];
	$nombre = $datos["Nombre"];
	require_once 'Swift/lib/swift_required.php';
	$transport = Swift_SmtpTransport::newInstance("smtp.gmail.com", 465, "ssl")
	->setUsername('prepanet.gdl@gmail.com')
	->setPassword('charlie.gdl');
	$mailer = Swift_Mailer::newInstance($transport);
	$message = Swift_Message::newInstance('Contraseña Prepanet')
	->setFrom(array('prepanet.gdl@gmail.com' => 'PrepaNet - Sistema de inscripciones'))
	->setTo(array($mail => $nombre))
	//->setBody("¡Hola, $nombre!\n\nTu nueva contraseña para el sistema de inscripciones de prepanet es <b>$pass</b>");
	->addPart("<p>¡Hola, $nombre!</p><p>Tu nueva contraseña para el sistema de inscripciones de prepanet es <b>$pass</b></p>", 'text/html');
	$numSent = $mailer->send($message);
	header("location:login.php?passRecovery=success&mail=$mail");
?>