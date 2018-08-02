<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Biblioteca PHPMailer
/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';*/


class Profesor extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('profesor_model');
	}

	public function ingresar($contraseña){
		$economico = $this->input->post('economico');

		$data['profesor'] = $this->profesor_model->obtener_profesor($economico,$contraseña);
        if ($data['profesor'] != NULL) {
            $this->load->view('Profesor/menu_profesor',$data);
        } else {
           	$this->response(array("code" => 204, "response" => "No se encontraron datos"));
        }
	}

	public function obtener_datos_profesor(){
		$economico = $this->input->post('economico');
		$contraseña = "'".$this->input->post('contraseña')."'";

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
		$contraseña = "'".$this->input->post('contraseña')."'";

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
		$contraseña = "'".$this->input->post('contraseña')."'";

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
		$contraseña = "'".$this->input->post('contraseña')."'";

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
		$contraseña = "'".$datos[0]."'";

		$data['profesor'] = $this->profesor_model->obtener_profesor($economico,$contraseña);
		$data['horarios'] = $this->profesor_model->obtener_horarios($matricula);
        if ($data['horarios'] != NULL) {

            if ($data['horarios'][0]["estado_request"] == 1) {
            	$this->load->view('Profesor/vista_confirmar_horarios',$data);
            } else {
            	$this->response(array("code" => 204, "response" => "El horario ya fue aceptado"));
            }
            
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
			$nombre=$data['tutorados'][0]['apellido_paterno'].' '.$data['tutorados'][0]['apellido_materno'].' '.$data['tutorados'][0]['nombres'];
			
			$correo_destino = $data['tutorados'][0]['email'];
			$titulo    = 'UEAs Aceptadas '.$data['tutorados'][0]['matricula'];
			$mensaje   = 'Tus materias han sido confirmadas';
			$cabeceras = 'From: sistema_posgrado@xanum.uam.mx' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			$envio = enviar($correo_destino, $titulo, $mensaje, $nombre);

			if($envio == 1){
				$data['horarios'] = $this->profesor_model->obtener_horarios($matricula);

				$email = '';//correo del coordinador
	         	$titulo = 'Mensaje de contacto al Coordinador';
	         	$contenido = 'EL alumno'.$nombre.' ha concluido satisfactoriamente su Preinscripcion';
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

         		$envio_coordinador = enviar($email,$titulo,$contenido,$nmbre);

         		if ($envio_coordinador == 1) {
         			////////////////////////////////////////////////////////
         		} else {
         			$this->response(array("code" => 204, "response" => "No se envio el correo"));
         		}
         		

     		} else {
         		$echoError .= "El correo no se pudo envíar correctamente, favor de intentar nuevamente.";
         		$this->response(array("code" => 204, "response" => "No se envio el correo"));
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
			$nombre=$data['tutorados'][0]['apellido_paterno'].' '.$data['tutorados'][0]['apellido_materno'].' '.$data['tutorados'][0]['nombres'];
			
			$correo_destino = $data['tutorados'][0]['email'];
			$titulo    = 'UEAs Canceladas '.$data['tutorados'][0]['matricula'];
			$mensaje   = 'Tu inscripcion ha sido rechazada, vulve a preinscribirte';

			enviar($correo_destino, $titulo, $mensaje, $nombre);
		}else{
			$this->response(array("code" => 204, "response" => "No se encontraron datos"));
		}
	}

	function enviar($correo_destinatario, $titulo, $contenido, $nombre_destinatario){
        //Psasar AL modelo $correo_coordinador=$this->alumno_model->obtener_correo_coordinador();
        /*$mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'xanum.uam.mx';
            $mail->SMTPAuth = true;
            $mail->Username = 'siscyti@xanum.uam.mx';
            $mail->Password = '********';
            $mailSMTPSecure = 'tls';
            $mail->CharSet = 'UTF-8';
            $mail->Port = 25;
            $mail->SMTPOptions = array('ssl'=>array(
                        'verify_peer'=>false,
                        'verify_peer_name'=>false,
                        'allow_self_signed'=>true));

            $mail->setFrom('siscyti@xanum.uam.mx', 'Sistema de administración PCyTI');
            $mail->addAddress($correo_destinatario, $nombre_destinatario);
            $mail->addReplyTo($correo_coordinador, 'Informacion');

            $mail->isHTML(true);
            $mail->Subject = $titulo;
            $mail->Body = $contenido;

            $mail->AltBody='';

            $mail->send();
            echo "El mensaje fue enviado";
            return 1;
        } catch (Exception $e) {
            echo "Hubo un error al enviar el mensaje. Intenta nuevamente", $mail->ErrorInfo;
            return 0;
        }*/
        return 1;
    }

	public function pasar_a_hash(){
        $contra_aux = hash('sha256', $this->input->post('contraseña'));
        //$contra_aux = md5($this->input->post('contraseña'));
        $contraseña="'".$contra_aux."'";
        $this->ingresar($contraseña);
        //var_dump($contraseña);
    }

    public function mostrar_ventana_profesor(){
     $contraseña = "'".$this->input->post('contraseña')."'";
     $this->ingresar($contraseña);
    }

    public function cambiar_contrasena(){
  $nueva_contrasena = hash('sha256', $this->input->post('contrasena_nueva_confirm'));
  $datos_prof = $this->input->post('datosProf');
  $confirmacion = hash('sha256', $this->input->post('contrasena_actual'));

  if($nueva_contrasena == $datos_prof[0]){
   echo 'La contraseña nueva debe ser distinta de la actual. Por favor, escribe otra';
  } else if ($confirmacion != $datos_prof[0]) {
   echo 'La contraseña del primer campo, no coincide con la que tienes registrada';
  } else {  
   $this->profesor_model->cambiar_contrasena($nueva_contrasena, $datos_prof['economico']);
   echo "Contraseña nueva almacenada";
  }
 }
}