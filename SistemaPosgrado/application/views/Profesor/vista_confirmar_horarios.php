<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<div  id="vista_confirmar_horarios">
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

	<div class="conteiner">
			<div class="row">
			    <div class="col s10 m10 l10 offset-s1 offset-m1 offset-l1">
					<div class="card blue-grey lighten-4">
						<div class="card-content">
<?
echo '<h6>Alumno: '.$horarios[0]["apellido_paterno"].' '.$horarios[0]["apellido_materno"].' '.$horarios[0]["nombres"].' ('.$horarios[0]["matricula"].')</h6>';
echo 
'<div class="conteiner">
  	<div class="row">
    	<div class="col s12 m12 l8 offset-l2">
    		<div class="card-content">
            	<div class="responsive-table table-status-sheet">
              		<table class="bordered">
                		<thead>
                  			<tr>
			                    <th data-field="name">Clave</th>
			                    <th data-field="name">Nombre</th>
			                    <th data-field="name">Creditos</th>
                  			</tr>
                		</thead>';
                  		foreach ($horarios as $horario) {
                    	echo
                    	'<tbody>
                      		<tr id="clave'.$horario["matricula"].'">
		                        <td><id="clave" type="text">'.$horario["clave_uea"].'</td>
		                        <td><id="nombre" type="text">'.$horario["nombre"].'</td>
		                        <td><id="creditos" type="text">'.$horario["creditos"].'</td>
                      		</tr>
                    	</tbody>';
                  		}
              			echo
              		'</table>
            	</div>
    		</div>
    	</div>
  	</div>
</div>';
?>
					<a class="waves-effect waves-light btn-small blue-grey lighten-1" type="submit" id="confirmar" onclick="confirmar_uea()">Confirmar</a>&nbsp&nbsp&nbsp
					<a class="waves-effect waves-light btn-small blue-grey lighten-1" type="submit" id="cancelar" onclick="cancelar_uea()">Cancelar</a>
					</div>
				</div>
			</div>
			<br>
			<a class="btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons" onclick="regresar()">reply</i></a>
		</div>
	</div>
</div>

<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
<script src="<?= base_url()?>assets/js/materialize.min.js"></script>
<script>
function confirmar_uea() {
	alert("send_emal()");
}

function cancelar_uea() {
	alert("delete() y send()");
}

function regresar() {
	$.ajax({
    	type: "POST",
    	url: "<?= base_url()?>index.php/Profesor/obtener_lista_alumnos",
    	data: datosProf,
      	success: function(data) {
        	$('#vista_confirmar_horarios').replaceWith(data);
        },
      	error: function (xhr, ajaxOptions, thrownError) {
            alert('Revisa bien los campos');
        }
    });
}
</script>
</body>
</html>