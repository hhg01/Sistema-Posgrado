<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UFT-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="http://localhost/SistemaPosgrado/assets/css/materialize.min.css">
	<script src="http://localhost/SistemaPosgrado/assets/js/jquery.min.js"></script>
  	<script src="http://localhost/SistemaPosgrado/assets/js/materialize.min.js"></script>
	<title>Posgrado UAM</title>
<style>
.diseño {
   position: fixed;
   bottom: 0;
   width: 100%;
   background-color: #035887;
}
.circle{
  position:relative;
  width:100%;
  padding-bottom:100%;
  background: #71c46e;
  border-radius:50%;
}
.circle img{
  position:absolute;
  top:50%;
  left:50%;
  transform: translate(-50%, -50%);
  margin:0;
}
</style>
</head>

<body id="contenido">

	<div class="row">
		<div class="col s12 m12 l12 center">
			<a href="http://pcyti.izt.uam.mx/" target="_blank">
				<img src="http://localhost/SistemaPosgrado/assets/imag/logo_pcyti_small.png" class="resposive-img">
			</a>
			<h2>Bienvenido</h2>
    	</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col s12 m1 l1"></div>
			<div class="col s12 m3 l3">
	      		<a style="display:block" href="http://localhost/SistemaPosgrado/index.php/Ingresar/ingresar_alumno">
		        	<div>
		          		<div class="card-content">
		          			<div class="circle">
		          				<img class="circleimg responsive-img" src="http://localhost/SistemaPosgrado/assets/imag/study.png">
		          			</div>
		          		</div>
		          		<div class="card-action center-align black-text">
				          	<p><strong>Alumnos</strong></p>
        				</div>
		        	</div>
		        </a>
	      	</div>
	      	<div class="col s12 m4 l4"></div>
	      	<div class="col s12 m3 l3">
	      		<a style="display:block" href="http://localhost/SistemaPosgrado/index.php/Ingresar/ingresar_profesor">
		        	<div>
		          		<div class="card-content">
		          			<div class="circle">
		          				<img class="circleimg responsive-img" src="http://localhost/SistemaPosgrado/assets/imag/teacher.png">
		          			</div>
		          		</div>
		          		<div class="card-action center-align black-text">
				          	<p><strong>Profesores/Admin</strong></p>
        				</div>
		        	</div>
		        </a>
	      	</div>
		</div>
	</div>
	
	<footer class="page-footer diseño">
      	<div class="footer-copyright">
        	<div class="container">
        		© 2018 Copyright
        	<a class="grey-text text-lighten-4 right" href="http://www.izt.uam.mx/" target="_blank">UAM-I</a>
        	</div>
      	</div>
    </footer>

<script src="http://localhost/SistemaPosgrado/assets/js/materialize.min.js"></script>
</body>
</html>