<?php
	error_reporting(1);
	session_start();

	function conectar(){//Genera la conexión a la base de datos
		$con=mysqli_connect("localhost","root","","prepanet2");
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
		else if($session == "any"){
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
		$telefono = $_GET["phone"];
		$correo = $_GET["email"];
		//$Nmaterias = $_GET["num"];
		$incubadora = $_GET["incubadora"];
		$query = "UPDATE Alumno SET Telefono = $telefono, Mail = '$correo', Incubadora = '$incubadora' WHERE  Matricula = '".$_SESSION["user"]."';";
		mysqli_query($con, $query);
		$_SESSION["etapa"] = 1;
		mysql_close($con);
	}

	function getCursables(){
		$con = conectar();
		$query = "SELECT * FROM PlanEstudios NATURAL JOIN (SELECT Clave, Nombre FROM Materia WHERE Clave NOT IN (SELECT Clave FROM Cursadas)) A limit 0,10;";
		//$query = "SELECT Clave, Nombre, Unidades, Cuatrimestre FROM Materia NATURAL JOIN PlanEStudios order by Cuatrimestre asc;";
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
		$result = mysqli_query($con, "SELECT DISTINCT Matricula, Clave FROM cursadas;");
		$tbHtml = "<table>
		           	   <header>
		                   <tr>
		                       <th>Matricula</th>
		                       <th>Materias</th>
		                   </tr>
		               </header>";
		while($row = mysqli_fetch_array($result)){
			$tbHtml .= '<tr><td>'.$row[0].'</td>';
			
			$result = mysqli_query($con, "SELECT Clave FROM cursadas WHERE Matricula='".$row[0]."';");
			while($materias = mysqli_fetch_array($result)){
				$tbHtml .= '<td>'.$materias[0].'</td>';
			}
			$tbHtml .= '</tr>';
		}
		$tbHtml .= '</html>';
		$paises = array(0=>'México','Venezuela','Colombia','Belice','Guatemala',
	                 'Perú','Brasil','Panamá');

		
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=reporteInscritas.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		print $tbHtml;
		
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
						echo "Jesus es grande";
						header("location:index.php?pass=changed");
					}
					else{
						echo "Hola Mau";
						header("location: password.php?error=query");
						
					}
				}
				else{
					header("location: password.php?error=wrongPassword");
				}
			}
			else{
				header("location: password.php?error=noCoincidencePassword");
			}
		}


	/*	$query = "UPDATE  prepanet.Alumno SET Password = '$newPassword'  
					WHERE  alumno.Matricula = '".$_SESSION["user"]."';";
			if($result = mysqli_query($con, $query)){
				return $result;
				}*/


		mysql_close($con);
	}

	function importCSV(){
		header('Content-Type: text/html; charset=UTF-8');
		echo "trololol";
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