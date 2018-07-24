<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<div  id="datosPersonales">
	<div class="navbar-fixed">
	  	<nav class="nav-extended blue-grey darken-1">
	    	<div class="nav-wrapper">
	      		<ul id="nav-mobile" class="left hide-on-med-and-down">
	      			<?echo
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
				<div class="card blue-grey lighten-4">
					<div class="card-content">

						<div id="modal1" class="modal modal-fixed-footer" onload="loading()">
						    <div class="modal-content">
						      	<h4>Confirma los cambios</h4>
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
<?
echo 
'<tbody>
	<tr id="email'.$profesor_info_personal[0]["id_user"].'">
	    <td><id="mi_email" type="text">'.$profesor_info_personal[0]["email"].'</td>
	    <td><type="text">-></td>
	    <td><id="nuevo_email" type="text"></td>
	</tr>
	<tr id="telefono'.$profesor_info_personal[0]["id_user"].'">
	    <td><id="mi_telefono" type="text">'.$profesor_info_personal[0]["telefono"].'</td>
	    <td><type="text">-></td>
	    <td><id="nuevo_telefono" type="text"></td>
	</tr>
	<tr id="celular'.$profesor_info_personal[0]["id_user"].'">
	    <td><id="mi_celular" type="text">'.$profesor_info_personal[0]["celular"].'</td>
	    <td><type="text">-></td>
	    <td><id="nuevo_celular" type="text"></td>
	</tr>
</tbody>';
?>
		  								</table>
									</div>
								</div>
						    </div>
						    <div class="modal-footer blue-grey darken-1">
						      	<a onclick="document.getElementById('modal1').style.display='none'" class="modal-close btn-flat white-text">Cancelar</a>
						      	<a class="modal-close btn-flat white-text">Aceptar</a>
						    </div>
						</div>

						<span class="card-title">Información Personal</span>
<? echo 
'<div class="conteiner">
	<div class="row">
		<div class="col s4 m4 l4">
			<div class="card-content">
				<label>Nombre:</label><input type="text" id="nombre" readonly=”readonly” style="border:none" name="nombre" value="'.$profesor_info_personal[0]["apellido_paterno"].' '.$profesor_info_personal[0]["apellido_materno"].' '.$profesor_info_personal[0]["nombres"].'">
				<label>Correo Electronico:</label><input type="text" id="correo_electronico" name="correo_electronico" value="'.$profesor_info_personal[0]["email"].'">
				<label>Telefono:</label><input type="text" id="telefono" name="telefono" value="'.$profesor_info_personal[0]["telefono"].'">
				<label>Celular:</label><input type="text" id="celular" name="celular" value="'.$profesor_info_personal[0]["celular"].'">
			</div>
		</div>
		<div class="col s4 m4 l4">
			<div class="card-content">
				<label>Nacionalidad:</label><input type="text" id="nacionalidad" readonly=”readonly” style="border:none"  name="nacionalidad" value="'.$profesor_info_personal[0]["nacionalidad"].'">
				<label>Fecha Nacimiento:</label><input type="text" id="fecha_nacimiento" readonly=”readonly” style="border:none"  name="fecha_nacimiento" value="'.$profesor_info_personal[0]["fecha_nacimiento"].'">';

				if ($profesor_info_personal[0]["genero"] == "M") {
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
				<label>Vialidad:</label><input type="text" id="vialidad" name="vialidad" value="'.$profesor_info_personal[0]["vialidad"].'">
				<label># exterior:</label><input type="text" id="exterior" name="exterior" value="'.$profesor_info_personal[0]["exterior"].'">
				<label># interior:</label><input type="text" id="interior" name="interior" value="'.$profesor_info_personal[0]["interior"].'">
				<label>CP:</label><input type="text" id="cp" name="cp" value="'.$profesor_info_personal[0]["cp"].'">
				<label>Localidad:</label><input type="text" id="localidad" name="localidad" value="'.$profesor_info_personal[0]["localidad"].'">
			</div>
		</div>
	</div>
</div>';
?>
					</div>
				</div>
			</div>
			<br>
			<a class="btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons" onclick="regresar()">reply</i></a>
			<br><br>
			<a class="btn-floating btn-medium blue"><i class="material-icons" onclick="document.getElementById('modal1').style.display='block'">archive</i></a>
		</div>
	</div>
</div>

<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
<script src="<?= base_url()?>assets/js/materialize.min.js"></script>
<script>
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
</script>
</body>
</html>