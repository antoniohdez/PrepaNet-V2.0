<?php
	session_start();
/*
	class driver {
		var conexion;

		function __construct() {
			session_start();
		}
	}
*/

	function validarSession($session){
		if($session === "login"){
			if(isset($_SESSION["user"])){
				header("location: index.php");
			}
		}
		else if($session === "any"){
			if(!isset($_SESSION["user"])){
				if(!isset($_POST["user"])){
					header("location: login.php");
				}
				else{//FALTA VALIDAR SI EL USUARIO ESTÁ EN LA BASE DE DATOS
					$_SESSION["user"] = $_POST["user"];
				}
			}
		}
		else if("student"){//Falta validar que sea una sesión de estudiante
			if(!isset($_SESSION["user"])){
				header("location: login.php");
			}
		}
		else if("admin"){//Falta validar que sea una sesión de administrador
			if(!isset($_SESSION["user"])){
				header("location: login.php");
			}
		}
	}
?>