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
		printTopbar();
	?>
	<div class="container CScontenedor">
		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<div class="content">
					<div class="centerText">
						<h3>Editar materias</h3>
					</div>
					<div class="contenedorMaterias">
						<div class="row">
							<div class="col-md-6">
								<div class="centerText title">
									<h4>Primer cuatrimestre</h4>
								</div>
								<div id="inscritas" class="listaMaterias">
									<div>
										<div class="materia">
											<span class="textAlign">Desarrollo de habilidades básicas para el aprendizaje en línea.</span>
											<span><button class="btn btn-primary button">Actualizar</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Informática I</span>
											<span><button class="btn btn-primary button">Actualizar</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Matemáticas I</span>
											<span><button class="btn btn-primary button">Actualizar</button></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6" style="border-left:1px solid #CCC;">
								<div class="centerText title">
									<h4>Segundo cuatrimestre</h4>
								</div>
								<div id="disponibles" class="listaMaterias">
									<div>
										<div class="materia">
											<span class="textAlign">Química</span>
											<span><button class="btn btn-primary button">Actualizar</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Informática II</span>
											<span><button class="btn btn-primary button">Actualizar</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Matemáticas II</span>
											<span><button class="btn btn-primary button">Actualizar</button></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6" style="border-left:1px solid #CCC;">
								<div class="centerText title">
									<h4>Tercer cuatrimestre</h4>
								</div>
								<div id="disponibles" class="listaMaterias">
									<div>
										<div class="materia">
											<span class="textAlign">Química</span>
											<span><button class="btn btn-primary button">Actualizar</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Informática II</span>
											<span><button class="btn btn-primary button">Actualizar</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Matemáticas II</span>
											<span><button class="btn btn-primary button">Actualizar</button></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6" style="border-left:1px solid #CCC;">
								<div class="centerText title">
									<h4>Tercer cuatrimestre</h4>
								</div>
								<div id="disponibles" class="listaMaterias">
									<div>
										<div class="materia">
											<span class="textAlign">Química</span>
											<span><button class="btn btn-primary button">Actualizar</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Informática II</span>
											<span><button class="btn btn-primary button">Actualizar</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Matemáticas II</span>
											<span><button class="btn btn-primary button">Actualizar</button></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
    		</div>
    	</div>
	</div>
	
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    
</body>
</html>
