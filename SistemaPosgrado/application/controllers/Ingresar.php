<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ingresar extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('ingresar');
	}
    
    public function ingresar_alumno(){
		$this->load->view('sistema_alumno');
	}
    
    public function ingresar_profesor(){
    	$this->load->view('sistema_profesor');
    } 
}