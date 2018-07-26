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
<style>
.color{
	background: #035887;
}
.fondo{
	background: #035887;
}
</style>
</head>

<body id="contenido">
	<br>
	<div class="row">
		<div class="col s1 m1 l1"></div>
		<div class="col s4 m4 l4">
      		<div class="card color">
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
    	<div class="col s1 m1 l1"></div>
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
					<a class="waves-effect waves-light btn-large fondo" type="submit" name="action" id="ingresar" onclick="ingresar_alumnos()">Ingresar</a>
				</div>
			</div>
		</div>
	</div>
</body>

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
</script>
</body>
</html>