<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

function __autoload($class)
{
    require_once 'library/' . str_replace('_', '/', $class) . '.php';
}

class ServerClass
{
    private $quotes = array(
        'asd' => 123
    );
    /**
     * Method for testing SOAP server with Zend_Soap_AutoDiscover 
     *
     * @param array $parameters
     * @return array
     */
    function getQuote($parameters)
    {
        //if (isset($this->quotes[$parameters->request]))
        if (isset($this->quotes[$parameters['request']]))
        {
            return array('result' => 'ok', 'status' => array('code' => $this->quotes[$parameters->request], 'description' => 'sometext'));
        }
        else
        {
            throw new SoapFault('ServerCode', 'Not found ' . $symbol);
        }
    }

}
 
$wsdl = 'http://test/soap/zend_server.php?wsdl';
 
if(isset($_GET['wsdl'])) {
  require_once 'Zend/Soap/AutoDiscover.php';
  $autodiscover = new Zend_Soap_AutoDiscover();
  $autodiscover->setClass('ServerClass');
  $autodiscover->handle();
} else {
  require_once 'Zend/Soap/Server.php';
  $soap = new Zend_Soap_Server($wsdl);
  $soap->setClass('ServerClass');
  $soap->handle();
}