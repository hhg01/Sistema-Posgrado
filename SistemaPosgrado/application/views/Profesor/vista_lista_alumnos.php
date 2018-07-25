<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<div  id="vista_lista_alumnos">
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
<?echo
'<div class="conteiner">
  	<div class="row">
    	<div class="col s12 m12 l8 offset-l2">
    		<div class="card-content">
    			<h5>Tutor de</h5>
            	<div class="responsive-table table-status-sheet">
              		<table class="bordered">
                		<thead>
                  			<tr>
			                    <th data-field="name">Nombre</th>
			                    <th data-field="name">Nivel</th>
                  			</tr>
                		</thead>';
                  		foreach ($tutorados as &$tutorado) {
                    	echo
                    	'<tbody>
                      		<tr id="clave'.$tutorado["matricula"].'">
		                        <td><id="nombre" type="text">'.$tutorado["apellido_paterno"].' '.$tutorado["apellido_materno"].' '.$tutorado["nombres"].'</td>
		                        <td><id="nivel" type="text">'.$tutorado["nivel"].'</td>
		                        <td><a id="id'.$tutorado["matricula"].'" class="waves-effect waves-light btn-small blue" onclick="revisar_horario('.$tutorado["matricula"].')"><i class="material-icons center">schedule</i></a></td>
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
<?echo
'<div class="conteiner">
  	<div class="row">
    	<div class="col s12 m12 l8 offset-l2">
    		<div class="card-content">
    			<h5>Asesor de</h5>
            	<div class="responsive-table table-status-sheet">
              		<table class="bordered">
                		<thead>
                  			<tr>
			                    <th data-field="name">Nombre</th>
			                    <th data-field="name">Nivel</th>
                  			</tr>
                		</thead>';
                  		foreach ($asesorados as &$asesor) {
                    	echo
                    	'<tbody>
                      		<tr id="clave'.$asesor["matricula"].'">
		                        <td><id="nombre" type="text">'.$asesor["apellido_paterno"].' '.$asesor["apellido_materno"].' '.$asesor["nombres"].'</td>
		                        <td><id="nivel" type="text">'.$asesor["nivel"].'</td>
		                        <td><a id="id'.$asesor["matricula"].'" class="waves-effect waves-light btn-small blue" onclick="revisar_horario('.$asesor["matricula"].')"><i class="material-icons center">schedule</i></a></td>
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
function revisar_horario(id) {
	$.ajax({
    	type: "POST",
    	url: "<?= base_url()?>index.php/Profesor/obtener_horarios",
    	data: {"datos":datosProf, "matricula":id},
      	success: function(data) {
        	$('#vista_lista_alumnos').replaceWith(data);
        },
      	error: function (xhr, ajaxOptions, thrownError) {
            alert('El alumno no ha seleccionado UEAs');
        }
    });
}

function regresar() {
	$.ajax({
    	type: "POST",
    	url: "<?= base_url()?>index.php/Profesor/ingresar",
    	data: datosProf,
      	success: function(data) {
        	$('#vista_lista_alumnos').replaceWith(data);
        },
      	error: function (xhr, ajaxOptions, thrownError) {
            alert('Revisa bien los campos');
        }
    });
}
</script>
</body>
</html>