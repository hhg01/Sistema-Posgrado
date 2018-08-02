<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');
class PHPWord_Text extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('word');
    }
    function index() {
		
        $this->load->library('PHPWord');
        $document = $this->phpword->loadTemplate("application/docs/temp/Temp.docx");

        $valor1 = "Hola Mundo";
        $valor2 = "¡Si se pudo! o/";
        $valor3 = "55";
        $valor4 = "hola";
        $valor5 = "8888";

        $document->setValue('Value1', $valor1);
        $document->setValue('Value2', $valor2);
        $document->setValue('Value3', $valor3);
        $document->setValue('Value4', $valor4);
        $document->setValue('Value5', $valor5);
		
        $document->save('application/docs/PTemplate.docx');

        /*
        $PHPWord = $this->word; // New Word Document
        $document = $PHPWord->loadTemplate("application/docs/Temp.docx");

        $valor1 = "Hola Mundo";
        $valor2 = "¡Si se pudo! o/";

        $document->setValue('Value1', $valor1);
        $document->setValue('Value2', $valor2);
        
        $filename='PTemplate.docx'; //save our document as this file name
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'); //mime type
        header('Content-Disposition: attachment; filename="'.$filename.'"; charset=iso-8859-1'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
        $objWriter->save('php://output');
        */
    }

    public function templateW(){
        
          $this->load->library('PHPWord');
          $document = $this->phpword->loadTemplate('application/docs/temp/Template.docx');
          $document->setValue('myReplacedValue','Test');
          $document->setValue('Value1', 'Sun');
          $document->setValue('Value2', 'Mercury');
          $document->setValue('Value3', 'Venus');
          $document->setValue('Value4', 'Earth');
          $document->setValue('Value5', 'Mars');
          $document->setValue('Value6', 'Jupiter');
          $document->setValue('Value7', 'Saturn');
          $document->setValue('Value8', 'Uranus');
          $document->setValue('Value9', 'Neptun');
          $document->setValue('Value10', 'Pluto');
          
          $document->setValue('weekday', date('l'));
          $document->setValue('time', date('H:i'));
          $document->save('application/docs/Solarsystem.docx');
    }
}
?>
