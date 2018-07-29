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
        $ueas=$_POST['ueas'];
        //$clave_uea=
        $data = $this->input->post('datos');
        $matricula=$data['matricula'];
        $contrasena=$data['0'];
        $i=0;
        foreach ($ueas as $uea) {
            $planeaciones[$i]=$this->alumno_model->obtener_planeacion($uea['Clave']);
            $i++;
        }
        foreach ($planeaciones as $planeacion) {
            $this->alumno_model->agregar_a_horario($planeacion[0]['id_planning'],$matricula);
        }
        $this->enviar_correo_confirmacion($matricula, $contrasena);
    }

    function agregar_uea_blanco(){
        $data = $this->input->post('datos');
        $matricula=$data['matricula'];
        $contrasena=$data['0'];
        $id_blanco = $this->alumno_model->obtener_planeacion(0);
        $this->alumno_model->agregar_a_horario($id_blanco[0]['id_uea'],$matricula);//0 porque el id de la uea en blanco es 0
        $this->enviar_correo_confirmacion($matricula, $contrasena);
    }

    function enviar_correo_confirmacion($matricula, $contrasena){
        var_dump("DENTRO DEL MÉTODO ENIAR CORREO CONFIRMACION");
        //var_dump($matricula);
        $correo = $this->alumno_model->obtener_correo_responsable($matricula);
        //Envío del mensaje
        $datos = $this->alumno_model->obtener_datos_alumno($matricula,$contrasena);
        $horario = $this->alumno_model->obtener_horario($matricula);
        $titulo = "Confirmación de horario del alumno ".$matricula;
        $encabezado = 'From: sistema_posgrado@xanum.uam.mx'."\r\n".'X-Mailer: PHP/'.phpversion();
        $encabezado.='Content-type:text/html;charset=UTF-8';
        $contenido = "</<!DOCTYPE html>
                    <html>
                    <head><title></title></head>
                    <body>
                        <p>
                        El alumno ".$datos[0]['apellido_paterno']." ".$datos[0]['apellido_materno']." ".$datos[0]['nombres']." ha escogido el siguiente horario:
                        </p>
                        <div>
                            <table>
                                <thead>
                                    <th>Clave</th>
                                    <th>Nombre UEA</th>
                                    <th>Créditos</th>
                                </thead>
                                <tbody>";
                                    foreach ($horario as $uea) {
                                        $contenido.="<tr>
                                                <td>".$uea['clave_uea']."</td>
                                                <td>".$uea['nombre']."</td>
                                                <td>".$uea['creditos']."</td>
                                            </tr>";
                                    }
                                $contenido.="</tbody>
                            </table>
                        </div>
                        <p>
                            Ingresa a <a href='LINK DEL SISTEMA'>la pagina del sismeta</a> Para confirmar o cancelar las opciones de este alumno.
                        </p>
                    </body>
                    </html>";
        ini_set("display_errors", 1);
        //error_reporting(E_ALL);
        $envio = mail($correo[0]['email'], $titulo, $contenido, $encabezado);
        if($envio == 1){
            echo "El mensaje se ha enviado correctamente";
        } else {
            $echoError .= "El correo no se pudo envíar correctamente, favor de intentar nuevamente.";
        }
        //var_dump($correo[0]['email']);FALTA VERIFICAR QUE SÍ ESTE ENVIANDO EL MENSAJE


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