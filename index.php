<?php
	include "view.php";
	validarSession("any");
	if($_SESSION["type"] == "student"){
		header("Location: Alumno/index.php");
	}
	else if($_SESSION["type"] == "admin"){
		header("Location: Administrador/index.php");
	}
	else{
		header("Location: logout.php");	
	}
?>