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
            $this->response(array("code" => 204, "response" => "No se encontraron datos segunda version"));
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
        $contrasena=$data['0'];
        $i=0;
        foreach ($ueas as $uea) {
            $planeaciones[$i]=$this->alumno_model->obtener_planeacion($uea['Clave']);
            $i++;
        }
        if($this->enviar_correo_confirmacion($matricula, $contrasena, $ueas)==1){//Para verificar si es la uea blanca
            foreach ($planeaciones as $planeacion) {
                $this->alumno_model->agregar_a_horario($planeacion[0]['id_planning'],$matricula);
            }

            echo "El mensaje se ha enviado correctamente";
            var_dump("El mensaje se envió correctamente");
        } else {
            echo "Hubo un error al enviar el correo.";
        }
        
    }

    function agregar_uea_blanco(){
        $data = $this->input->post('datos');
        $matricula=$data['matricula'];
        $contrasena=$data['0'];

        //Un arreglo que se le parezca al arreglo donde se guardan todas las materiasi
        $lista= array('Clave'=>1111, 'Nombre'=>'UEA en blanco', 'Creditos'=>0 );
        $ueas=array();
        $ueas[0]=$lista;
        $id_blanco = $this->alumno_model->obtener_planeacion(0);
        if($this->enviar_correo_confirmacion($matricula, $contrasena, $ueas)==1){
           $this->alumno_model->agregar_a_horario($id_blanco[0]['id_uea'],$matricula);//0 porque el id de la uea en blanco es 0

            echo "El mensaje se ha enviado correctamente";
        } else {
            echo "Hubo un error al enviar el correo.";
        }
        
    }

    function enviar_correo_confirmacion($matricula, $contrasena, $ueas){
        $correo = $this->alumno_model->obtener_correo_responsable($matricula);
        $datos = $this->alumno_model->obtener_datos_alumno($matricula,$contrasena);
        $titulo = "Confirmación de horario del alumno ".$matricula;
        $encabezado = 'From: sistema_posgrado@xanum.uam.mx'."\r\n".'X-Mailer: PHP/'.phpversion();
        $encabezado.='Content-type:text/html;charset=UTF-8';


        //Si el id de la primer uea que encuentra es la blanca, solo indica que se inscribió en blanco
        if($ueas[0]['Clave'] == 1111){
            $contenido = "El alumno ".$datos[0]['apellido_paterno']." ".$datos[0]['apellido_materno']." ".$datos[0]['nombres']." ha escogido inscribirse en blanco.";      
        } else {
            $contenido = "El alumno ".$datos[0]['apellido_paterno']." ".$datos[0]['apellido_materno']." ".$datos[0]['nombres']." ha agregado las siguientes UEAs:"."\r\n".
            "Clave"."\t\t"."Créditos"."\t\t"."Nombre UEA"."\r\n";
            foreach ($ueas as $uea) {
                $contenido.=$uea['Clave']."\t\t".$uea['Creditos']."\t\t".$uea['Nombre']."\r\n";
            }
        }
        
        ini_set("display_errors", 1);
        $envio = mail($correo[0]['email'], $titulo, $contenido, $encabezado);
        if($envio == 1){
            return 1;
        } else {
            $echoError .= "El correo no se pudo envíar correctamente, favor de intentar nuevamente.";
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