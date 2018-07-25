<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<div  id="vista_asesorados">
	<div class="navbar-fixed">
	  	<nav class="nav-extended blue-grey darken-1">
	    	<div class="nav-wrapper">
	      		<ul id="nav-mobile" class="left hide-on-med-and-down">
	      			<?echo
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
				<div class="blue-grey lighten-4">
					
<? 
foreach ($asesorados as $asesorado) {
	echo 
	'<div class="col s12 m6 l3">
		<div class="card blue-grey lighten-4">
			<div class="card-image">
  				<img class="activator responsive-img" src="http://localhost/SistemaPosgrado/assets/imag/man.png">
  				<a class="btn-floating halfway-fab waves-effect waves-light blue" id="clave'.$asesorado["matricula"].'" onclick="info_alumno('.$asesorado["matricula"].')"><i class="material-icons">add</i></a>
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
			<a class="btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons" onclick="regresar()">reply</i></a>
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