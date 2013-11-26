<?php
	include "../view.php";
	validarSession("admin");
	
	if($_GET["action"] == "inscritas"){
		getReporteInscritas();
	}
	else if($_GET["action"] == "activos"){
		print 'lol';
	}

?>