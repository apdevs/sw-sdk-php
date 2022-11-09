<?php

namespace SWServices\PDF;
use Exception;
/*Clase para las funciones de ayuda
para los servicios PDF*/
class PdfHelper
{
    private static $xml = null;
    private static $_response = null;
    private static $_urlApi = null;


    public function __construct($params)
    {
        if (!empty($params['xml'])) {
            self::$xml = $params['xml'];
        }
    }
    public static function get_xml($isB64)
    {
        try {

            if ($isB64 == false) {
                return self::validate_xml(self::$xml);

            } else {
                return self::validate_xml(base64_decode(self::$xml));
            }

        } catch (Exception $e) {
            echo 'xml no válido', $e->getMessage();
            exit();
        }


    }
    public static function validate_xml($xml){
        if(!empty($xml)){
            return $xml;
        }else{
            echo 'si responde con el resultado';
            exit();
             
        }
    }

};