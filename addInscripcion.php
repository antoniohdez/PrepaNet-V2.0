<?php
	include "DOMElements/view.php";
	validarSession("student");
	setInscripcion();
	header("Location: reportes.php");
?>