<?php
	include "../view.php";
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
	<link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/inscripcion.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="../js/html5shiv.js"></script>
		<script src="../js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<?php
		printTopbar();//Falta validar tipo de sesión
	?>
	<div class="container CScontenedor">
		<div class="row">
			<div class="col-md-4 col-md-offset-2">
				<div class="content">
					<div class="centerText">
						<h4 style="margin:0">Reportes</h4>
					</div>
					<hr>
					<div class="opcion">
						<span class="textAlign">Reporte de inscripción</span>
						<span><button class="btn btn-primary button" onclick="window.location.href = 'generaReporte.php?action=inscritas';">Generar</button></span>
					</div>
					<div class="opcion">
						<span class="textAlign">Reporte general de alumnos</span>
						<span><button class="btn btn-primary button" onclick="window.location.href = 'generaReporte.php?action=activos';">Generar</button></span>
					</div>
					<div class="opcion">
						<span class="textAlign">
							<input name="action" type="hidden" value="historial">
							Historial alumno
							<input id="matriculaHistorial" type="text" maxlength="9" size="14" placeholder="Matricula" required>&nbsp;
						</span>
						<span><button class="btn btn-primary button" onclick="getHistorial()">Generar</button></span>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="content">
					<div class="centerText">
						<h4 style="margin:0">Alumnos</h4>
					</div>
					<hr>
					<div class="opcion">
						<span class="textAlign">
							Agregar alumno 
						</span>
						<span><button class="btn btn-primary button" onclick="agregarAlumno()">Agregar</button></span>
					</div>
					<div class="opcion">
						<span class="textAlign">
							Editar alumno
							<input id="matriculaEditar" type="text" maxlength="9" size="14" placeholder="Matricula">
						</span>
						<span><button class="btn btn-primary button" onclick="editarAlumno()">&nbsp;&nbsp;Editar&nbsp;&nbsp;</button></span>
					</div>
					<div class="opcion">
						<span class="textAlign">
							Eliminar alumno
							<input id="matriculaEliminar" type="text" maxlength="9" size="14" placeholder="Matricula">&nbsp;
						</span>
						<span>
							<button class="btn btn-danger button" onclick="eliminarAlumno()">Eliminar</button>
						</span>
					</div>
				</div>
    		</div>
    	</div>
	</div>
	<?php
		printFooter();
	?>
	<script>
		function getHistorial(){
			var mat = $("#matriculaHistorial").val();
			window.location.href = "generaReporte.php?action=historial&matricula="+mat;
		}

		function eliminarAlumno(){
			var mat = $("#matriculaEliminar").val();
			window.location.href = "generaReporte.php?action=eliminar&matricula="+mat;	
		}

		function agregarAlumno(){
			window.location.href = "agregarAlumno.php";	
		}

		function editarAlumno(){
			var mat = $("#matriculaEditar").val();
			alert(mat);
			if(mat != "")
				window.location.href = "agregarAlumno.php?edit&matricula="+mat;	
		}
	</script>
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script> 
</body>
</html>
