<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Biblioteca PHPMailer
/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
*/
class Alumno extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('alumno_model');
    }

    public function pasar_a_hash(){
        //$contra_aux = md5($this->input->post('contraseña'));
        $contra_aux = hash('sha256', $this->input->post('contraseña'));
        $contraseña="'".$contra_aux."'";
        $this->obtener_informacion($contraseña);
        //var_dump($contraseña);
    }

    public function mostrar_vista_alumno(){
        $contraseña = "'".$this->input->post('contraseña')."'";
        $this->obtener_informacion($contraseña);
    }

    public function obtener_informacion($contraseña){
        $matricula = $this->input->post('matricula');

        $data['alumno_info_personal'] = $this->alumno_model->obtener_datos_alumno($matricula,$contraseña);
        //$data['paises'] = $this->alumno_model->regresa_paises();
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
        /*$num_direccion = $this->input->post('id_direccion');
        $vialidad = $this->input->post('vialidad');
        $exterior = $this->input->post('exterior');
        $interior = $this->input->post('interior');
        $cp = $this->input->post('cp');
        $localidad = $this->input->post('localidad');
        $estado = $this->input->post('estado');
        $municipio = $this->input->post('municipio');*/
        
       // if ($num_direccion != 1) {
        $this->alumno_model->actualizar_datos_alumno($usuario,$telefono,$celular,$correo);
            //$this->alumno_model->actualizar_direccion_alumno($num_direccion,$vialidad,$exterior,$interior,$cp,$localidad);
        //} else {
          //  var_dump("El id es 1");
            //$data['dir'] = $this->alumno_model->crear_direccion_alumno($vialidad,$exterior,$interior,$cp,$localidad,$municipio);
            //$this->alumno_model->actualizar_datos_alumno($usuario,$correo,$telefono,$celular);
           // $this->alumno_model->actualizar_direccion_alumno($num_direccion,$vialidad,$exterior,$interior,$cp,$localidad);
        //}
        
    }
    
    function agregar_horario(){
        $ueas=$this->input->post('ueas');
        $data = $this->input->post('datos');
        $matricula=$data['matricula'];
        $correo = $this->input->post('confirmacion');
        
        if($this->enviar_correo_confirmacion($matricula, $ueas, $correo)==1){
            //var_dump($ueas[1]);
            $i=0;
            foreach ($ueas as $uea) {
                //var_dump($uea['Clave']);
                $planeaciones[$i]=$this->alumno_model->obtener_planeacion($uea['Clave']);
                $i++;
            }
            //var_dump($planeaciones);
            foreach ($planeaciones as $planeacion) {
                //var_dump("PLANEACION PLANEACION PLANEACION PLANEACION PLANEACION");
                //var_dump($planeacion[0]['id_PLANNING']);
                $this->alumno_model->agregar_a_horario($planeacion[0]['id_planning'],$matricula);
            }
        } else {
            echo "Hubo un error al enviar el correo.";
            //$this->response(array("code" => 204, "response" => "No se encontraron datos"));
        }
    }

    function agregar_uea_blanco(){
        $data = $this->input->post('datos');
        $matricula=$data['matricula'];
        $correo = $this->input->post('confirmacion');

        //Un arreglo que se le parezca al arreglo donde se guardan todas las materiasi
        $lista= array('Clave'=>0, 'Nombre'=>'UEA en blanco', 'Creditos'=>0 );
        $ueas=array();
        $ueas[0]=$lista;
        $id_blanco = $this->alumno_model->obtener_planeacion(0);
        if($this->enviar_correo_confirmacion($matricula, $ueas, $correo)==1){
           $this->alumno_model->agregar_a_horario($id_blanco[0]['id_planning'],$matricula);//0 porque el id de la uea en blanco es 0

            echo "El mensaje se ha enviado correctamente";
        } else {
            echo "Hubo un error al enviar el correo.";
            //$this->response(array("code" => 204, "response" => "No se encontraron datos"));
        }
        
    }

    function enviar_correo_confirmacion($matricula, $ueas, $correo){
        $datos=$this->alumno_model->cofirmar_correo($correo, $matricula);
       // return 1;
        if($datos != NULL){
            $correo = $this->alumno_model->obtener_correo_responsable($matricula);
            $titulo = "Confirmación de horario del alumno ".$matricula;
            $nombre_completo=$datos[0]['apellido_paterno']." ".$datos[0]['apellido_materno']." ".$datos[0]['nombres'];
            //var_dump($correo);
            //Si el id de la primer uea que encuentra es la blanca, solo indica que se inscribió en blanco
            if($ueas[0]['Clave'] == 0){
                $contenido = "El alumno ".$nombre_completo." ha escogido inscribirse en blanco.";      
            } else {
                $contenido = "<p>El alumno ".$nombre_completo." ha agregado la(s) siguiente(s) UEA(s): </p>
                    <table>
                        <thead>
                            <th>Clave</th>
                            <th>Nombre UEA</th>
                            <th>Créditos</th>
                        </thead>
                        <tbody>";
                            foreach ($ueas as $uea) {
                                $contenido.="<tr>
                                   <td>".$uea['clave_uea']."</td>
                                    <td>".$uea['nombre']."</td>
                                    <td>".$uea['creditos']."</td>
                                </tr>";
                            }
                $contenido.='</p></tbody></table><p>Entra a la siguiente <a href="#">liga</a> para ver su horario </p>';
            }
            $envio = $this->enviar($correo[0]['email'], $titulo, $contenido, $nombre_completo);
            if($envio == 1){
                return 1;
            } else {
                $echoError = "El correo no se pudo envíar correctamente, favor de intentar nuevamente.";
                 return 0;
            }
            return 1;
        } else {
            return 0;
            //$this->response(array("code" => 204, "response" => "Tu correo electrónio no coincide con el que tienes registrado"));
        }
    }


    function enviar($correo_destinatario, $titulo, $contenido, $nombre_destinatario){
        $correo_coordinador=$this->alumno_model->obtener_correo_coordinador();
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
        }
    }

    
   /* function regresa_estados(){
        $id_pais = $this->input->post('id_pais');
        $lista_estados = $this->alumno_model->regresa_estados($id_pais);
        if ($lista_estados == NULL) {
            $lista = '<option value="Estados">Estados</option>';
            echo $lista;
            $this->response(array("code" => 204, "response" => "No se encontraron datos"));
        } else {
            $lista = '<option value="Estados">Estados</option>';
            foreach ($lista_estados as $estado) {
                $lista = $lista.'<option value="'.$estado['cve_ent'].'">'.$estado['nom_ent'].'</option>';
            }
                echo $lista;

        }
    }

    function regresa_municipios(){
        $id_estado = $this->input->post('id_estado');
        $lista_municipios = $this->alumno_model->regresa_municipios($id_estado);
        if ($lista_municipios == NULL) {
            $lista = '<option value="Municipios">Municipios</option>';
            echo $lista;
            $this->response(array("code" => 204, "response" => "No se encontraron datos"));
        } else {
            $lista = '<option value="Municipios">Municipios</option>';
            foreach ($lista_municipios as $municipio) {
                $lista = $lista.'<option value="'.$municipio['cve_mun'].'">'.$municipio['nom_mun'].'</option>';
            }
                echo $lista;

        }
    }*/
}