<?php
	include "../view.php";
	validarSession("admin");
	$url = "agregar";
	$matricula = $nombre = $apellidoP = $apellidoM = $telefono = $beca = $correo = $convenio = $incubadora = "";
	if(isset($_GET["edit"])){
		$matricula = $_GET["matricula"];
		$url = "editar&matricula=".$matricula;
		$datos = getDatosAlumno($_GET["matricula"]);

		if($datos["Matricula"] == "") header("Location: index.php");

		$nombre = $datos["Nombre"];
		$apellidoP = $datos["ApellidoP"];
		$apellidoM = $datos["ApellidoM"];
		$telefono = $datos["Telefono"];
		$beca = $datos["PBeca"];
		$convenio = $datos["Convenio"];
		$correo = $datos["Mail"];
		$incubadora = $datos["Incubadora"];
	}

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
	<link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="../js/html5shiv.js"></script>
		<script src="../js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<?php
		printTopbar();
	?>
	<div class="container CScontenedor">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="content">
					<div class="centerText">
						<h3>Editar alumno</h3>
					</div>
					<form class="form-horizontal" role="form" action="generaReporte.php?action=<?php echo $url; ?>" method="post">
					  	<div class="form-group">
					    	<label for="matricula" class="col-md-3 control-label">Matricula:</label>
					    	<div class="col-md-9">
					    		<?php 
					    			if($matricula === ""){
					    				echo '<input type="text" name="matricula" class="form-control" id="matricula">';
					    			}
					    			else{
					    				echo '<p class="form-control-static">'.$matricula.'</p>';
					    			}
					    		?>
					    	</div>
					  	</div>
					  	<div class="form-group">
					    	<label for="nombre" class="col-md-3 control-label">Nombre:</label>
					    	<div class="col-md-9">
					      		<input type="text" name="nombre" class="form-control" id="nombre" value="<? echo $nombre ?>">
					    	</div>
					  	</div>
					  	<div class="form-group">
					    	<label for="apellidoP" class="col-md-3 control-label">Apellido Paterno:</label>
					    	<div class="col-md-9">
					      		<input type="text" name="apellidoP" class="form-control" id="apellidoP" value="<? echo $apellidoP ?>">
					    	</div>
					  	</div>
					  	<div class="form-group">
					    	<label for="apellidoM" class="col-md-3 control-label">Apellido Materno:</label>
					    	<div class="col-md-9">
					      		<input type="text" name="apellidoM" class="form-control" id="apellidoM" value="<? echo $apellidoM ?>">
					    	</div>
					  	</div>
						<div class="form-group">
						    <label for="telefono" class="col-md-3 control-label">Teléfono:</label>
						    <div class="col-md-9">
						    	<input type="text" name="telefono" class="form-control" id="telefono" value="<? echo $telefono ?>">
						    </div>
						</div>
						<div class="form-group">
						    <label for="beca" class="col-md-3 control-label">Beca:</label>
						    <div class="col-md-9">
						    	<input type="text" name="beca" class="form-control" id="beca" placeholder="0-100%" value="<? echo $beca ?>">
						    </div>
						</div>
						<div class="form-group">
						    <label for="convenio" class="col-md-3 control-label">Convenio:</label>
						    <div class="col-md-9">
						    	<input type="text" name="convenio" class="form-control" id="convenio" value="<? echo $convenio ?>">
						    </div>
						</div>
						<div class="form-group">
						    <label for="email" class="col-md-3 control-label">Correo electrónico:</label>
						    <div class="col-md-9">
						    	<input type="text" name="email" class="form-control" id="email" value="<? echo $correo ?>">
						    </div>
						</div>
						<div class="form-group">
						    <label for="incubadora" class="col-md-3 control-label">Incubadora a la que asisto para asesorias:</label>
						    <div class="col-md-9">
						    	<select class="form-control" name="incubadora">
						    		<?php
						    			if($incubadora !== ""){
						    				echo '<option value="'.$incubadora.'" >'.$incubadora.'</option>';
						    			}
						    		?>
						    		<option value="Ninguna" >Ninguna</option>
									<option value="Incubadora Social Laureles" >Incubadora Social Laureles</option>
									<option value="Incubadora Social Sauz" >Incubadora Social Sauz</option>
									<option value="Incubadora Social Jocotan" >Incubadora Social Jocotan</option>
								</select>
						    </div>
						</div>
						<div class="form-group">
							<div class="col-md-offset-3 col-md-9">
						    	<button class="btn btn-primary signIn" type="submit">Guardar</button>
						    </div>
						</div>
					</form>	
				</div>
    		</div>
    	</div>
	</div>
	<?php
		printFooter();
	?>
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script> 
</body>
</html>
