<?php
	include "../view.php";
	validarSession("admin");
	
	if($_GET["action"] == "inscritas"){
		getReporteInscritas();
	}
	else if($_GET["action"] == "activos"){
		getReporteAlumnos();
	}
	else if($_GET["action"] == "historial"){
		getReporteHistorial($_GET["matricula"]);
	}
	else if($_GET["action"] == "eliminar"){
		eliminarAlumno($_GET["matricula"]);
		header("Location: index.php");	
	}
	else if($_GET["action"] == "editar"){
		editarAlumno($_GET["matricula"]);
		header("Location: index.php");
	}
	else if($_GET["action"] == "agregar"){
		agregarAlumno($_GET["matricula"]);
		header("Location: index.php");
	}
	//header("Location: index.php");
?>