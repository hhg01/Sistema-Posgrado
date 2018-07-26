<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/materialize.min.css">
	<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
  	<script src="<?= base_url()?>assets/js/materialize.min.js"></script>
<style>
.color{
	background: #035887;
}
.fondo{
	background: #035887;
}
</style>
</head>

<body>


<body id="contenido">
<br>
	<div class="row">
		<div class="col s4 m4 l4 offset-s4 offset-m4 offset-l4">
        	<div class="card">
          		<div class="card-content">
            		<span class="card-title">Profesores</span>
            		<div class="row">
                		<div class="input-field col s12 m12 l12">
                    		<input id="economico" type="text" class="validate">
                    		<label for="economico">No. Económico</label>
                		</div>
                		<div class="input-field col s12 m12 l12">
                    		<input id="passwordNo" type="password" class="validate">
                    		<label for="passwordNo">Contraseña</label>
                		</div>
            		</div>
          		</div>
          		<div class="card-action">
            		<a class="waves-effect waves-light btn-large fondo" type="submit" name="action" id="ingresar" onclick="ingresar_profesores()">Ingresar</a>
          		</div>
        	</div>
      	</div>
	</div>
</body>

<script>
function ingresar_profesores(){
	var economico = document.getElementById('economico').value;
	var password_no = document.getElementById('passwordNo').value;

	if (economico !== '' && password_no !== '') {
	  	var datos={
	    	"economico": economico,
	    	"contraseña": password_no
	  	};
	  	$.ajax({
	    	type: "POST",
	    	url: "<?= base_url()?>index.php/Profesor/ingresar",
	    	data: datos,
	    	success: function(data) {
	      		$('#contenido').replaceWith(data);
	    	},
	    	error: function (xhr, ajaxOptions, thrownError) {
	      		alert('Revisa bien los campos');
	    	}
	  	});
	} else {
  		alert("Te falta algún campo");  
	}
}
</script>
</body>
</html>