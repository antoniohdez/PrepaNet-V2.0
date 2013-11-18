<?php
	include "DOMElements/view.php";
	validarSession("login");
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
    <link href="css/form.css" rel="stylesheet">
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
			<div class="col-md-offset-4 col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading centerText">
			        	Sistema de inscripciones
			        </div>
			        
					<form class="form-signin" action="index.php" method="post">
						<?php
				        	if(isset($_GET["error"])){
				        		if($_GET["error"] === "1"){
				        			print '<div class="alert alert-danger alert-dismissable">
					        				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					        				<strong>Error:</strong> Los datos de acceso no son correctos.
				        				</div>';
				        		}
				        		else if($_GET["error"] === "2"){
				        			print '<div class="alert alert-danger alert-dismissable">
						        			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						        			<strong>Error:</strong> No se pudo consultar el usuario en la base de datos.
					        			</div>';
				        		}
				        	}
			        	?>
			        	<input type="text" name="user" class="form-control firstInput" placeholder="Matrícula" autofocus required>
			        	<input type="password" name="password" class="form-control lastInput" placeholder="Contraseña" required>
			        	<button class="btn btn-lg btn-primary btn-block signIn" type="submit">Iniciar sesión</button>
			    	</form>
			    	<div>
			    		<a class="linkPassword" href="#" onClick="">Recuperar contraseña</a>
			    	</div>
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
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
</body>
</html>
