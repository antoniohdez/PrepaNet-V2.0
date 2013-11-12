<?php
	
	include "DOMElements/view.php";
	validarSession("admin");
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
    <link href="css/admin.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<?php
		printTopbar();//Falta validar tipo de sesión
	?>
	<div class="container CScontenedor">
		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<div class="content">
					<div class="centerText">
						<h3>Generar reportes</h3>
					</div>
					<div class="row">
						<div class="col-md-3 centerText">
							<div class="option">
								<div id="inscripcion" class="centradoVertical">Inscripción</div>
							</div>
						</div>
						<div class="col-md-3 centerText">
							<div class="option">
								<div class="centradoVertical">Alumno</div>
							</div>
						</div>
						<div class="col-md-3 centerText">
							<div class="option">
								<div class="centradoVertical">Alumnos activos</div>
							</div>
						</div>
						<div class="col-md-3 centerText">
							<div class="option">
								<div class="centradoVertical">Cursadas por alumno</div>
							</div>
						</div>
					</div>
					<div class="centerText">

					</div>
				</div>
				
    		</div>
    	</div>
	</div>

	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script type="text/javascript">
    	$("#inscripcion").click(function(){
    		window.location.replace("generaReporte.php");
    	});
    </script>
</body>
</html>
