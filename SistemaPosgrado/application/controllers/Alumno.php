<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('alumno_model');
	}

	public function obtener_informacion(){
		$matricula = $this->input->post('matricula');
		$contraseña = $this->input->post('contraseña');

		$data['alumno_info_personal'] = $this->alumno_model->obtener_datos_alumno($matricula,$contraseña);
        if ($data['alumno_info_personal'] != NULL) {
            $this->load->view('Alumno/info_alumno',$data);
        } else {
           	$this->response(array("code" => 204, "response" => "No se encontraron datos"));
        }
	}

	public function obtener_informacion_academica(){
	 	$matricula = $this->input->post('matricula');
	 	
	 	$data['alumno_info_academica'] = $this->alumno_model->obtener_datos_academicos($matricula);
	 	if ($data['alumno_info_academica'] != NULL) {
            $this->load->view('Alumno/info_academica',$data);
        } else {
           	$this->response(array("code" => 204, "response" => "No se encontraron datos"));
        }
	}

	public function obtener_ueas(){
		$nivel = $this->input->post('nivel');

		$data['ueas'] = $this->alumno_model->obtener_ueas($nivel);
		if ($data['ueas'] != NULL) {
            $this->load->view('Alumno/seleccion_ueas',$data);
        } else {
           	$this->response(array("code" => 204, "response" => "No se encontraron datos"));
        }
	}

	public function guardar_info_alumno(){
		$usuario = $this->input->post('usuario');
        $correo = $this->input->post('correo');
        $telefono = $this->input->post('telefono');
        $celular = $this->input->post('celular');
        $num_direccion = $this->input->post('id_direccion');
        $vialidad = $this->input->post('vialidad');
        $exterior = $this->input->post('exterior');
        $interior = $this->input->post('interior');
        $cp = $this->input->post('cp');
        $localidad = $this->input->post('localidad');
        $municipio = 001;
        
        if ($num_direccion != 1) {
        	$this->alumno_model->actualizar_datos_alumno($usuario,$correo,$telefono,$celular);
        	$this->alumno_model->actualizar_direccion_alumno($num_direccion,$vialidad,$exterior,$interior,$cp,$localidad);
        } else {
        	$data['dir'] = $this->alumno_model->crear_direccion_alumno($vialidad,$exterior,$interior,$cp,$localidad,$municipio);
        	//var_dump($data['dir']);
        	$this->alumno_model->actualizar_datos_alumno($usuario,$correo,$telefono,$celular);
        }
        
	}
}