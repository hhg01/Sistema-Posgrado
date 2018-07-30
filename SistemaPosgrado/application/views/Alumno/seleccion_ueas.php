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
	background-color: #035887;
}
.card_color{
	background-color: #c4e9fe;
}
.button_color{
	background-color: #035887;		
}
.modal { 
	width: 50% !important ; 
	height: 80% !important ;
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

									<div id="modal1" class="modal modal-fixed-footer">
									    <div class="modal-content">
									      	<h4>Confirma tus UEAs</h4>
									      	<p>Revisa que la información sea correcta</p>
									      	<div class="container">
										      	<div class="responsive-table table-status-sheet">
										<table class="bordered">
											<thead>
		  										<tr>
		                							<th>Clave</th>
		                							<th>Nombre</th>
		                							<th>Creditos</th>
		  										</tr>
											</thead>
<tbody>
	<tr>
	    <td id="clave_0" type="text"></td>
	    <td id="nombre_0" type="text"></td>
	    <td id="creditos_0" type="text"></td>
	</tr>
	<tr>
	    <td id="clave_1" type="text"></td>
	    <td id="nombre_1" type="text"></td>
	    <td id="creditos_1" type="text"></td>
	</tr>
	<tr>
	    <td id="clave_2" type="text"></td>
	    <td id="nombre_2" type="text"></td>
	    <td id="creditos_2" type="text"></td>
	</tr>
	<tr>
	    <td id="clave_3" type="text"></td>
	    <td id="nombre_3" type="text"></td>
	    <td id="creditos_3" type="text"></td>
	</tr>
	<tr>
	    <td id="clave_4" type="text"></td>
	    <td id="nombre_4" type="text"></td>
	    <td id="creditos_4" type="text"></td>
	</tr>
	<tr>
	    <td id="clave_5" type="text"></td>
	    <td id="nombre_5" type="text"></td>
	    <td id="creditos_5" type="text"></td>
	</tr>
	<tr>
	    <td id="clave_6" type="text"></td>
	    <td id="nombre_6" type="text"></td>
	    <td id="creditos_6" type="text"></td>
	</tr>
	<tr>
	    <td id="clave_7" type="text"></td>
	    <td id="nombre_7" type="text"></td>
	    <td id="creditos_7" type="text"></td>
	</tr>
	<tr>
	    <td id="clave_8" type="text"></td>
	    <td id="nombre_8" type="text"></td>
	    <td id="creditos_8" type="text"></td>
	</tr>
	<tr>
	    <td id="clave_9" type="text"></td>
	    <td id="nombre_9" type="text"></td>
	    <td id="creditos_9" type="text"></td>
	</tr>
</tbody>
		  								</table>
									</div>
											</div>
									    </div>
									    <div class="modal-footer blue-grey darken-1">
									      	<a onclick="cancelar_uea()" class="modal-close btn-flat white-text">Cancelar</a>
									      	<a onclick="enviar_confirmacion()" class="modal-close btn-flat white-text">Aceptar</a>
									    </div>
									</div>

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
	    		if ($uea['clave_uea'] != 0) {
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
	  		}
			echo
		'</table>
</div>';  
?>
								</div>
							</div>
						</div>
						<a class="waves-effect waves-light btn-small button_color" type="submit" id="aceptar" onclick="confirmar_uea()">Confirmar</a>
						<br><br>
						<a class="waves-effect waves-light btn-small button_color" type="submit" id="aceptar" onclick="inscripcion_blanco()">En Blanco</a>
						<p>*Esta opción realizará una inscripción en blanco</p>
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
	if (lista_ueas.length != 0) {
		for (var i = 0; i < lista_ueas.length; i++) {
			document.getElementById("clave_"+i).innerHTML = lista_ueas[i].Clave;
			document.getElementById("nombre_"+i).innerHTML = lista_ueas[i].Nombre;
			document.getElementById("creditos_"+i).innerHTML = lista_ueas[i].Creditos;
		}
	  	document.getElementById('modal1').style.display='block';
	} else {
		alert("No has seleccionado nada\nO inscribete en blanco");
	}
}
function cancelar_uea() {
	for (var i = 0; i < lista_ueas.length; i++) {
		document.getElementById("clave_"+i).innerHTML = " ";
		document.getElementById("nombre_"+i).innerHTML = " ";
		document.getElementById("creditos_"+i).innerHTML = " ";
	}
	document.getElementById('modal1').style.display='none';
}

function enviar_confirmacion() {
	//alert("insert() y send_email()");
	$.ajax({
    	type: "POST",
      	url: "<?= base_url()?>index.php/Alumno/agregar_horario",
      	data: {"datos":datos,"ueas":lista_ueas},
      	success: function(data) {
      		alert("Información enviada. Espera respuesta");
			document.getElementById('modal1').style.display='none';
			//console.log("DENTRO DE LA VISTA ENVIAR_CONFIRMACION");
			//console.log(data);
			//document.getElementById("aceptar").disabled = true;
      		//$('#infoUeas').replaceWith(data);
      	},
      	error: function (xhr, ajaxOptions, thrownError) {
        	alert('Error al enviar la información');
      	}
    });
}

function inscripcion_blanco() {
	//alert("insert() y send_email()");
	$.ajax({
		type: "POST",
		url: "<?= base_url()?>index.php/Alumno/agregar_uea_blanco",
		data: {"datos":datos},
		success: function(data) {
      		alert("Información enviada. Espera respuesta");
			//document.getElementById('modal1').style.display='none';
			//console.log("DENTRO DE LA VISTA ENVIAR_CONFIRMACION");
			//console.log(data);
			//document.getElementById("aceptar").disabled = true
      	},
      	error: function (xhr, ajaxOptions, thrownError) {
        	alert('Error al enviar la información');
      	}
	})
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
