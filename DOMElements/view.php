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
						<li class="active"><a href="reportes.php">Reportes</a></li>
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
							Este sistema de inscripciones te permitirá llevar a cabo el proceso de unscripción de materias para tu próximo semestre de una forma fácil y ...
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

?>