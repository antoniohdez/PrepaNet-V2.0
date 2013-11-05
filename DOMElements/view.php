<?php
	include "driver.php";
	//session_start();
	function printTopbar(){//Falta validar el tipo de sesión
		print '
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php">PrepaNet</a>
					</div>
					<div class="collapse navbar-collapse">';
						
						if($_SESSION["type"] == "admin")
		                print '<ul class="nav navbar-nav">
							<!--<li class="active"><a href="reportes.php">Reportes</a></li>-->
							<li><a href="reportes.php">Reportes</a></li>
							<li><a href="alumnos.php">Alumnos</a></li>
							<li><a href="materias.php">Materias</a></li>
							<li><a href="administrador.php">Administrar Cuentas</a></li>
						</ul>';
						if($_SESSION["type"] == "admin" || $_SESSION["type"] == "student")
		                print '<ul class="nav navbar-nav navbar-right">
		  					<li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">'. $_SESSION["name"] .' <b class="caret"></b></a>
		                        <ul class="dropdown-menu">
		                        	<li><a href="password.php">Cambiar contraseña</a></li>
		                        	<li class="divider"></li>
		                            <li><a href="logout.php">Cerrar sesión</a></li>
		                        </ul>
		                    </li>
						</ul>';
						print ' 
					</div><!--/.nav-collapse -->
				</div>
			</div>
		';
	}

	function printIndex(){//Falta validar el tipo de sesión al imprimir el index
		if($_SESSION["type"] == "student")
		print '
			<div class="content">
						<div class="centerText">
							<h3>Bienvenido al sistema de inscrpciones de PrepaNet</h3>
						</div>
						<div>
							<p>
								Este sistema de inscripciones te permitirá llevar a cabo el proceso de inscripción de materias para tu próximo semestre de una forma fácil y ...
							</p>
							<p>
								Si no has utilizado este sistema antes, puedes ver una pequeña guia dando <a href="#">click aquí</a>.
							</p>
						</div>
						<div class="centerText">
							<button class="btn btn-primary signIn" onClick="window.location.href='."'registro.php'".'">Comenzar inscripción</button>
						</div>
					</div>
		';
		else
		print '
			<div class="content">
						<div class="centerText">
							<h3>Administrador</h3>
						</div>
						<div>
							<p>
								
							</p>
						</div>
					</div>
		';	

	}

	function getFormRegistro(){
		$con = conectar();

		if($result = mysqli_query($con,"SELECT * FROM Alumno where Matricula = '".$_SESSION["user"]."'")){
			if(mysqli_num_rows($result) === 1){
				$row = $result->fetch_array(MYSQLI_ASSOC);
				print '
				<form class="form-horizontal" role="form" action="SeleccionMaterias.php" method="get">
				  	<div class="form-group">
				    	<label for="name" class="col-md-3 control-label">Nombre:</label>
				    	<div class="col-md-9">
				      		<p class="form-control-static">'.$row["Nombre"].' '. $row["ApellidoP"].' '.$row["ApellidoM"].'</p>
				    	</div>
				  	</div>
				  	<div class="form-group">
					    <label for="studentNumber" class="col-md-3 control-label">Password:</label>
					    <div class="col-md-9">
					    	<p class="form-control-static">'.$row["Matricula"].'</p>
					    </div>
					</div>
					<div class="form-group">
					    <label for="phone" class="col-md-3 control-label">Teléfono:</label>
					    <div class="col-md-9">
					    	<input type="text" name="phone" class="form-control" id="phone" value="'.$row["Telefono"].'" placeholder="(33) 4455-66-77">
					    </div>
					</div>
					<div class="form-group">
					    <label for="email" class="col-md-3 control-label">Correo electrónico:</label>
					    <div class="col-md-9">
					    	<input type="text" name="email" class="form-control" id="email" value="'.$row["Mail"].'" placeholder="usuario@ejemplo.com">
					    </div>
					</div>
					<div class="form-group">
					    <label for="convenio" class="col-md-3 control-label">Convenio:</label>
					    <div class="col-md-9">
					    	<p class="form-control-static">'.$row["Convenio"].'</p>
					    </div>
					</div>
					<div class="form-group">
					    <label for="beca" class="col-md-3 control-label">Beca:</label>
					    <div class="col-md-9">
					    	<p class="form-control-static">'.$row["PBeca"].'%</p>
					    </div>
					</div>
					<div class="form-group">
					    <label for="materias" class="col-md-3 control-label">Materias a inscribir:</label>
					    <div class="col-md-9">
					    	<select class="form-control" name="num">
								<option value="2" >2</option>
								<option value="3" >3</option>
								<option value="4" >4</option>
								<option value="5" >5</option>
								<option value="6" >6</option>
							</select>
					    </div>
					</div>
					<div class="form-group">
					    <label for="incubadora" class="col-md-3 control-label">Incubadora:</label>
					    <div class="col-md-9">
					    	<select class="form-control" name="incubadora">
								<option value="Incubadora Social Laureles"';
								if($row["Incubadora"] ==="Incubadora Social Laureles"){ print 'selected="selected"'; }
								print '>Incubadora Social Laureles</option>

								<option value="Incubadora Social Sauz"';
								if($row["Incubadora"] ==="Incubadora Social Sauz"){ print 'selected="selected"'; }
								print '>Incubadora Social Sauz</option>
								<option value="Incubadora Social Jocotan" >Incubadora Social Jocotan</option>
								<option value="Desconozco su ubicación" >Desconozco su ubicación</option>
								<option value="Ninguna"';
								if($row["Incubadora"] === "Ninguna"){ print 'selected="selected"'; }
								print '>Ninguna</option>
							</select>
					    </div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-3 col-md-9">
					    	<button class="btn btn-primary signIn" type="submit">Guardar registro</button>
					    </div>
					</div>
				</form>';
			}
			else{//El usuario no está en la base de datos
				print 'El se pudieron encontrar los datos en el sistema';
			}
		}
		else{
			print 'Error al conectarse a la base de datos';//No se pudo la consulta en la base de datos para alumnos
		}
	}

?>