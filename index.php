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
		printTopbar();//Falta validar tipo de sesión
	?>
	<div class="container CScontenedor">
		<div class="row">
			<div class="col-md-3">
				<div class="content">
					<?php
						printProgress();
					?>
				</div>
			</div>
			<div class="col-md-9">
				<?php
					printIndex();//Falta validar tipo de sesión
				?>
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
