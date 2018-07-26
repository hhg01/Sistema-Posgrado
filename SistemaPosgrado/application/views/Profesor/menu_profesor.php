<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
.efect {
	box-shadow: inset 0 0 20px rgba(255, 255, 255, 0);
	outline-color: rgba(255, 255, 255, .5);
	transition: all 1500ms cubic-bezier(0.19, 1, 0.22, 1);
}
.efect:hover {
	box-shadow: inset 0 0 150px rgba(255, 255, 255, 50), 0 0 20px rgba(255, 255, 255, 50);
}
.new_color{
	background-color: #035887;
}
.card_color{
	background-color: #c4e9fe;
}
</style>
</head>
<body>

<div  id="menuProfesor">
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

	<br>
	<div class="container">
		<div class="row">
			<div class="col s12 m3 l3">
	        	<div class="card efect card_color" onclick="tutorados()">
	          		<div class="card-content">
	          			<div class="container">
	          				<img class="responsive-img" src="<?= base_url()?>assets/imag/teamwork.png">
	          				<span class="card-title black-text text-lighten-5" style="text-align: center">Tutorados</span>
	          			</div>
	          		</div>
	        	</div>
	      	</div>
	      	<div class="col s1 m1 l1">
	      	</div>
	      	<div class="col s12 m3 l3">
	        	<div class="card efect card_color" onclick="asesorados()">
	          		<div class="card-content">
	          			<div class="container">
	          				<img class="responsive-img" src="<?= base_url()?>assets/imag/multiple-users-silhouette.png">
	          				<span class="card-title black-text text-lighten-5" style="text-align: center">Asesorados</span>
	          			</div>
	          		</div>
	        	</div>
	      	</div>
	      	<div class="col s1 m1 l1">
	      	</div>
	      	<div class="col s12 m3 l3">
	        	<div class="card efect card_color" onclick="ajustes()">
	          		<div class="card-content">
	          			<div class="container">
	          				<img class="responsive-img" src="<?= base_url()?>assets/imag/icon.png">
	          				<span class="card-title black-text text-lighten-5" style="text-align: center">Mis Datos</span>
	          			</div>
	          		</div>
	        	</div>
	      	</div>

	      	<div class="col s12 m3 l3">
	        	<div class="card efect card_color" onclick="confirmar()">
	          		<div class="card-content">
	          			<div class="container">
	          				<img class="responsive-img" src="<?= base_url()?>assets/imag/shopping-list.png">
	          				<span class="card-title black-text text-lighten-5" style="text-align: center">Confirmar UEAs</span>
	          			</div>
	          		</div>
	        	</div>
	      	</div>
		</div>
		<div class="row">
			<div class="col s12 m12 l12 black-text" style="background-color: #ffffff">
				<h5>¿Necesitas ayuda?</h5>
				<blockquote style="border-color: #FFAB00;">
					<p>
						Botones<br><br>
						<strong>Asesorados:</strong> Lista de alumnos a los que asesoras (incluye su información)<br>
						<strong>Tutorados:</strong> Lista de alumnos que son tus tutorados (incluye su información)<br>
						<strong>Confirmar UEAS:</strong> Acepta o declina las UEAS que han escogido tus alumnos<br>
						<strong>Ajustes:</strong> Actualiza o consulta tu información personal<br>
					</p>
				</blockquote>
			</div>
		</div>	
	</div>

</div>


<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
<script src="<?= base_url()?>assets/js/materialize.min.js"></script>
<script>
var datosProf;
$(document).ready(function(){
	var economico = <?php echo $profesor[0]["no_economico"]?>;
	var password = <?php echo $profesor[0]["password"]?>;
	datosProf = {'economico': economico, 'contraseña':password};
	//console.log(datosProf);
});

function tutorados() {
	$.ajax({
    	type: "POST",
    	url: "<?= base_url()?>index.php/Profesor/obtener_datos_tutorados",
    	data: datosProf,
      	success: function(data) {
        	$('#menuProfesor').replaceWith(data);
        },
      	error: function (xhr, ajaxOptions, thrownError) {
            alert('Error de conexión');
        }
    });
}

function asesorados() {
	$.ajax({
    	type: "POST",
    	url: "<?= base_url()?>index.php/Profesor/obtener_datos_asesorados",
    	data: datosProf,
      	success: function(data) {
        	$('#menuProfesor').replaceWith(data);
        },
      	error: function (xhr, ajaxOptions, thrownError) {
            alert('Error de conexión');
        }
    });
}

function ajustes() {
	$.ajax({
    	type: "POST",
    	url: "<?= base_url()?>index.php/Profesor/obtener_datos_profesor",
    	data: datosProf,
      	success: function(data) {
        	$('#menuProfesor').replaceWith(data);
        },
      	error: function (xhr, ajaxOptions, thrownError) {
            alert('Error de conexión');
        }
    });
}

function confirmar() {
	$.ajax({
    	type: "POST",
    	url: "<?= base_url()?>index.php/Profesor/obtener_lista_alumnos",
    	data: datosProf,
      	success: function(data) {
        	$('#menuProfesor').replaceWith(data);
        },
      	error: function (xhr, ajaxOptions, thrownError) {
            alert('Error de conexión');
        }
    });
}
</script>
</body>
</html>