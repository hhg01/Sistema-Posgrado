<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesor_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	function obtener_profesor($economico,$contraseña){
		$custom_query = "SELECT te.no_economico, apellido_paterno, apellido_materno, nombres, se.password FROM USERS AS us JOIN TEACHERS AS te on us.id_user=te.id_user JOIN SESSIONS AS se on us.id_user=se.id_user WHERE te.no_economico=".$economico." AND se.password=".$contraseña;
		$respuesta_query = $this->db->query($custom_query);

		if ($respuesta_query->num_rows() > 0) {
			return $respuesta_query->result_array();
		} else {
			return $respuesta_query=NULL;
		}
	}

	function obtener_datos_profesor($economico){
		$custom_query = "SELECT us.id_user, us.apellido_paterno, us.apellido_materno, us.nombres, us.email, us.telefono, us.celular, us.fecha_nacimiento, us.nacionalidad, us.genero, ad.vialidad, ad.exterior, ad.interior, ad.cp, ad.localidad FROM USERS as us JOIN ADDRESSES as ad on us.id_direccion=ad.id_direccion JOIN TEACHERS as te on us.id_user=te.id_user WHERE te.no_economico=".$economico;
		$respuesta_query = $this->db->query($custom_query);

		if ($respuesta_query->num_rows() > 0) {
			return $respuesta_query->result_array();
		} else {
			return $respuesta_query=NULL;
		}
	}
}

