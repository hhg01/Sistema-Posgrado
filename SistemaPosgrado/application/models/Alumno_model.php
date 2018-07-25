<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alumno_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	function obtener_datos_alumno($matricula,$contraseña){
		$custom_query = "SELECT u.id_user, apellido_paterno, apellido_materno, nombres, email, telefono, celular, fecha_nacimiento, nacionalidad, genero, u.id_direccion, di.vialidad, di.exterior, di.interior, di.cp, di.localidad, di.id_municipio, s.matricula, s.nivel, se.password FROM USERS AS u JOIN STUDENTS AS s on u.id_user=s.id_user JOIN SESSIONS AS se on u.id_user=se.id_user JOIN ADDRESSES AS di ON u.id_direccion=di.id_direccion WHERE s.matricula=".$matricula." AND se.password=".$contraseña;
		$respuesta_query = $this->db->query($custom_query);

		if ($respuesta_query->num_rows() > 0) {
			return $respuesta_query->result_array();
		} else {
			return $respuesta_query=NULL;
		}
	}

	function obtener_datos_academicos($matricula){
		$custom_query = "SELECT st.matricula, st.nivel, pos.nombre, pos.division, pos.unidad, pos.departamento, st.estado, sc.inicio, sc.termino, st.fecha_ingreso, pr.titulo FROM STUDENTS AS st JOIN POSTGRADUATE AS pos on st.id_posgraduate=pos.id_postgraduate JOIN SCHOLARSHIPS AS sc on st.beca=sc.id_scholarship JOIN PROYECTS as pr on st.id_student=pr.id_student WHERE matricula=".$matricula;
		$respuesta_query = $this->db->query($custom_query);

		if ($respuesta_query->num_rows() > 0) {
			return $respuesta_query->result_array();
		} else {
			return $respuesta_query=NULL;
		}
	}

	function obtener_ueas($nivel){
		$custom_query = "SELECT clave_uea, nombre, creditos, horas_teoria, horas_practica,nivel FROM UEAS WHERE nivel IN ('MD', '".$nivel."')";
		$respuesta_query = $this->db->query($custom_query);

		if ($respuesta_query->num_rows() > 0) {
			return $respuesta_query->result_array();
		} else {
			return $respuesta_query=NULL;
		}
	}

	function actualizar_datos_alumno($usuario,$correo,$telefono,$celular){
		$custom_query = "UPDATE USERS set email='".$correo."', telefono=".$telefono.", celular=".$celular." where id_user=".$usuario.";";
		$respuesta_query = $this->db->query($custom_query);

		return $respuesta_query;
	}
	function actualizar_direccion_alumno($num_direccion,$vialidad,$exterior,$interior,$cp,$localidad){
		$custom_query = "UPDATE ADDRESSES SET vialidad='".$vialidad."', exterior='".$exterior."', interior='".$interior."', cp='".$cp."', localidad='".$localidad."' WHERE id_direccion=".$num_direccion.";";
		$respuesta_query = $this->db->query($custom_query);

		return $respuesta_query;
	}

	function crear_direccion_alumno($vialidad,$exterior,$interior,$cp,$localidad,$municipio){
		$custom_query = "INSERT INTO ADDRESSES (vialidad, exterior, interior, cp, localidad, id_municipio) VALUES ('".$vialidad."','".$exterior."','".$interior."','".$cp."','".$localidad."',".$municipio.")";
		$respuesta_query = $this->db->query($custom_query);
		if ($respuesta_query->num_rows() > 0) {
			
			return $respuesta_query->result_array();
		} else {

			return $respuesta_query=NULL;
		}
	}

	function regresa_paises(){
		$custom_query = "SELECT id, nombre FROM countries";
		$respuesta_query = $this->db->query($custom_query);
		if ($respuesta_query->num_rows() > 0) {
			//echo '<script type="text/javascript">console.log("hola que hace");';

			return $respuesta_query->result_array();
		} else {
			return $respuesta_query=NULL;
		}
	}

	function regresa_estados($id_pais){
		$custom_query = "SELECT cve_ent, nom_ent FROM states WHERE id_pais = '".$id_pais."'";
		$respuesta_query = $this->db->query($custom_query);
		//var_dump($respuesta_query->result_array());
		if ($respuesta_query->num_rows() > 0) {
			return $respuesta_query->result_array();
		} else {
			return $respuesta_query=NULL;
		}
	}

	function regresa_municipios($id_municipio){
		$custom_query = "SELECT cve_mun, nom_mun FROM municipalities WHERE cve_ent = '".$id_municipio."'";
		$respuesta_query = $this->db->query($custom_query);
		if ($respuesta_query->num_rows() > 0) {
			//echo '<script type="text/javascript">console.log("hola que hace");';
			return $respuesta_query->result_array();
		} else {
			return $respuesta_query=NULL;
		}
	}

}

