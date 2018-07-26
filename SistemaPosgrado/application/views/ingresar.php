<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UFT-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/materialize.min.css">
	<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
  	<script src="<?= base_url()?>assets/js/materialize.min.js"></script>
	<title>Posgrado UAM</title>
<style>
.card {
    border-radius: 50%;
   
}
.color{
	background: #388135;
}
.fondo{
	background: #71c46e;
}
</style>
</head>

<body id="contenido">
		<!--Botones de acceso-->
	<div class="container z-depth-3" style="background-color: white;">
		<div class="row"><!--Logo y mensaje de bienvenida-->
			<br>
				<div class="col s12 m12 l12 center">
					<img src="<?= base_url()?>assets/imag/PCyTI.png" class="resposive-img" width="210px">
					<br>
					<h4><strong>Bienvenido al Sistema</strong></h4>
    			</div>
		</div>
		<br>
		<div class="row">
			<div class="col s12 m1 l1"></div>
			<div class="col s12 m3 l3">
				<a style="display:block" href="http://localhost:8080/SistemaPosgrado/index.php/Ingresar/ingresar_alumno">
		        	<div class="card fondo hoverable">
		          		<div class="card-content">
		          			<div class="container">
		          				<img class="circle responsive-img" src="<?= base_url()?>assets/imag/study.png" href="">
		          				<span class="card-title blue-text text-lighten-5" style="text-align: center"><strong>Alumnos</strong></span>
		          			</div>
		          		</div>
		        	</div>
	        	</a>
	      	</div>
	      	<div class="col s12 m4 l4"></div>
	      	<div class="col s12 m3 l3">
	      		<a style="display:block" href="http://localhost:8080/SistemaPosgrado/index.php/Ingresar/ingresar_profesor">
		        	<div class="card efect fondo hoverable">
		          		<div class="card-content">
		          			<div class="container">
		          				<img class="circle responsive-img" src="<?= base_url()?>assets/imag/teacher.png">
		          				<span class="card-title blue-text text-lighten-5" style="text-align: center"><strong>Profesores</strong></span>
		          			</div>
		          		</div>
		        	</div>
		        </a>
	      	</div>
		</div>
	</div>

	<br>
	<footer class="page-footer color">
      	<div class="footer-copyright">
        	<div class="container">
        		© 2018 Copyright
        	<a class="grey-text text-lighten-4 right" href="#!">UAM</a>
        	</div>
      	</div>
    </footer>

<script src="<?= base_url()?>assets/js/materialize.min.js"></script>
</body>
</html>
