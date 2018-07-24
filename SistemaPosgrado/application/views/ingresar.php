<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/materialize.min.css">
	<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
  	<script src="<?= base_url()?>assets/js/materialize.min.js"></script>
	<title>Posgrado UAMI</title>
</head>

<body id="contenido">
	<div class="row">

		<div class="col s4 m4 l4">
      		<div class="card blue-grey darken-1">
        		<div class="card-content white-text">
          			<p>ALUMNOS</p>
          			<p>La contraseña está formada por la clave de unidad y la fecha de nacimiento:</p>
      				<ul>
      					<li>1 Azcapotzalco</li>
      					<li>2 Iztapalapa</li>
      					<li>3 Xochimilco</li>
      					<li>4 Cuajimalpa</li>
      				</ul>
          		<img class="responsive-img" src="<?= base_url()?>assets/imag/contRapida.png">
        		</div>
      		</div>
    	</div>

		<div class="col s4 m4 l4">
			<div class="card">
				<div class="card-content">
            		<span class="card-title">Alumnos</span>
					<div class="row">
  						<div class="input-field col s12 m12 l12">
    						<input id="matricula" type="text" class="validate">
    						<label for="matricula">Matricula</label>
  						</div>
  						<div class="input-field col s12 m12 l12">
    						<input id="password" type="password" class="validate">
    						<label for="password">Contraseña</label>
  						</div>
  					</div>
				</div>
				<div class="card-action">
					<a class="waves-effect waves-light btn-large blue-grey lighten-1" type="submit" name="action" id="ingresar" onclick="ingresar_alumnos()">Ingresar</a>
				</div>
			</div>
		</div>
      	
      	<div class="col s4 m4 l4">
        	<div class="card">
          		<div class="card-content">
            		<span class="card-title">Profesores</span>
            		<div class="row">
                		<div class="input-field col s12 m12 l12">
                    		<input id="economico" type="text" class="validate">
                    		<label for="economico">No. Económico</label>
                		</div>
                		<div class="input-field col s12 m12 l12">
                    		<input id="passwordNo" type="password" class="validate">
                    		<label for="passwordNo">Contraseña</label>
                		</div>
            		</div>
          		</div>
          		<div class="card-action">
            		<a class="waves-effect waves-light btn-large blue-grey lighten-1" type="submit" name="action" id="ingresar" onclick="ingresar_profesores()">Ingresar</a>
          		</div>
        	</div>
      	</div>
	</div>

<script>
function ingresar_alumnos(){
	var matricula = document.getElementById('matricula').value;
	var password = document.getElementById('password').value;

	if (matricula !== '' && password !== '') {
	  	var datos={
	    	"matricula": matricula,
	    	"contraseña": password
	  	};
	    $.ajax({
	    	type: "POST",
	      	url: "<?= base_url()?>index.php/Alumno/obtener_informacion",
	      	data: datos,
	      	success: function(data) {
	      		$('#contenido').replaceWith(data);
	      	},
	      	error: function (xhr, ajaxOptions, thrownError) {
	        	alert('Revisa bien los campos');
	      	}
	    });
	} else {
  		alert("Te falta algún campo");  
	}
}

function ingresar_profesores(){
	var economico = document.getElementById('economico').value;
	var password_no = document.getElementById('passwordNo').value;

	if (economico !== '' && password_no !== '') {
	  	var datos={
	    	"economico": economico,
	    	"contraseña": password_no
	  	};
	  	$.ajax({
	    	type: "POST",
	    	url: "<?= base_url()?>index.php/Profesor/ingresar",
	    	data: datos,
	    	success: function(data) {
	      		$('#contenido').replaceWith(data);
	    	},
	    	error: function (xhr, ajaxOptions, thrownError) {
	      		alert('Revisa bien los campos');
	    	}
	  	});
	} else {
  		alert("Te falta algún campo");  
	}
}
</script>
</body>
</html>