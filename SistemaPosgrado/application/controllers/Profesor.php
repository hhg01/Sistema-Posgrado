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

        $this->profesor_model->actualizar_datos_profesor($usuario,$correo,$telefono,$celular);
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
				$email = '';
	         	$titulo = 'Mensaje de contacto al Coordinador';
	         	$contenido = 'EL alumno'.$data['tutorados'][0]['apellido_paterno'].' '.$data['tutorados'][0]['apellido_materno'].' '.$data['tutorados'][0]['nombres'].' ha concluido satisfactoriamente su Preinscripcion';
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
}
