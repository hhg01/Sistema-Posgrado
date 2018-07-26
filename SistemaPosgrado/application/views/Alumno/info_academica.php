<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<style type="text/css">
	.new_color{
		background-color: #035887;
	}
	.card_color{
			background-color: #c4e9fe;
		}
</style>
<body>

<div id="infoAcademica">
	<div class="navbar-fixed">
	  	<nav class="nav-extended new_color">
	    	<div class="nav-wrapper">
	      		<ul id="nav-mobile" class="left hide-on-med-and-down">
	        		<li><a onclick="info_alumno()">Información Personal</a></li>
			        <li><a class="active">Información Academica</a></li>
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
				<div class="card card_color">
					<div class="card-content">
						<span class="card-title">Información Academica</span>
<?php echo
'<div class="conteiner">
	<div class="row">
		<div class="col s4 m4 l4">
			<div class="card-content">
			<label>Matricula:</label><input type="text" id="matricula" readonly=”readonly” style="border:none" name="matricula" value="'.$alumno_info_academica[0]["matricula"].'">';
			if ($alumno_info_academica[0]["nivel"] == "M") {
				echo '<label>Nivel:</label><input type="text" id="nivel" readonly=”readonly” style="border:none" name="nivel" value="Maestría">';
			} else {
				echo '<label>Nivel:</label><input type="text" id="nivel" readonly=”readonly” style="border:none" name="nivel" value="Doctorado">';
			}
			
			echo
			'<label>División:</label><input type="text" id="division" readonly=”readonly” style="border:none" name="division" value="'.$alumno_info_academica[0]["division"].'">
			<label>Unidad:</label><input type="text" id="unidad" readonly=”readonly” style="border:none" name="unidad" value="'.$alumno_info_academica[0]["unidad"].'">
			</div>
		</div>
		<div class="col s4 m4 l4">
			<div class="card-content">
				<label>Departamento:</label><input type="text" id="departamento" readonly=”readonly” style="border:none" name="departamento" value="'.$alumno_info_academica[0]["departamento"].'">
				<label>Posgrado:</label><input type="text" id="nombre" readonly=”readonly” style="border:none" name="nombre" value="'.$alumno_info_academica[0]["nombre"].'">
				<label>Proyecto:</label><input type="text" id="titulo" readonly=”readonly” style="border:none" name="titulo" value="'.$alumno_info_academica[0]["titulo"].'">
			</div>
		</div>
		<div class="col s4 m4 l4">
			<div class="card-content">
				<label>Fecha Ingreso:</label><input type="text" id="fecha_ingreso" readonly=”readonly” style="border:none" name="fecha_ingreso" value="'.$alumno_info_academica[0]["fecha_ingreso"].'">';

				if ($alumno_info_academica[0]["estado"] == 1) {
					echo '<label>Estado:</label><input type="text" id="estado" readonly=”readonly” style="border:none" name="estado" value="Activo">';
				} else {
					echo '<label>Estado:</label><input type="text" id="estado" readonly=”readonly” style="border:none" name="estado" value="'.$alumno_info_academica[0]["estado"].'">';
				}
				echo
				'<p>Beca:</p>
				<label>Inicio:</label><input type="text" id="inicio" readonly=”readonly” style="border:none" name="inicio" value="'.$alumno_info_academica[0]["inicio"].'">
				<label>Termino:</label><input type="text" id="termino" readonly=”readonly” style="border:none" name="termino" value="'.$alumno_info_academica[0]["termino"].'">
			</div>
		</div>						
	</div>
</div>';
?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12 m12 l12 black-text">
				<h5>¿Necesitas ayuda?</h5>
				<blockquote style="border-color: #FFAB00;">
					<p>
						En este apartado únicamente podrás ver tu información académica.
					</p>
				</blockquote>
			</div>
		</div>	
	</div>


</div>


<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
<script src="<?= base_url()?>assets/js/materialize.min.js"></script>
<script>
function info_alumno(){
    $.ajax({
    	type: "POST",
      	url: "<?= base_url()?>index.php/Alumno/obtener_informacion",
      	data: datos,
      	success: function(data) {
      		$('#infoAcademica').replaceWith(data);
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
      		$('#infoAcademica').replaceWith(data);
      	},
      	error: function (xhr, ajaxOptions, thrownError) {
        	alert('No se encontraron datos');
      	}
    });
}
</script>
</body>
</html>