<?php
	include "view.php";
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
	<script>
	function getMatricula(){
		if ($("#user").val()!=null && $("#user").val()!=""){
			console.log($("#user").val());
			$("#mat").val($("#user").val());
			$("#passEmail").submit();
		}
		else{
			$("#message").html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Alerta:</strong>Debes escribir tu matrícula para recuperar tu contraseña.</div>');
			$("#user").focus();
		}
	}
  	</script>
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
			        
					<form class="form-signin" action="crearSesion.php" method="post">
						<div id="message">
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
				        		else if($_GET["error"] === "3"){
				        			print '<div class="alert alert-danger alert-dismissable">
						        			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						        			<strong>Error:</strong> No es un periodo válido para realizar tu inscripción.
					        			</div>';
				        		}
				        	}
				        	else if(isset($_GET["passRecovery"])){
				        		if($_GET["passRecovery"] === "fail"){
				        			print '<div class="alert alert-danger alert-dismissable">
						        			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						        			<strong>Error:</strong> No se pudo recuperar tu contraseña.
					        			</div>';
				        		}
				        		else if($_GET["passRecovery"] === "failEmail"){
				        			print '<div class="alert alert-danger alert-dismissable">
						        			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						        			<strong>Error:</strong> No se puedo enviar el correo electrónico con tu nueva contraseña, vuelve a intentarlo.
					        			</div>';
				        		}
				        		else if($_GET["passRecovery"] === "userNotFound"){
				        			print '<div class="alert alert-danger alert-dismissable">
						        			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						        			<strong>Error:</strong> Tu matrícula no se encuetra en el sistema.
					        			</div>';
				        		}
				        		else if($_GET["passRecovery"] === "success"){
				        			$mail = $_GET["mail"];
				        			print '<div class="alert alert-success alert-dismissable">
						        			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						        			<strong>Éxito:</strong> Se ha enviado tu nueva contraseña al correo: '.$mail.'
					        			</div>';
				        		}
				        		

				        	}
			        	?>
			        	</div>
			        	<input id="user" type="text" name="user" class="form-control firstInput" placeholder="Matrícula" autofocus required>
			        	<input type="password" name="password" class="form-control lastInput" placeholder="Contraseña" required>
			        	<button class="btn btn-lg btn-primary btn-block signIn" type="submit">Iniciar sesión</button>
			    	</form>
			    	<div>
			    		<a class="linkPassword" href="#" onClick="getMatricula()">Recuperar contraseña</a>
			    		<form id="passEmail" method="post" action="passwordEmail.php">
        					<input type="text" id="mat" name="mat" value="" style="display:none;">
        				</form>
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
