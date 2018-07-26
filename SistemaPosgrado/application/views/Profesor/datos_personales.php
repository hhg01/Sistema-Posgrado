<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<style type="text/css">
		.box{
			display: block;
			height: 30px;
			width: 150px;
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
	</style>
</head>
<body>

<div  id="datosPersonales">
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

	<div class="conteiner" id="ajustesProfesor">
		<div class="row">
		    <div class="col s10 m10 l10 offset-s1 offset-m1 offset-l1">
				<div class="card card_color">
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
	    <td id="mi_email" type="text"><?php echo $profesor_info_personal[0]["email"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_email" type="text"></td>
	</tr>
	<tr>
	    <td id="mi_telefono" type="text"><?php echo $profesor_info_personal[0]["telefono"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_telefono" type="text"></td>
	</tr>
	<tr>
	    <td id="mi_celular" type="text"><?php echo $profesor_info_personal[0]["celular"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_celular" type="text"></td>
	</tr>
	<!--<tr>
	    <td id="mi_vialidad" type="text"><?php echo $profesor_info_personal[0]["vialidad"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_vialidad" type="text"></td>
	</tr>
	<tr>
	    <td id="mi_exterior" type="text"><?php echo $profesor_info_personal[0]["exterior"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_exterior" type="text"></td>
	</tr>
	<tr>
	    <td id="mi_interior" type="text"><?php echo $profesor_info_personal[0]["interior"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_interior" type="text"></td>
	</tr>
	<tr>
	    <td id="mi_cp" type="text"><?php echo $profesor_info_personal[0]["cp"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_cp" type="text"></td>
	</tr>
	<tr>
	    <td id="mi_localidad" type="text"><?php echo $profesor_info_personal[0]["localidad"];?></td>
	    <td type="text">-></td>
	    <td id="nuevo_localidad" type="text"></td>
	</tr>-->
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

<?php echo 
'<div class="conteiner">
	<div class="row">
		<div class="col s5 m5 l5">
			<div class="card-content">
				<label class="black-text">Nombre:</label><input type="text" id="nombre" readonly=”readonly” style="border:none" name="nombre" value="'.$profesor_info_personal[0]["apellido_paterno"].' '.$profesor_info_personal[0]["apellido_materno"].' '.$profesor_info_personal[0]["nombres"].'">
				<label class="black-text">* Correo Electronico:</label><input type="text" id="correo_electronico" name="correo_electronico" value="'.$profesor_info_personal[0]["email"].'">
				<label class="black-text">*  Telefono:</label><input type="text" id="telefono" name="telefono" value="'.$profesor_info_personal[0]["telefono"].'">
				<label class="black-text">*  Celular:</label><input type="text" id="celular" name="celular" value="'.$profesor_info_personal[0]["celular"].'">
				
			</div>
		</div>
		<div class="col s5 m5 l5 offset-s1 offset-m2 offset-l2">
			<div class="card-content">
				<label class="black-text">Nacionalidad:</label><input type="text" id="nacionalidad" readonly=”readonly” style="border:none"  name="nacionalidad" value="'.$profesor_info_personal[0]["nacionalidad"].'">
				<label class="black-text">Fecha Nacimiento:</label><input type="text" id="fecha_nacimiento" readonly=”readonly” style="border:none"  name="fecha_nacimiento" value="'.$profesor_info_personal[0]["fecha_nacimiento"].'">';

				if ($profesor_info_personal[0]["genero"] == "M") {
					echo '<label class="black-text>Género:</label><input type="text" id="genero" readonly=”readonly” style="border:none"  name="genero" value="Femenino">';
				} else {
					echo '<label class="black-text">Género:</label><input type="text" id="genero" readonly=”readonly” style="border:none"  name="genero" value="Masculino">';
				}
			echo
			'</div>
		</div>';?>

						<!--<div id="modal2" class="modal modal-fixed-footer">
						    <div class="modal-content">
						      	<p><h5>Cambio de contraseña</h5></p>
						      	<div class="container">
							      	<div class="row">
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
						    <div class="modal-footer new_color">
						      	<a onclick="document.getElementById('modal2').style.display='none'" class="modal-close btn-flat white-text">Cancelar</a>
						      	<a class="modal-close btn-flat white-text" onclick="enviar_correo()">Aceptar</a>
						    </div>
						</div>-->

		<!--<div class="col s4 m4 l4">
			<div class="card-content">
				<p>Dirección</p><br>
				<label>Vialidad:</label><input type="text" id="vialidad" name="vialidad" value="<?php $profesor_info_personal[0]["vialidad"]?>">
				<label># exterior:</label><input type="text" id="exterior" name="exterior" value="<?php $profesor_info_personal[0]["exterior"]?>">
				<label># interior:</label><input type="text" id="interior" name="interior" value="<?php $profesor_info_personal[0]["interior"]?>">
				<label>CP:</label><input type="text" id="cp" name="cp" value="<?php $profesor_info_personal[0]["cp"]?>">
				<label>Localidad:</label><input type="text" id="localidad" name="localidad" value="<?php $profesor_info_personal[0]["localidad"]?>">
			</div>
		</div>-->

		<!--<div class="row">
			<div class="col s12 m12 l12">
					<div class="col s12 m6 l6">
						<a class="waves-effect waves-light btn-flat blue-grey lighten-1" onclick="cambiar_contrasena()">Cambiar Contraseña</a>
					</div>
					<div class="col s12 m2 l2">
						<select id="paises" class="box" onchange="recupera_estados(this.value)">
							<option value="Paises">Paises</option>
							
						</select>
					</div>
					<div class="col s12 m2 l2">
						<select id="estados" class="box" onchange="recupera_municipios()">
							<option value="Estados">Estados</option>
						</select>
					</div>
					<div class="col s12 m2 l2">
						<select id="municipios" class="box" onchange="validar()">
							<option value="Municipios">Municipios</option>
						</select>
					</div>
			</div>
		</div>-->
	</div>
</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m12 l12 black-text">
					<h5>¿Necesitas ayuda?</h5>
					<blockquote style="border-color: #FFAB00;">
						<p>
							Los datos marcados con un * son campos oblogatorios. Si estos ya los tienes registrados, no es necesario volver a ponerlos.
						</p>
						<p>
							Para actualizar los datos solamente escribe sobre ellos y da click sobre el botón
							<a class="btn-floating btn-medium button_color"><i class="material-icons">archive</i></a> para confirmar el cambio.
							<br>
							Si no has cambiado tus datos y presionas el botón aparecerá un mensaje de "No hay cambios por realizar".
						</p>
						<p>Los datos que se pueden modificar son:</p>
							<ul>
								<li>Correo electrónico, </li>
								<li>Teléfono y</li>
								<li>Celular</li>
							</ul>

						<p>
							Para regresar al menú del profesor presiona el botón <a class="btn-floating btn-medium button_color"><i class="material-icons">reply</i></a>
						</p>
					</blockquote>
				</div>
			</div>	
		</div>
	<br>
	<a class="btn-floating btn-medium waves-effect waves-light button_color"><i class="material-icons" onclick="regresar()">reply</i></a>
	<br><br>
	<a class="btn-floating btn-medium button_color"><i class="material-icons" onclick="document.getElementById('modal1').style.display='block'">archive</i></a>
</div>

<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
<script src="<?= base_url()?>assets/js/materialize.min.js"></script>
<script>

function cargar_info_modal() {
	var email = document.getElementById('correo_electronico').value;
	var telefono = document.getElementById('telefono').value;
	var celular = document.getElementById('celular').value;
	console.log(email);
	//var vialidad = document.getElementById('vialidad').value;;
	//var exterior = document.getElementById('exterior').value;;
	//var interior = document.getElementById('interior').value;;
	//var cp = document.getElementById('cp').value;;
	//var localidad = document.getElementById('localidad').value;;

	var email_bd = '<?php echo $profesor_info_personal[0]["email"]?>';
	var telefono_bd = '<?php echo $profesor_info_personal[0]["telefono"]?>';
	var celular_bd = '<?php echo $profesor_info_personal[0]["celular"]?>';
	/*var vialidad_bd = '<?php echo $profesor_info_personal[0]["vialidad"]?>';
	//var exterior_bd = '<?php echo $profesor_info_personal[0]["exterior"]?>';
	//var interior_bd = '<?php echo $profesor_info_personal[0]["interior"]?>';
	//var cp_bd = '<?php echo $profesor_info_personal[0]["cp"]?>';
	//var localidad_bd = '<?php echo $profesor_info_personal[0]["localidad"]?>';*/

	if (email==email_bd && telefono==telefono_bd && celular==celular_bd ){//&& vialidad==vialidad_bd && exterior==exterior_bd && interior==interior_bd && cp==cp_bd && localidad==localidad_bd) {
		alert("No hay cambios por realizar");
		
	} else {
		document.getElementById("nuevo_email").innerHTML = email;
		document.getElementById("nuevo_telefono").innerHTML = telefono;
		document.getElementById("nuevo_celular").innerHTML = celular;
		/*document.getElementById("nuevo_vialidad").innerHTML = vialidad;
		document.getElementById("nuevo_exterior").innerHTML = exterior;
		document.getElementById("nuevo_interior").innerHTML = interior;
		document.getElementById("nuevo_cp").innerHTML = cp;
		document.getElementById("nuevo_localidad").innerHTML = localidad;*/

		document.getElementById('modal1').style.display='block';
	}
}

function guardar_info() {
	alert("update()");
	var usuario = <?php echo $profesor_info_personal[0]["id_user"]?>;
	//var id_direccion = //<?php //echo $profesor_info_personal[0]["id_direccion"]?>;
	var email = document.getElementById('correo_electronico').value;
	var telefono = document.getElementById('telefono').value;
	var celular = document.getElementById('celular').value;
	/*var vialidad = document.getElementById('vialidad').value;
	var exterior = document.getElementById('exterior').value;
	var interior = document.getElementById('interior').value;
	var cp = document.getElementById('cp').value;
	var localidad = document.getElementById('localidad').value;*/
	datos_alumno = {"usuario":usuario, "correo":email, "telefono":telefono, "celular":celular}//, "vialidad":vialidad, "exterior":exterior, "interior":interior, "cp":cp, "localidad":localidad, "id_direccion":id_direccion};

	$.ajax({
    	type: "POST",
    	url: "<?= base_url()?>index.php/Profesor/guardar_info_profesor",
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

function regresar() {
	$.ajax({
    	type: "POST",
    	url: "<?= base_url()?>index.php/Profesor/ingresar",
    	data: datosProf,
      	success: function(data) {
        	$('#datosPersonales').replaceWith(data);
        },
      	error: function (xhr, ajaxOptions, thrownError) {
            alert('Revisa bien los campos');
        }
    });
}

/*function recupera_estados(valor){
    var pais_seleccionado = document.getElementById('paises'),
    	id_pais = pais_seleccionado.value;
    	//Cuando se cambia de país se reinician los valores
    	while(document.getElementById("estados").length > 1){
    		document.getElementById("estados").remove(1);
    	}
    	while(document.getElementById("municipios").length > 1){
    		document.getElementById("municipios").remove(1);
    	}
  	if(valor == 'Paises'){
  		alert("Selecciona una opción");
   		document.getElementById("estados").disabled=false;
   		document.getElementById("municipios").disabled=false;
   	} else {
   		var datos_estados={"id_pais":id_pais};
   		$.ajax({
   			type: "POST",
   			url: "<?= base_url()?>index.php/Alumno/regresa_estados",
   			data: datos_estados,
   			success:function(data){
   				$("#estados").html(data);
   				//$("#estados").
   			},
   			error: function(xhr, ajaxOptions, thrownError){
   				alert("No hay informacion al respecto");
   				var estado_vacio = document.getElementById('estados');

   			}
   		});
    }
}

function recupera_municipios(){
    var estado_seleccionado = document.getElementById('estados'),
    	id_estado = estado_seleccionado.value;
    	//Cuando se cambia de estado se reinician los valores
    	while(document.getElementById("municipios").length > 1){
    		document.getElementById("municipios").remove(1);
    	}
     if(id_estado == 'Estados'){
     	alert("Selecciona una opción");
   		//document.getElementById("estados").disabled=true;
   		document.getElementById("municipios").disabled=false;
   	} else {
   		var datos_municipios={"id_estado":id_estado};

   		$.ajax({
   			type: "POST",
   			url: "<?= base_url()?>index.php/Alumno/regresa_municipios",
   			data: datos_municipios,
   			success:function(data){
   				$("#municipios").html(data);
   			},
   			error: function(xhr, ajaxOptions, thrownError){
   				alert("No hay informacion al respecto");
   				var municipio_vacio = document.getElementById('municipios');

   			}
   		});
    }
}

function validar(){
	var municipio_seleccionado = document.getElementById('municipios'),
		id_municipio = municipio_seleccionado.value;
	if(id_municipio == 'Municipios'){
		alert("Selecciona una opción");
	}
}

function cambiar_contrasena(){
	document.getElementById('modal2').style.display='block';
}

function enviar_correo(){
	var contrasena_actual = document.getElementById('contrasena_actual').value,
		contrasena_nueva = document.getElementById('contrasena_nueva').value,
		contrasena_nueva_confirm = document.getElementById('contrasena_nueva_confirm').value;
		if(contrasena_actual != <?php echo $profesor[0]['password'];?>){
			alert("La contraseña actual no coincide con la que tienes registrada");
		} else if(contrasena_nueva == <?php echo $profesor[0]['password'];?> || contrasena_actual == '' || contrasena_nueva == ''){
			alert("Introduce una nueva contraseña");
		} else if(contrasena_nueva != contrasena_nueva_confirm){
			alert("Los campos de confirmación y nueva contraseña no coinciden");
		} else {
			alert("Te enviamos un correo con tu nueva contraseña");
			document.getElementById('modal2').style.display='none';
			 
			//	$mensaje = '<p>¡Hola! Has hecho una solicitud para cambiar tu contraseña.</p>
			//				<p>Tu nueva contraseña es: '.contrasena_nueva.'</p>'
			//	mail($alumno_info_personal[0]['email'], "Actualización de contraseña", message);
			
		}

}*/

</script>
</body>
</html>