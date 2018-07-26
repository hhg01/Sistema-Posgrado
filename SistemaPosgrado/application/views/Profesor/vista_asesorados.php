<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<style type="text/css">
		.new_color{
			background-color: #388135;
		}
		.card_color{
			background-color: #b2fac7;
		}
		.button_color{
			background-color: #FFAB00;
		}
	</style>
</head>
<body>

<div  id="vista_asesorados">
	<div class="navbar-fixed">
	  	<nav class="nav-extended new_color">
	    	<div class="nav-wrapper">
	      		<ul id="nav-mobile" class="left hide-on-med-and-down">
	      			<?php echo
	      			'<li class="tab disabled"><a>'.$profesor[0]["apellido_paterno"].' '.$profesor[0]["apellido_materno"].' '.$profesor[0]["nombres"].'</a></li>';
	      			?>
	      		</ul>
	      		<ul id="nav-mobile" class="right hide-on-med-and-down">
			        <li><a href="<?= base_url()?>">Cerrar sesión</a></li>
	      		</ul>
	    	</div>
	  	</nav>
	</div>

	<div class="conteiner">
		<div class="row">
		    <div class="col s10 m10 l10 offset-s1 offset-m1 offset-l1">
				<div class="card_color">
					
<?php 
foreach ($asesorados as $asesorado) {
	echo 
	'<div class="col s12 m6 l3">
		<div class="card card_color">
			<div class="card-image">
  				<img class="activator responsive-img" src="http://localhost:8080/SistemaPosgrado/assets/imag/man.png">
  				<a class="btn-floating halfway-fab waves-effect waves-light button_color" id="clave'.$asesorado["matricula"].'" onclick="info_alumno('.$asesorado["matricula"].')"><i class="material-icons">add</i></a>
			</div>
			<div class="card-content">
  				<label class="black-text" id="'.$asesorado["matricula"].'">'.$asesorado["apellido_paterno"].' '.$asesorado["apellido_materno"].' '.$asesorado["nombres"].'</label>
			</div>
		</div>
	</div>
	<div class="col s1 m1 l1">
	</div>';
}
?>

				</div>
			</div>
			<br>
			<a class="btn-floating btn-medium waves-effect waves-light button_color"><i class="material-icons" onclick="regresar()">reply</i></a>
		</div>
		<div class="row">
			<div class="col s12 m12 l12 black-text" style="background-color: #ffffff">
				<h5>¿Necesitas ayuda?</h5>
				<blockquote style="border-color: #FFAB00;">
					<p>
						Cada tarjeta es un alumno con su nombre.<br><br>
						Si presionas el botón <a class="btn-floating button_color"><i class="material-icons">add</i></a> podrás ver su matrícula.<br><br>
						Para regresar al menú del profesor presiona el botón <a class="btn-floating btn-medium button_color"><i class="material-icons">reply</i></a>
					</p>
				</blockquote>
			</div>
		</div>	
	</div>
</div>

<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
<script src="<?= base_url()?>assets/js/materialize.min.js"></script>
<script>
function regresar() {
	$.ajax({
    	type: "POST",
    	url: "<?= base_url()?>index.php/Profesor/ingresar",
    	data: datosProf,
      	success: function(data) {
        	$('#vista_asesorados').replaceWith(data);
        },
      	error: function (xhr, ajaxOptions, thrownError) {
            alert('Revisa bien los campos');
        }
    });
}

function info_alumno(id) {
	alert(id);
}
</script>
</body>
</html>