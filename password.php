<?php
	include "DOMElements/view.php";
	validarSession("any");
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
			<div class="col-md-offset-3 col-md-6">
				<div class="content">
					<div class="centerText">
						<h3>Cambio de Contraseña</h3>
					</div>
					<?php
						printErrorGet();
					?>
					<form class="form-horizontal" role="form" action="setNewPassword.php" method="post">
						<div class="form-group">
						    <label for="oldPassword" class="col-md-3 control-label">Contraseña Actual:</label>
						    <div class="col-md-9">
						    	<input type="password" name="oldPassword" class="form-control" id="oldPassword" required placeholder="Introduce tu Contraseña actual">
						    </div>
						</div>
						<div class="form-group">
						    <label for="newPassword" class="col-md-3 control-label">Nueva Contraseña:</label>
						    <div class="col-md-9">
						    	<input type="password" name="newPassword" class="form-control" id="newPassword" required placeholder="Introduce tu nueva Contraseña">
						    </div>
						</div>
						<div class="form-group">
						    <label for="newPassword2" class="col-md-3 control-label">Confirma Contraseña:</label>
						    <div class="col-md-9">
						    	<input type="password" name="newPassword2" class="form-control" id="newPassword2" required placeholder="Introduce tu nueva Contraseña">
						    </div>
						</div>
						<div class="form-group">
							<div class="col-md-offset-3 col-md-9">
						    	<button class="btn btn-primary signIn" type="submit">Guardar Contraseña</button>
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