<?php
	error_reporting(1);
	session_start();
	function conectar(){
		$con=mysqli_connect("localhost","root","","prepanet2");
		if (mysqli_connect_errno())
	  	{
	  		echo "Falló la conexión a la base de datos: " . mysqli_connect_error();
	  	}
	  	return $con;
	}
	

	function validarSession($session){
		$con = conectar();
		if($session === "login"){
			if(isset($_SESSION["user"])){
				header("location: index.php");
			}
		}
		else if($session === "index"){
			if(!isset($_SESSION["user"])){
				if(!isset($_POST["user"])){
					header("location: login.php");
				}
				else{
					$pass = md5($_POST["password"]);

					/*
					$stmt = mysqli_prepare($link, "SELECT * FROM Alumno where Matricula = ? AND Password = ?");
					mysqli_stmt_bind_param($stmt, 'ss', $_POST["user"], $pass);

					$code = 'DEU';
					$language = 'Bavarian';
					$official = "F";
					$percent = 11.2;

					// execute prepared statement 
					mysqli_stmt_execute($stmt);					
					*/

					if($result = mysqli_query($con,"SELECT * FROM Alumno where Matricula = '".$_POST["user"]."' AND Password = '$pass'")){
						if(mysqli_num_rows($result) === 1){
							$row = $result->fetch_array(MYSQLI_ASSOC);
							$_SESSION["user"] = $row["Matricula"];
							$_SESSION["name"] = $row["Nombre"];
							$_SESSION["type"] = "student";
						}
						else{//El usuario no es alumno
							//header("Location: login.php?error=1");//El usuario no está en la base de datos
							if($result = mysqli_query($con,"SELECT * FROM Administrador where Nomina = '".$_POST["user"]."' AND Password = '$pass'")){
								if(mysqli_num_rows($result) === 1){
									$row = $result->fetch_array(MYSQLI_ASSOC);
									$_SESSION["user"] = $row["Nomina"];
									$_SESSION["name"] = $row["Nombre"];
									$_SESSION["type"] = "admin";
								}
							}
							else{
								header("Location: login.php?error=2");///No se pudo la consulta en la base de datos para administradores
							}
						}
					}
					else{
						header("Location: login.php?error=2");//No se pudo la consulta en la base de datos para alumnos
					}

					

				}
			}
		}
		else if($session === "student"){//Falta validar que sea una sesión de estudiante
			if(!isset($_SESSION["user"])){
				//header("location: logout.php");
				header("location: login.php?error=1");
			}
			else{
				if($_SESSION["type"] !== "student"){
					header("location: index.php?error=1");
				}
			}
		}
		else if($session === "admin"){//Falta validar que sea una sesión de administrador
			if(!isset($_SESSION["user"])){
				//header("location: logout.php");
				header("location: login.php?error=1");
			}
			else{
				if($_SESSION["type"] !== "admin"){
					header("location: index.php?error=1");
				}	
			}
		}
		
	}
?>