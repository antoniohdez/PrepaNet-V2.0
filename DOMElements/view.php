<?php
	include "driver.php";
	//session_start();
	function printTopbar(){//Falta validar el tipo de sesión
		print '
			<header class="navbar navbar-inverse navbar-fixed-top">
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
						if($_SESSION["type"] == "admin" || $_SESSION["type"] == "student")//Posiblemente este if no es necesario
		                print '<ul class="nav navbar-nav navbar-right">
		  					<li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> '. $_SESSION["name"] .' <b class="caret"></b></a>
		                        <ul class="dropdown-menu">
		                        	<li><a href="password.php">Cambiar contraseña</a></li>
		                            <li><a href="logout.php">Cerrar sesión</a></li>
		                            <li class="divider"></li>
		                            <li><a href="#">Información</a></li>
		                        </ul>
		                    </li>
						</ul>';
						print ' 
					</div><!--/.nav-collapse -->
				</div>
			</header>
		';
	}

	function printFooter(){
		print '<footer class="row">
					<div class="col-md-12">
						<div class="container content">
							Contacto
							Acerca de...
							Ayuda
							Etc.
						</div>
					</div>
				</footer>
			';
	}

	function printProgress(){
		if($_SESSION["type"] == "student")
		print '<div class="centerText">
						<h4 style="margin:0">Estatus de inscripción</h4>
					</div>
					<hr>
					<div class="inscOption">
						<span class="inscOptionIMG">
							<img src="img/32px-Green_check.png">
						</span>
						<span>Confirmar información</span>
					</div>
					<div class="inscOption">
						<span class="inscOptionIMG">
							<img src="img/32px-Green_check.png">
						</span>
						<span>Selección de materias</span>
					</div>
					<div class="inscOption">
						<span class="inscOptionIMG">
							<img src="img/32px-Green_check.png">
						</span>
						<span>Inscripción Terminada</span>
					</div>';
		if($_SESSION["type"] == "admin")
		print '<div class="centerText">
						<h4 style="margin:0">Estatus de inscripción</h4>
					</div>
					<hr>
					<div class="inscOption">
						<span class="inscOptionIMG centerText"> - </span>
						<span>Alumnos inscritos</span>
					</div>
					<div class="inscOption">
						<span class="inscOptionIMG centerText"> - </span>
						<span>Alumnos nunca inscritos</span>
					</div>';
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
						Este sistema de inscripciones te permitirá llevar a cabo el proceso de inscripción de materias para tu próximo cuatrimestre de una forma sencilla.
					</p>
					<p>
						<!--Si no has utilizado este sistema antes, puedes ver una pequeña guia dando <a href="#">click aquí</a>.-->
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
		$row = getDatosRegistro();
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
			    <label for="incubadora" class="col-md-3 control-label">Incubadora a la que asisto para asesorias:</label>
			    <div class="col-md-9">
			    	<select class="form-control" name="incubadora">

						<option value="Incubadora Social Laureles" ';
						if($row["Incubadora"] === "Incubadora Social Laureles"){ print 'selected="selected"'; }
						print '>Incubadora Social Laureles</option>

						<option value="Incubadora Social Sauz" ';
						if($row["Incubadora"] === "Incubadora Social Sauz"){ print 'selected="selected"'; }
						print '>Incubadora Social Sauz</option>

						<option value="Incubadora Social Jocotan" ';
						if($row["Incubadora"] === "Incubadora Social Jocotan"){ print 'selected="selected"'; }
						print '>Incubadora Social Jocotan</option>

						<option value="Ninguna" ';
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

	function printCursables(){
		$result = getCursables();
		while ($row = mysqli_fetch_array($result)) {
    		print '
    			<div>
					<div id="'.$row["Clave"].'" unidades="'.$row["Unidades"].'" class="materia" >
						<span class="textAlign">'.$row["Nombre"]."<br><b>".$row["Unidades"]." unidades</b> - ".$row["Cuatrimestre"]." cuatrimestre".'</span>
						<span><button id="disponible" class="btn btn-success button">Inscribir</button></span>
					</div>
				</div>
    		';
		} 
	}

?>