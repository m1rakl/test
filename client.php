<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

try {
    $client = new SoapClient('ws.wsdl', array(
        'trace' => true,
        'cache_wsdl' => WSDL_CACHE_NONE,
    ));
    
    $response = $client->getQuote(array('request' => 'asd'));
}
catch (SoapFault $e) {
    echo $e->getMessage();
}


echo '<pre>';
$log['__getLastRequest'] = $client->__getLastRequest();
$log['__getLastResponse'] = $client->__getLastResponse();

print_r($log);
