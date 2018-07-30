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

	      	<?php 
	      		if ($profesor[0]['bandera'] == 0) {
	      			echo'
	      	<div id="modal2" class="modal modal-fixed-footer" style="display: block">
				<div class="modal-content">
					<p><h5>Cambio de contraseña</h5></p>
					<div class="container">
						<div class="row">
							<p>Por motivos de seguridad, es necesario que cambies tu contraseña</p>
							<div class="col s12 ">
							    <label>
							    	<h6>Introduce la contraseña anterior</h6>
							      	<input type="password" name="contrasena_actual" id="contrasena_actual" style="border: none" value="">
							    </label>
							    <label>
							      	<h6>Introduce la nueva contraseña</h6>
							      	<input type="password" name="contrasena_nueva_confirm" id="contrasena_nueva_confirm" style="border: none" value="">
							    </label>
							     <label>
							      	<h6>Confirma la nueva contraseña</h6>
							      	<input type="password" name="contrasena_nueva" id="contrasena_nueva" style="border: none" value="">
							    </label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer blue-grey darken-1">
					<a class="modal-close btn-flat white-text" onclick="guardar_contrasena()">Aceptar</a>
				</div>
			</div>';
	      		}
			?>


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

function guardar_contrasena(){
	var contrasena_actual = document.getElementById('contrasena_actual').value,
		contrasena_nueva = document.getElementById('contrasena_nueva').value,
		contrasena_nueva_confirm = document.getElementById('contrasena_nueva_confirm').value;
		if(contrasena_actual != <?php echo $profesor[0]['password'];?>){
			alert("La contraseña actual no coincide con la que tienes registrada");
		} else if(contrasena_nueva == <?php echo $profesor[0]['password'];?> || contrasena_actual == '' || contrasena_nueva == ''){
			alert("Introduce una contraseña nueva");
		} else if(contrasena_nueva != contrasena_nueva_confirm){
			alert("Los campos de nueva contraseña y nueva confirmación");
		} else {
			$.ajax({
				type: "POST",
    			url: "<?= base_url()?>index.php/Profesor/cambiar_contrasena",
    			data: {"contrasena_nueva": contrasena_nueva, "datosProf": datosProf},
      			success: function(data) {
        			alert("Tu contraseña ha sido cambiada");
        			console.log(data);
        		},
      			error: function (xhr, ajaxOptions, thrownError) {
            		alert('Error de conexión');
       		}
			});
			document.getElementById('modal2').style.display='none';

			 
			//	$mensaje = '<p>¡Hola! Has hecho una solicitud para cambiar tu contraseña.</p>
			//				<p>Tu nueva contraseña es: '.contrasena_nueva.'</p>'
			//	mail($alumno_info_personal[0]['email'], "Actualización de contraseña", message);
			
		}

}
</script>
</body>
</html>