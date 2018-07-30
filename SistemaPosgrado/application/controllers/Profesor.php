<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('profesor_model');
	}

	public function ingresar(){
		$economico = $this->input->post('economico');
		$contraseña = $this->input->post('contraseña');

		$data['profesor'] = $this->profesor_model->obtener_profesor($economico,$contraseña);
        if ($data['profesor'] != NULL) {
            $this->load->view('Profesor/menu_profesor',$data);
        } else {
           	$this->response(array("code" => 204, "response" => "No se encontraron datos"));
        }
	}

	public function obtener_datos_profesor(){
		$economico = $this->input->post('economico');
		$contraseña = $this->input->post('contraseña');

		$data['profesor'] = $this->profesor_model->obtener_profesor($economico,$contraseña);
		$data['profesor_info_personal'] = $this->profesor_model->obtener_datos_profesor($economico);
        if ($data['profesor_info_personal'] != NULL) {
            $this->load->view('Profesor/datos_personales',$data);
        } else {
           	$this->response(array("code" => 204, "response" => "No se encontraron datos"));
        }
	}

	public function obtener_datos_asesorados(){
		$economico = $this->input->post('economico');
		$contraseña = $this->input->post('contraseña');

		$data['profesor'] = $this->profesor_model->obtener_profesor($economico,$contraseña);
		$data['asesorados'] = $this->profesor_model->obtener_asesorados($economico);
		if ($data['asesorados'] != NULL) {
            $this->load->view('Profesor/vista_asesorados',$data);
        } else {
           	$this->response(array("code" => 204, "response" => "No se encontraron datos"));
        }
	}

	public function obtener_datos_tutorados(){
		$economico = $this->input->post('economico');
		$contraseña = $this->input->post('contraseña');

		$data['profesor'] = $this->profesor_model->obtener_profesor($economico,$contraseña);
		$data['tutorados'] = $this->profesor_model->obtener_tutorados($economico);
		if ($data['tutorados'] != NULL) {
            $this->load->view('Profesor/vista_tutorados',$data);
        } else {
           	$this->response(array("code" => 204, "response" => "No se encontraron datos"));
        }
	}

	public function obtener_lista_alumnos(){
		$economico = $this->input->post('economico');
		$contraseña = $this->input->post('contraseña');

		$data['profesor'] = $this->profesor_model->obtener_profesor($economico,$contraseña);
		$data['tutorados'] = $this->profesor_model->obtener_tutorados($economico);
		$data['asesorados'] = $this->profesor_model->obtener_asesorados($economico);
        if ($data['profesor'] != NULL) {
            $this->load->view('Profesor/vista_lista_alumnos',$data);
        } else {
           	$this->response(array("code" => 204, "response" => "No se encontraron datos"));
        }
	}

	public function obtener_horarios(){
		$datos = $this->input->post('datos');
		$matricula = $this->input->post('matricula');
		$economico = $datos["economico"];
		$contraseña = $datos[0];

		$data['profesor'] = $this->profesor_model->obtener_profesor($economico,$contraseña);
		$data['horarios'] = $this->profesor_model->obtener_horarios($matricula);
        if ($data['horarios'] != NULL) {
            $this->load->view('Profesor/vista_confirmar_horarios',$data);
        } else {
           	$this->response(array("code" => 204, "response" => "No se encontraron datos"));
        }
	}

	public function guardar_info_profesor(){
		$usuario = $this->input->post('usuario');
        $correo = $this->input->post('correo');
        $telefono = $this->input->post('telefono');
        $celular = $this->input->post('celular');
        /*$num_direccion = $this->input->post('id_direccion');
        $vialidad = $this->input->post('vialidad');
        $exterior = $this->input->post('exterior');
        $interior = $this->input->post('interior');
        $cp = $this->input->post('cp');
        $localidad = $this->input->post('localidad');
        $estado = $this->input->post('estado');
        $municipio = $this->input->post('municipio');*/
        
       // if ($num_direccion != 1) {
            //var_dump("El id no es 1");
        $this->alumno_model->actualizar_datos_profesor($usuario,$telefono,$celular,$correo);
            //$this->alumno_model->actualizar_direccion_alumno($num_direccion,$vialidad,$exterior,$interior,$cp,$localidad);
        //} else {
          //  var_dump("El id es 1");
            //$data['dir'] = $this->alumno_model->crear_direccion_alumno($vialidad,$exterior,$interior,$cp,$localidad,$municipio);
            //$this->alumno_model->actualizar_datos_alumno($usuario,$correo,$telefono,$celular);
           // $this->alumno_model->actualizar_direccion_alumno($num_direccion,$vialidad,$exterior,$interior,$cp,$localidad);
        //}
	}

	public function confirmar_email(){
		$datos = $this->input->post('datos');
		$economico = $datos["economico"];

		$id_student = $this->input->post('id_student');
		$confirmar = $this->profesor_model->confirmar_ueas($id_student);

		if($confirmar == true){
			$data['tutorados'] = $this->profesor_model->obtener_tutorados($economico);
			
			$correo_destino = $data['tutorados'][0]['email'];
			$titulo    = 'UEAs Aceptadas '.$data['tutorados'][0]['matricula'];
			$mensaje   = 'Tus materias han sido confirmadas';
			$cabeceras = 'From: sistema_posgrado@xanum.uam.mx' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			$envio = mail($correo_destino, $titulo, $mensaje, $cabeceras);

			if($envio == 1){
				$data['horarios'] = $this->profesor_model->obtener_horarios($matricula);

				$email = '';//correo del coordinador
	         	$titulo = 'Mensaje de contacto al Coordinador';
	         	$contenido = 'EL alumno'.$data['tutorados'][0]['apellido_paterno'].' '.$data['tutorados'][0]['apellido_materno'].' '.$data['tutorados'][0]['nombres'].' ha concluido satisfactoriamente su Preinscripcion';
	         	$contenido .= '<div class="conteiner">
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
         		$cabeceras = 'From: sistema_posgrado@xanum.uam.mx' . "\r\n" .'X-Mailer: PHP/' . phpversion();

         		$envio = mail($email,$titulo,$contenido,$cabeceras);
     		} else {
         		$echoError .= "El correo no se pudo envíar correctamente, favor de intentar nuevamente.";
     		}

		}else{
			$this->response(array("code" => 204, "response" => "No se encontraron datos"));
		}
	}

	public function cancelar_email(){
		$datos = $this->input->post('datos');
		$economico = $datos["economico"];

		$id_student = $this->input->post('id_student');
		$confirmar = $this->profesor_model->cancelar_ueas($id_student);

		if($confirmar == true){
			$data['tutorados'] = $this->profesor_model->obtener_tutorados($economico);
			
			$correo_destino = $data['tutorados'][0]['email'];
			$titulo    = 'UEAs Canceladas '.$data['tutorados'][0]['matricula'];
			$mensaje   = 'Tu inscripcion ha sido rechazada, vulve a preinscribirte';
			$cabeceras = 'From: sistema_posgrado@xanum.uam.mx' . "\r\n" .
			    'Reply-To: webmaster@example.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			mail($correo_destino, $titulo, $mensaje, $cabeceras);
		}else{
			$this->response(array("code" => 204, "response" => "No se encontraron datos"));
		}
	}

	public function cambiar_contrasena(){
		$nueva_contrasena = $this->input->post('contrasena_nueva');
		$datos_prof = $this->input->post('datosProf');
		//var_dump($datos_prof);
		$this->profesor_model->cambiar_contrasena($nueva_contrasena, $datos_prof['economico']);
	}
}