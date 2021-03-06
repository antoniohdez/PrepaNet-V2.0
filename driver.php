<?php
	error_reporting(1);
	session_start();

	function conectar(){//Genera la conexión a la base de datos
		$con=mysqli_connect("localhost","root","123456","prepanet2");
		if (mysqli_connect_errno())
	  	{
	  		print "Falló la conexión a la base de datos: " . mysqli_connect_error();
	  	}
	  	mysqli_set_charset($con, "utf8");
	  	return $con;
	}
	
	function crearSession(){
		if(!getPeriodo()){
			header("Location: login.php?error=3");//No es periodo de inscripción
		}

		$con = conectar();
		if(!isset($_SESSION["user"])){
			if(!isset($_POST["user"])){
				header("location: login.php");
			}
			else{
				$user = $_POST["user"];
				$pass = md5($_POST["password"]);
				$con = conectar();
				if($stmt = $con->prepare("SELECT Matricula, Nombre FROM Alumno where Matricula = ? AND Password = ?")){
					$stmt->bind_param('ss', $_POST["user"], $pass);
					if($stmt->execute()){
						$stmt->bind_result($mat, $nom);
					    if($stmt->fetch()) {
					    	$_SESSION["user"] = $mat;
							$_SESSION["name"] = $nom;
							$_SESSION["type"] = "student";
							$_SESSION["etapa"] = 0;
					        $stmt->close();
					        mysqli_close($con);
					        header("Location: index.php");
					   	}
					   	else{
					   		if($stmt = $con->prepare("SELECT Nomina, Nombre FROM Administrador where Nomina = ? AND Password = ?")){
								$stmt->bind_param('ss', $_POST["user"], $pass);
								if($stmt->execute()){
									$stmt->bind_result($mat, $nom);
								    if($stmt->fetch()) {
								    	$_SESSION["user"] = $mat;
										$_SESSION["name"] = $nom;
										$_SESSION["type"] = "admin";
								        $stmt->close();
								        mysqli_close($con);
								        header("Location: index.php");
								   	}else{
								   		mysqli_close($con);
								   		header("Location: login.php?error=1");//El usuario no está en la base de datos
								   	}
								}
								else{
									mysqli_close($con);
									header("Location: login.php?error=2");///No se pudo la consulta en la base de datos para administradores
								}
							}
							else{
								mysqli_close($con);
								header("Location: login.php?error=2");///No se pudo la consulta en la base de datos para administradores
							}
					   	}
					}else{
						mysqli_close($con);
						header("Location: login.php?error=2");///No se pudo la consulta en la base de datos para administradores
					}
				}
				else{
					mysqli_close($con);
					header("Location: login.php?error=2");//No se pudo la consulta en la base de datos para alumnos
				}
			}
		}
		else{
			header("Location: index.php");
		}
	}

	//Valida los permisos del usuario para estar en una página, en caso de no tenerlos los envia al index si es que iniciaron sesión
	//En caso de no tener una sesión iniciada, esta se crea desde el index.
	function validarSession($session){
		if($session === "login"){
			if(isset($_SESSION["user"])){
				header("location: index.php");
			}
		}
		else if($session === "student"){//Falta validar que sea una sesión de estudiante
			if(!isset($_SESSION["user"])){
				//header("location: logout.php");
				header("location: ../login.php?error=1");
			}
			else{
				if($_SESSION["type"] != "student"){
					header("location: ../index.php?error=1");
				}
			}
		}
		else if($session === "admin"){//Falta validar que sea una sesión de administrador
			if(!isset($_SESSION["user"])){
				//header("location: logout.php");
				header("location: ../login.php?error=1");
			}
			else{
				if($_SESSION["type"] != "admin"){
					header("location: ../index.php?error=1");
				}	
			}
		}
		else if($session === "any"){
			if(!isset($_SESSION["user"])){
				header("Location: login.php");	
			}
		}
	}

	function getPeriodo(){//Regresa true si la fecha en la que se ingresa es válida para realizar una inscripción

		return true;
	}

	function getDatosRegistro(){//Regresa datos para el formulario del registro administrativo
		$con = conectar();
		if($result = mysqli_query($con,"SELECT * FROM Alumno where Matricula = '".$_SESSION["user"]."';")){
			if(mysqli_num_rows($result) === 1){
				mysqli_close($link);
				return $result->fetch_array(MYSQLI_ASSOC);
			}
		}
	}

	function setRegistro(){
		$con = conectar();
		$telefono = $_POST["phone"];
		$correo = $_POST["email"];
		//$Nmaterias = $_GET["num"];
		$incubadora = $_POST["incubadora"];
		$query = "UPDATE Alumno SET Telefono = $telefono, Mail = '$correo', Incubadora = '$incubadora' WHERE  Matricula = '".$_SESSION["user"]."';";
		mysqli_query($con, $query);
		$_SESSION["etapa"] = 1;
		mysql_close($con);
	}

	function getCursables(){
		$con = conectar();
		
		$query = 	"SELECT * FROM PlanEstudios
					NATURAL JOIN
					(SELECT Clave, Nombre FROM Materia Where Clave IN 
						(SELECT Clave FROM Materia_Requisito WHERE Requisito IN 
							(SELECT Clave FROM Cursadas WHERE Matricula = '".$_SESSION['user']."')) 
					UNION 
					(SELECT Clave, Nombre FROM Materia WHERE Clave NOT IN 
						(SELECT Clave FROM Materia_Requisito) AND Clave NOT IN 
							(SELECT Clave FROM Cursadas WHERE Matricula =  '".$_SESSION['user']."'))) A WHERE Clave NOT IN (SELECT Clave FROM Cursadas WHERE Matricula = '".$_SESSION['user']."') ORDER BY Cuatrimestre ASC;";

				
		if($result = mysqli_query($con, $query)){
			return $result;
		}
	}

	function setInscripcion(){
		$con = conectar();
		$materias = $_POST["materias"];
		for($i = 0; $i < count($materias); $i++){
			if(mysqli_query($con,"INSERT INTO Cursadas VALUES ('".$_SESSION["user"]."', '$materias[$i]', 'DIC2013');")){
				print "Si";
				$_SESSION["etapa"] = 3;
			}
			else{
				print "No";
			}
		}
		
	}

	function getReporteInscritas(){
		$con = conectar();
		$result = mysqli_query($con, "SELECT DISTINCT Matricula FROM Cursadas;");
		while($row = mysqli_fetch_array($result)){
			echo $row[0].",";
			
			$result2 = mysqli_query($con, "SELECT Clave FROM Cursadas WHERE Matricula='".$row[0]."';");
			while($materias = mysqli_fetch_array($result2)){
				echo $materias[0].",";
			}
			echo "\n";
		}
		//$tbHtml .= '</tbody>
		//			</table>';
		
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=reporteInscritas.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		
	}

	function getReporteAlumnos(){
		$con = conectar();
		header('Content-Encoding: UTF-8');
		header('Content-type: text/csv; charset=UTF-8');
		header("Content-Disposition: attachment; filename=reporteAlumnos.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		$result = mysqli_query($con, "SELECT * FROM Alumno;");
		while($row = mysqli_fetch_array($result)){
			echo utf8_decode($row[0].",".$row[1].",".$row[2].",".$row[3].",".$row[4].",".$row[5].",".$row[6].",".$row[7].",".$row[9]);
			echo "\n";
		}
	}

	function getReporteHistorial($matricula){
		$con = conectar();
		header('Content-type: text/csv');
		header("Content-Disposition: attachment; filename=".$matricula.".csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		$result = mysqli_query($con, "SELECT * FROM Cursadas WHERE Matricula = '$matricula'");
		while($row = mysqli_fetch_array($result)){
			echo $row[0].",".$row[1].",".$row[2];
			echo "\n";
		}
	}

	function getDatosAlumno($matricula){//Regresa datos para el formulario del registro administrativo
		$con = conectar();
		if($result = mysqli_query($con,"SELECT * FROM Alumno where Matricula = '$matricula'")){
			if(mysqli_num_rows($result) === 1){
				mysqli_close($link);
				return $result->fetch_array(MYSQLI_ASSOC);
			}
		}
	}

	function agregarAlumno(){
		$Matricula = $_POST["matricula"];
		$Password = md5($Matricula);
		$Nombre = $_POST["nombre"];
		$ApellidoP = $_POST["apellidoP"];
		$ApellidoM = $_POST["apellidoM"];
		$Telefono = $_POST["telefono"];
		$Beca = $_POST["beca"];
		$Convenio = $_POST["convenio"];
		$Correo = $_POST["email"];
		$Incubadora = $_POST["incubadora"];
		$con = conectar();
		mysqli_query($con,"INSERT INTO  Alumno (Matricula ,Nombre ,ApellidoP ,ApellidoM ,Telefono ,PBeca ,Convenio ,Mail ,Password ,Incubadora)
	             	VALUES ('$Matricula',  '$Nombre',  '$ApellidoP',  '$ApellidoM',  '$Telefono', '$Beca' , '$Convenio' ,  '$Correo',  '$Password', '$Incubadora')");
		mysqli_close($con);
	}

	function editarAlumno($matricula){
		$con = conectar();
		$Nombre = $_POST["nombre"];
		$ApellidoP = $_POST["apellidoP"];
		$ApellidoM = $_POST["apellidoM"];
		$Telefono = $_POST["telefono"];
		$Beca = $_POST["beca"];
		$Convenio = $_POST["convenio"];
		$Correo = $_POST["email"];
		$Incubadora = $_POST["incubadora"];
		$query = "UPDATE Alumno SET Nombre = '$Nombre',
									ApellidoP = '$ApellidoP', 
									ApellidoM = '$ApellidoM', 
									Telefono = '$Telefono', 
									PBeca = '$Beca', 
									Convenio = '$Convenio', 
									Mail = '$Correo', 
									Incubadora = '$Incubadora' 
									WHERE  Matricula = '$matricula'";
		mysqli_query($con, $query);
		mysql_close($con);
	}

	function eliminarAlumno($matricula){
		$con = conectar();
		$result = mysqli_query($con, "DELETE FROM Alumno WHERE Matricula = '$matricula'");
		mysqli_close($con);
	}

	function setNewPassword(){
		$con = conectar();
		if(strlen($_POST['newPassword']) < 6){
			header("location: password.php?error=lenpass");
		}
		else{
			$password = md5($_POST['oldPassword']);
			$newPassword = md5($_POST["newPassword"]);
			$newPassword2 = md5($_POST["newPassword2"]);
			if($newPassword == $newPassword2){
				$result = mysqli_query($con,"SELECT Password FROM Alumno where Matricula = '".$_SESSION["user"]."';");
				$row = $result->fetch_array(MYSQLI_ASSOC);
				if($row["Password"] == $password){
					if($result = mysqli_query($con, "UPDATE Alumno SET Password = '$newPassword' WHERE Matricula = '".$_SESSION["user"]."';")){
						header("location:index.php?pass=changed");
					}
					else{
						header("location: password.php?error=query");
					}
				}
				else{
					header("location: password.php?error=wrongPassword");
				}
			}
			else{
				header("location: password.php?error=passMatch");
			}
		}
		mysql_close($con);
	}

	function setPasswordEmail($pass, $user){
		$con = conectar();
		if($result = mysqli_query($con, "UPDATE Alumno SET Password = '$pass' WHERE Matricula = '$user';")){
			if($result = mysqli_query($con,"SELECT Nombre, Mail FROM Alumno where Matricula = '$user';")){
				if(mysqli_num_rows($result) === 1){
					mysqli_close($link);
					return $result->fetch_array(MYSQLI_ASSOC);
				}
				else{
					header("location: login.php?passRecovery=userNotFound");
				}
			}
			else{
				header("location:login.php?passRecovery=failEmail");	
			}
		}else{
			header("location:login.php?passRecovery=fail");
		}
	}

	function importCSV(){
		header('Content-Type: text/html; charset=UTF-8');
		$con = conectar();
		// path where your CSV file is located
		define('CSV_PATH','');

		// Name of your CSV file
		$csv_file = CSV_PATH . "DirectorioAlumnos2013.csv";
		$a = 0;
		if (($getfile = fopen($csv_file, "r")) !== FALSE) { 
	        $data = fgetcsv($getfile, 0,",");
	        echo '<table>';
	        while (($data = fgetcsv($getfile, 0,",")) !== FALSE) {
	        	// $num = count($data); 
		             $result = $data; 
		             $str = implode(",", $result); 
		             $slice = explode(",", $str);
		             $Matricula = $slice[0]; 
		             $Nombre = utf8_encode($slice[1]);
		             $ApellidoP = utf8_encode($slice[2]); 
		             $ApellidoM = utf8_encode($slice[3]);
		             $Telefono = $slice[7].$slice[8];
		             $Correo = $slice[9];
		             $Password = md5($Matricula);
		             if($Correo == ""){
		             	$Correo = $slice[10];
		             }

					// SQL Query to insert data into DataBase
	            	mysqli_query($con,"INSERT INTO  Alumno (Matricula ,Nombre ,ApellidoP ,ApellidoM ,Telefono ,PBeca ,Convenio ,Mail ,Password ,Incubadora)
	             	VALUES ('$Matricula',  '$Nombre',  '$ApellidoP',  '$ApellidoM',  '$Telefono', NULL , NULL ,  '$Correo',  '$Password', NULL);");
	       }
	       echo "</table>";
	    }
		mysql_close($con);

		}

?>