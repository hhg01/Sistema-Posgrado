<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<div id="infoAlumno">
	<div class="navbar-fixed">
	  	<nav class="nav-extended blue-grey darken-1">
	    	<div class="nav-wrapper">
	      		<ul id="nav-mobile" class="left hide-on-med-and-down">
	        		<li><a class="active">Información Personal</a></li>
			        <li><a onclick="info_academica()">Información Academica</a></li>
			        <li><a onclick="inscripcion()">Inscripción</a></li>
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
				<div class="card blue-grey lighten-4">
					<div class="card-content">

						<div id="modal1" class="modal modal-fixed-footer">
						    <div class="modal-content">
						      	<h4>Confirma los cambios</h4>
						      	<p>Revisa que la información sea correcta</p>
						      	<div class="container">
							      	<div class="responsive-table table-status-sheet">
										<table class="bordered">
											<thead>
		  										<tr>
		                							<th>Tus Datos</th>
		                							<th>por</th>
		                							<th>Datos Nuevos</th>
		  										</tr>
											</thead>
<tbody>
	<tr>
	    <td id="mi_email" type="text"><?echo $alumno_info_personal[0]["email"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_email" type="text"></td>
	</tr>
	<tr>
	    <td id="mi_telefono" type="text"><?echo $alumno_info_personal[0]["telefono"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_telefono" type="text"></td>
	</tr>
	<tr>
	    <td id="mi_celular" type="text"><?echo $alumno_info_personal[0]["celular"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_celular" type="text"></td>
	</tr>
	<tr>
	    <td id="mi_vialidad" type="text"><?echo $alumno_info_personal[0]["vialidad"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_vialidad" type="text"></td>
	</tr>
	<tr>
	    <td id="mi_exterior" type="text"><?echo $alumno_info_personal[0]["exterior"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_exterior" type="text"></td>
	</tr>
	<tr>
	    <td id="mi_interior" type="text"><?echo $alumno_info_personal[0]["interior"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_interior" type="text"></td>
	</tr>
	<tr>
	    <td id="mi_cp" type="text"><?echo $alumno_info_personal[0]["cp"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_cp" type="text"></td>
	</tr>
	<tr>
	    <td id="mi_localidad" type="text"><?echo $alumno_info_personal[0]["localidad"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_localidad" type="text"></td>
	</tr>
</tbody>
		  								</table>
									</div>
								</div>
						    </div>
						    <div class="modal-footer blue-grey darken-1">
						      	<a onclick="document.getElementById('modal1').style.display='none'" class="modal-close btn-flat white-text">Cancelar</a>
						      	<a class="modal-close btn-flat white-text" onclick="guardar_info()">Aceptar</a>
						    </div>
						</div>

						<span class="card-title">Información Personal</span>
<? echo 
'<div class="conteiner">
	<div class="row">
		<div class="col s4 m4 l4">
			<div class="card-content">
				<label>Nombre:</label><input type="text" id="nombre" readonly=”readonly” style="border:none" name="nombre" value="'.$alumno_info_personal[0]["apellido_paterno"].' '.$alumno_info_personal[0]["apellido_materno"].' '.$alumno_info_personal[0]["nombres"].'">
				<label>Correo Electronico:</label><input type="text" id="correo_electronico" name="correo_electronico" value="'.$alumno_info_personal[0]["email"].'">
				<label>Telefono:</label><input type="text" id="telefono" name="telefono" value="'.$alumno_info_personal[0]["telefono"].'">
				<label>Celular:</label><input type="text" id="celular" name="celular" value="'.$alumno_info_personal[0]["celular"].'">
			</div>
		</div>
		<div class="col s4 m4 l4">
			<div class="card-content">
				<label>Nacionalidad:</label><input type="text" id="nacionalidad" readonly=”readonly” style="border:none"  name="nacionalidad" value="'.$alumno_info_personal[0]["nacionalidad"].'">
				<label>Fecha Nacimiento:</label><input type="text" id="fecha_nacimiento" readonly=”readonly” style="border:none"  name="fecha_nacimiento" value="'.$alumno_info_personal[0]["fecha_nacimiento"].'">';

				if ($alumno_info_personal[0]["genero"] == "M") {
					echo '<label>Género:</label><input type="text" id="genero" readonly=”readonly” style="border:none"  name="genero" value="Femenino">';
				} else {
					echo '<label>Género:</label><input type="text" id="genero" readonly=”readonly” style="border:none"  name="genero" value="Masculino">';
				}
			echo
			'</div>
		</div>
		<div class="col s4 m4 l4">
			<div class="card-content">
				<p>Dirección</p><br>
				<label>Vialidad:</label><input type="text" id="vialidad" name="vialidad" value="'.$alumno_info_personal[0]["vialidad"].'">
				<label># exterior:</label><input type="text" id="exterior" name="exterior" value="'.$alumno_info_personal[0]["exterior"].'">
				<label># interior:</label><input type="text" id="interior" name="interior" value="'.$alumno_info_personal[0]["interior"].'">
				<label>CP:</label><input type="text" id="cp" name="cp" value="'.$alumno_info_personal[0]["cp"].'">
				<label>Localidad/Colonia:</label><input type="text" id="localidad" name="localidad" value="'.$alumno_info_personal[0]["localidad"].'">
			</div>
		</div>
	</div>
</div>';
?>
					</div>
				</div>
			</div>
			<br>
			<a class="btn-floating btn-medium blue"><i class="material-icons" onclick="cargar_info_modal()">archive</i></a>
		</div>
	</div>

</div>

<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
<script src="<?= base_url()?>assets/js/materialize.min.js"></script>
<script>
var datos;
$(document).ready(function(){
	var matricula = <?echo $alumno_info_personal[0]["matricula"]?>;
	var password = <?echo $alumno_info_personal[0]["password"]?>;
	var nivel = '<?echo $alumno_info_personal[0]["nivel"]?>';
	datos = {'matricula': matricula, 'nivel': nivel, 'contraseña':password};
	//console.log(email_bd);
});

function cargar_info_modal() {
	var email = document.getElementById('correo_electronico').value;
	var telefono = document.getElementById('telefono').value;
	var celular = document.getElementById('celular').value;
	var vialidad = document.getElementById('vialidad').value;;
	var exterior = document.getElementById('exterior').value;;
	var interior = document.getElementById('interior').value;;
	var cp = document.getElementById('cp').value;;
	var localidad = document.getElementById('localidad').value;;

	var email_bd = '<?echo $alumno_info_personal[0]["email"]?>';
	var telefono_bd = '<?echo $alumno_info_personal[0]["telefono"]?>';
	var celular_bd = '<?echo $alumno_info_personal[0]["celular"]?>';
	var vialidad_bd = '<?echo $alumno_info_personal[0]["vialidad"]?>';
	var exterior_bd = '<?echo $alumno_info_personal[0]["exterior"]?>';
	var interior_bd = '<?echo $alumno_info_personal[0]["interior"]?>';
	var cp_bd = '<?echo $alumno_info_personal[0]["cp"]?>';
	var localidad_bd = '<?echo $alumno_info_personal[0]["localidad"]?>';

	if (email==email_bd && telefono==telefono_bd && celular==celular_bd && vialidad==vialidad_bd && exterior==exterior_bd && interior==interior_bd && cp==cp_bd && localidad==localidad_bd) {
		alert("No hay cambios por realizar");
		
	} else {
		document.getElementById("nuevo_email").innerHTML = email;
		document.getElementById("nuevo_telefono").innerHTML = telefono;
		document.getElementById("nuevo_celular").innerHTML = celular;
		document.getElementById("nuevo_vialidad").innerHTML = vialidad;
		document.getElementById("nuevo_exterior").innerHTML = exterior;
		document.getElementById("nuevo_interior").innerHTML = interior;
		document.getElementById("nuevo_cp").innerHTML = cp;
		document.getElementById("nuevo_localidad").innerHTML = localidad;

		document.getElementById('modal1').style.display='block';
	}
}

function info_academica(){
	$.ajax({
    	type: "POST",
        url: "<?= base_url()?>index.php/Alumno/obtener_informacion_academica",
        data: datos,
        success: function(data) {
	        $('#infoAlumno').replaceWith(data);
        },
      	error: function (xhr, ajaxOptions, thrownError) {
        	alert('No se encontraron datos');
        }
    });
}

function inscripcion() {
	$.ajax({
    	type: "POST",
      	url: "<?= base_url()?>index.php/Alumno/obtener_ueas",
      	data: datos,
      	success: function(data) {
      		$('#infoAlumno').replaceWith(data);
      	},
      	error: function (xhr, ajaxOptions, thrownError) {
        	alert('No se encontraron datos');
      	}
    });
}

function guardar_info() {
	var usuario = <?echo $alumno_info_personal[0]["id_user"]?>;
	var id_direccion = <?echo $alumno_info_personal[0]["id_direccion"]?>;
	var email = document.getElementById('correo_electronico').value;
	var telefono = document.getElementById('telefono').value;
	var celular = document.getElementById('celular').value;
	var vialidad = document.getElementById('vialidad').value;
	var exterior = document.getElementById('exterior').value;
	var interior = document.getElementById('interior').value;
	var cp = document.getElementById('cp').value;
	var localidad = document.getElementById('localidad').value;
	datos_alumno = {"usuario":usuario, "id_direccion":id_direccion, "correo":email, "telefono":telefono, "celular":celular, "vialidad":vialidad, "exterior":exterior, "interior":interior, "cp":cp, "localidad":localidad};

	$.ajax({
    	type: "POST",
    	url: "<?= base_url()?>index.php/Alumno/guardar_info_alumno",
    	data: datos_alumno,
      	success: function(data) {
      		document.getElementById('modal1').style.display='none';
        	alert("cambio efectuado");
        	//$('#infoAlumno').replaceWith(data);
        },
      	error: function (xhr, ajaxOptions, thrownError) {
            document.getElementById('modal1').style.display='none';
            alert('No puede haber campos vacios');
        }
    });
}
</script>
</body>
</html>