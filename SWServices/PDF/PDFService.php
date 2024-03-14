<?php
namespace SWServices\PDF;

use Exception;
use SWServices\PDF\PDFHelper as PDFHelper;
use SWServices\Helpers\RequestHelper as HttpRequest;
use SWServices\Services as Services;
use SWServices\PDF\PDFRequest as PDFRequest;
use SWServices\Helpers\ResponseHelper as Response;

class PDFService extends Services
{

    public function __construct($params) {
        parent::__construct($params);
    }
    /**
     * Inicializa PDF Service.
     * @return PDFService
     */
    public static function Set($params){
        
        return new PDFService($params);
        
    }
    /**
     * Servicio mediante el cual se genera un PDF a  partir de un documento XML y una plantilla.
     * @param string $xml XML timbrado.
     * @param string $logo FLogo en B64.
     * @param string $templateId Identificador de la plantilla.
     * @param string $extras Datos adicionales al xml.
     * @param string $isB64 Especifica si el XML está en B64.
     * @return PDFRequest
     */
     public static function GeneratePDF($xml, $logo, $templateId,$extras,$isB64=false){
        $params = array(
            "xml" => $xml
        );  
        $helper = new PDFHelper($params);
        $response = PDFRequest::sendReqGenerate(Services::get_urlApi(), Services::get_token(), $helper::getXml($isB64), $logo, $templateId,$extras);
        return $response;
    }

    /**
     * Servicio para generar o regenerar un PDF de un xml previamente timbrado y podrá guardar o remplazar 
     * el archivo PDF para ser visualizado en el ADT.
     * @param string $uuid Folio fiscal del comprobante.
     * @param string $extra Datos adicionales al xml.
     * @return HttpRequest
     */
    public static function RegeneratePDF($uuid, $extra=null){
        try {
            if(isset($extra)){
                $extra = json_encode($extra);
            }
            PDFHelper::validateUuid($uuid);
            return HttpRequest::postJson(Services::get_urlApi(),'/pdf/v1/api/RegeneratePdf/'.$uuid, Services::get_token(), $extra, Services::get_proxy());
        } catch (Exception $e) {
            return Response::handleException($e);
        }
    }

     
}


?>
