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
}