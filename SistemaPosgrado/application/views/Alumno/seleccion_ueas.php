<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<style>
.contenedor_scroll{
	height: 360px;
	overflow: scroll;
}
.new_color{
	background-color: #388135;
}
.card_color{
	background-color: #b2fac7;
}
.button_color{
	background-color: #00C853;		
}

</style>
<body>

<div id="infoUeas">
	<div class="navbar-fixed">
	  	<nav class="nav-extended new_color">
	    	<div class="nav-wrapper">
	      		<ul id="nav-mobile" class="left hide-on-med-and-down">
	        		<li><a onclick="info_alumno()">Información Personal</a></li>
			        <li><a onclick="info_academica()">Información Academica</a></li>
			        <li><a class="active">Inscripción</a></li>
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
				<div class="card card_color">
					<div class="card-content">
						<span class="card-title">Elige tus UEAs</span>

						<div class="col s12 m12 l12">
							<div class="card card_color contenedor_scroll">
								<div class="card-content">
<?php echo 
'<div class="responsive-table table-status-sheet">
		<table class="bordered">
			<thead>
	  			<tr>
	                <th>Clave de UEA</th>
	                <th>Nombre UEA</th>
	                <th>Creditos</th>
	  			</tr>
			</thead>';
	  		foreach ($ueas as &$uea) {
	    	echo
	    	'<tbody>
	      		<tr id="clave'.$uea["clave_uea"].'">
	                <td><id="clave_uea" type="text">'.$uea["clave_uea"].'</td>
	                <td><id="nombre_uea" type="text">'.$uea["nombre"].'</td>
	                <td><id="creditos_uea" type="text">'.$uea["creditos"].'</td>

	                <td><label><input type="checkbox" class="filled-in" id="caja'.$uea["clave_uea"].'" onclick="egregar_quitar_uea('.$uea["clave_uea"].')"/><span>Agregar</span></label></td>
	      		</tr>
	    	</tbody>';
	  		}
			echo
		'</table>
</div>';  
?>
								</div>
							</div>
						</div>
						<a class="waves-effect waves-light btn-small button_color" type="submit" id="aceptar" onclick="confirmar_uea()">Confirmar</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12 m12 l12 black-text" style="background-color: #ffffff">
				<h5>¿Necesitas ayuda?</h5>
				<blockquote style="border-color: #FFAB00;">
					<p>
						Para seleccionar una UEA solamente marca el recuadro "Agregar".
						<br>
						Una vez que hayas escogido las de tu interés presiona en el botón "Confirmar".
					</p>
				</blockquote>
			</div>
		</div>	
	</div>

</div>

<footer class="page-footer" style="background-color: #ffffff">
	<div class="container">
		
	</div>
</footer>

<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
<script src="<?= base_url()?>assets/js/materialize.min.js"></script>
<script>
var lista_ueas = new Array();

function egregar_quitar_uea(id){
	var checkBox = document.getElementById('caja'+id);
	var Row = document.getElementById('clave'+id);
	var Cells = Row.getElementsByTagName("td");

	var nombre = Cells[1].innerText;
	var creditos = Cells[2].innerText;
	var materia = { 'Clave': id, 'Nombre': nombre, 'Creditos': creditos};

	if(checkBox.checked == true){
		lista_ueas.push(materia);
	}else{
		var index = lista_ueas.map(function(o){ return o.Clave; }).indexOf(id);
		lista_ueas.splice(index, 1);
	}
}

function confirmar_uea(){
  	console.log(lista_ueas);
}

function info_alumno(){
    $.ajax({
    	type: "POST",
      	url: "<?= base_url()?>index.php/Alumno/obtener_informacion",
      	data: datos,
      	success: function(data) {
      		$('#infoUeas').replaceWith(data);
      	},
      	error: function (xhr, ajaxOptions, thrownError) {
        	alert('No se encontraron datos');
      	}
    });
}

function info_academica(){
	$.ajax({
    	type: "POST",
        url: "<?= base_url()?>index.php/Alumno/obtener_informacion_academica",
        data: datos,
        success: function(data) {
	        $('#infoUeas').replaceWith(data);
        },
      	error: function (xhr, ajaxOptions, thrownError) {
        	alert('No se encontraron datos');
        }
    });
}
</script>
</body>
</html>