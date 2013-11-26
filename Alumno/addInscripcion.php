<?php
	include "../view.php";
	validarSession("student");
	setInscripcion();
	header("Location: reportes.php");
?>