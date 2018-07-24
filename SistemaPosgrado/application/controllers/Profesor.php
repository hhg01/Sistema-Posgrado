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
}