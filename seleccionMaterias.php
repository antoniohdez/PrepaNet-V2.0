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
    <link href="css/inscripcion.css" rel="stylesheet">
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
						<h3>Selección de materias</h3>
					</div>
					<div class="contenedorMaterias">
						<div class="row">
							<div class="col-md-6">
								<div class="centerText title">
									<h4>Inscritas</h4>
								</div>
								<div id="inscritas" class="listaMaterias">
									<div>
										<div class="materia">
											<span class="textAlign">Matemáticas I</span>
											<span><button class="btn btn-danger button">Eliminar</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Química</span>
											<span><button class="btn btn-danger button">Eliminar</button></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6" style="border-left:1px solid #CCC;">
								<div class="centerText title">
									<h4>Disponibles</h4>
								</div>
								<div id="disponibles" class="listaMaterias">
									<div>
										<div class="materia">
											<span class="textAlign">Inglés II</span>
											<span><button class="btn btn-success button">Inscribir</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Historia de México</span>
											<span><button class="btn btn-success button">Inscribir</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Física I</span>
											<span><button class="btn btn-success button">Inscribir</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Ética</span>
											<span><button class="btn btn-success button">Inscribir</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Computación I</span>
											<span><button class="btn btn-success button">Inscribir</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Taller de lectura y redacción</span>
											<span><button class="btn btn-success button">Inscribir</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Biología</span>
											<span><button class="btn btn-success button">Inscribir</button></span>
										</div>
									</div>
									<div>
										<div class="materia">
											<span class="textAlign">Introducción a la administración</span>
											<span><button class="btn btn-success button">Inscribir</button></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					<div class="centerText">
						<button class="btn btn-primary signIn" type="submit">Registrar materias</button>
					</div>
				</div>
    		</div>
    	</div>
	</div>

	
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
	//Script para hacer control de las materias seleccionadas para inscripción
	$(document).ready(function(){
		$("button").click(function(){
			//A partir del boton donde se dió click se obtiene el elemento padre que se va a mover.
	    	var $old = $(this).parent().parent().parent();
	    	if($old.parent().attr('id') === "disponibles" || $old.parent().attr('id') === "inscritas"){
		    	var width = $old.width();
		    	//var $old = $(this).parent().parent().parent();
		    	if($old.parent().attr('id') === "disponibles"){
			    	$(this).removeClass("btn-success").addClass("btn-danger");
			    	$(this).html("Eliminar");
					//First we copy the arrow to the new table cell and get the offset to the document
					var $new = $old.clone(true).appendTo('#inscritas');
				}else{
					$(this).removeClass("btn-danger").addClass("btn-success");
			    	$(this).html("Inscribir");
					//First we copy the arrow to the new table cell and get the offset to the document
					var $new = $old.clone(true).appendTo('#disponibles');
				}
				//addthis.button(this);
				var newOffset = $new.offset();
				//Get the old position relative to document
				var oldOffset = $old.offset();
				//we also clone old to the document for the animation
				var $temp = $old.clone().appendTo('body');
				//hide new and old and move $temp to position
				//also big z-index, make sure to edit this to something that works with the page
				$temp
				  .css('position', 'absolute')
				  .css('left', oldOffset.left)
				  .css('top', oldOffset.top)
				  .css('width', width)
				  .css('zIndex', 100);
				$new.hide();
				$old.hide();
				//animate the $temp to the position of the new img
				$temp.animate( {'top': newOffset.top, 'left':newOffset.left}, 'slow', function(){
				   //callback function, we remove $old and $temp and show $new
				   $new.show();
				   $old.remove();
				   $temp.remove();
				});
			}
	    });
	});
    </script> 
</body>
</html>
