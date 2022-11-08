<?php
namespace SWServices\PDF;

use SWServices\PDF\PdfHelper as PdfHelper;
use SWServices\Services as Services;
use SWServices\PDF\PdfRequest as PdfRequest;

class PdfService extends Services 
{
    public function __construct($params) {
        parent::__construct($params);
    }

    public static function Set($params){
        
        return new PdfService($params);
        
    }
     public static function GeneratePDF($urlApi, $xml, $logo, $templateId,$extras,$isB64=false){
        $params = array(
            "xml" => $xml,
            "urlApi" => $urlApi
        );  
        $helper = new PdfHelper($params);
        $response = PdfRequest::sendReqGenerate($helper::get_urlApi(), Services::get_token(), $helper::get_xml($isB64), $logo, $templateId,$extras);
        return $helper::get_response($response);
    }
     
}


?>