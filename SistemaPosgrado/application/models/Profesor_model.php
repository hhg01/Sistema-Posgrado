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

	function obtener_tutorados($economico){
  		$custom_query = "SELECT U.id_user, U.apellido_paterno, U.apellido_materno, U.nombres, U.email, S.matricula, S.nivel, S.id_posgraduate FROM STUDENTS AS S INNER JOIN USERS AS U ON S.id_user = U.id_user INNER JOIN TUTORS AS T ON T.id_student = S.id_student INNER JOIN TEACHERS AS Tc ON T.id_teacher = Tc.id_teacher WHERE Tc.no_economico=".$economico;
  		$respuesta_query = $this->db->query($custom_query);

  		if ($respuesta_query->num_rows() > 0) {
   			return $respuesta_query->result_array();
  		} else {
   			return $respuesta_query=NULL;
  		}
 	}

 	function obtener_asesorados($economico){
  		$custom_query = "SELECT U.id_user, U.apellido_paterno, U.apellido_materno, U.nombres, S.matricula, S.nivel, S.id_posgraduate, P.id_proyect FROM STUDENTS AS S INNER JOIN USERS AS U ON S.id_user = U.id_user INNER JOIN PROYECTS AS P ON P.id_student = S.id_student INNER JOIN RESPONSIBLE AS R ON R.id_proyect = P.id_proyect INNER JOIN TEACHERS AS Tc ON R.id_teacher = Tc.id_teacher WHERE Tc.no_economico=".$economico;
  		$respuesta_query = $this->db->query($custom_query);

  		if ($respuesta_query->num_rows() > 0) {
   			return $respuesta_query->result_array();
  		} else {
   			return $respuesta_query=NULL;
  		}
 	}

 	function obtener_horarios($matricula){
 		$custom_query = "SELECT st.id_student, st.matricula, us.apellido_paterno, us.apellido_materno, us.nombres, u.clave_uea, u.nombre, u.creditos FROM STUDENTS AS st JOIN REQUESTS AS re on st.id_student=re.id_student JOIN PLANNING AS pl on re.id_planning=pl.id_planning JOIN UEAS as u on pl.id_uea=u.clave_uea JOIN USERS AS us on st.id_user=us.id_user WHERE st.matricula=".$matricula;
 		$respuesta_query = $this->db->query($custom_query);

  		if ($respuesta_query->num_rows() > 0) {
   			return $respuesta_query->result_array();
  		} else {
   			return $respuesta_query=NULL;
  		}
 	}

 	function actualizar_datos_profesor($usuario,$correo,$telefono,$celular){
 		$custom_query = "UPDATE USERS set telefono ='".$telefono."', celular='".$celular."' where id_user=".$usuario." AND email='".$correo."';";
        var_dump($custom_query);
		$respuesta_query = $this->db->query($custom_query);

		//return "Hola, ya actualizamos tus datos";
		return $respuesta_query;
 	}

 	function confirmar_ueas($id_student){
 		$custom_query = "UPDATE REQUESTS SET estado_request=2 WHERE id_student=".$id_student;
		$respuesta_query = $this->db->query($custom_query);

		return $respuesta_query;
 	}

 	function cancelar_ueas($id_student){
 		$custom_query = "DELETE FROM REQUESTS WHERE id_student=".$id_student;
		$respuesta_query = $this->db->query($custom_query);

		return $respuesta_query;
 	}
}

