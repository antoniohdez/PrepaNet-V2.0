<?php
	include "DOMElements/view.php";
	validarSession("student");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>
        PrepaNet - Inscripciones
    </title>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<?php
		printTopbar();
	?>
	<div class="container CScontenedor">
		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<div class="content">
					<div class="centerText">
						<h3>Registro administrativo</h3>
					</div>
					<form class="form-horizontal" role="form" action="materias.php" method="get">
					  	<div class="form-group">
					    	<label for="name" class="col-md-3 control-label">Nombre:</label>
					    	<div class="col-md-9">
					      		<p class="form-control-static">Antonio Hernández Campos</p>
					    	</div>
					  	</div>
					  	<div class="form-group">
						    <label for="studentNumber" class="col-md-3 control-label">Password:</label>
						    <div class="col-md-9">
						    	<p class="form-control-static">A01224787</p>
						    </div>
						</div>
						<div class="form-group">
						    <label for="phone" class="col-md-3 control-label">Teléfono:</label>
						    <div class="col-md-9">
						    	<input type="text" name="phone" class="form-control" id="phone" placeholder="(33) 4455-66-77">
						    </div>
						</div>
						<div class="form-group">
						    <label for="email" class="col-md-3 control-label">Correo electrónico:</label>
						    <div class="col-md-9">
						    	<input type="text" name="email" class="form-control" id="email" placeholder="usuario@ejemplo.com">
						    </div>
						</div>
						<div class="form-group">
						    <label for="convenio" class="col-md-3 control-label">Convenio:</label>
						    <div class="col-md-9">
						    	<p class="form-control-static">Nombre de empresa</p>
						    </div>
						</div>
						<div class="form-group">
						    <label for="beca" class="col-md-3 control-label">Beca:</label>
						    <div class="col-md-9">
						    	<p class="form-control-static">100%</p>
						    </div>
						</div>
						<div class="form-group">
						    <label for="materias" class="col-md-3 control-label">Materias a inscribir:</label>
						    <div class="col-md-9">
						    	<select class="form-control" name="num">
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
									<option>6</option>
								</select>
						    </div>
						</div>
						<div class="form-group">
						    <label for="incubadora" class="col-md-3 control-label">Incubadora:</label>
						    <div class="col-md-9">
						    	<select class="form-control" name="incubadora">
									<option>Incubadora Social Laureles</option>
									<option>Incubadora Social Sauz</option>
									<option>Incubadora Social Jocotan</option>
									<option>Desconozco su ubicación</option>
									<option>Ninguna</option>
								</select>
						    </div>
						</div>
						<div class="form-group">
							<div class="col-md-offset-3 col-md-9">
						    	<button class="btn btn-primary signIn" type="submit">Guardar registro</button>
						    </div>
						</div>
					</form>
				</div>
    		</div>
    	</div>
	</div>

	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
</body>
</html>
