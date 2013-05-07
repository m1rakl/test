<?php

class ServerClass
{
    private $quotes = array(
        'asd' => 123
    );

    function getQuote($parameters)
    {
        if (isset($this->quotes[$parameters->request]))
        {
            return array('result' => 'ok', 'status' => array('code' => $this->quotes[$parameters->request], 'description' => 'sometext'));
        }
        else
        {
            throw new SoapFault('ServerCode', 'Not found ' . $symbol);
        }
    }

}

ini_set('soap.wsdl_cache_enabled', false);
$server = new SoapServer('ws.wsdl');
$server->setClass('ServerClass');
$server->handle();
