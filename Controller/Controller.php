<?php


namespace ApiBancoDigital\Controller;

use Exception;


abstract class Controller 
{

    protected static function LogError(Exception $e)
    {
        $f = fopen("erros.txt", "w");
        fwrite($f, $e->getTraceAsString());
    }


    
    protected static function getExceptionAsJSON(Exception $e)
    {
        $exception = [
            'message' => $e->getMessage(), 
            'code' => $e->getCode(), 
            'file' => $e->getFile(), 
            'line' => $e->getLine(), 
            'traceAsString' => $e->getTraceAsString(), 
            'previous' => $e->getPrevious()
        ];
        
        http_response_code(400);

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($exception));
    }

    
    protected static function getResponseAsJSON($data)
    {
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($data));
    }

    
    protected static function setResponseAsJSON($data, $request_status = true)
    {
        $response = array('response_data' => $data, 'response_successful' => $request_status);

        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($response));
    }
}