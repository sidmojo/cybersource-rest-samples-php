<?php
require_once __DIR__. DIRECTORY_SEPARATOR .'../../../vendor/autoload.php';
require_once __DIR__. DIRECTORY_SEPARATOR .'../../../Resources/ExternalConfiguration.php';

function VoidCreditWithServiceFee()
{
  $commonElement = new CyberSource\ExternalConfiguration();
  $config = $commonElement->ConnectionHost();
  
	$merchantConfig = $commonElement->merchantConfigObject();
	$apiclient = new CyberSource\ApiClient($config, $merchantConfig);
  $api_instance = new CyberSource\Api\VoidApi($apiclient);
  
  require_once __DIR__. DIRECTORY_SEPARATOR .'ProcessCreditWithServiceFee.php';
  $id = ProcessCreditWithServiceFee(true);
  
  $cliRefInfoArr = [
    'code' => 'test_void'
  ];
  $client_reference_information = new CyberSource\Model\Ptsv2paymentsClientReferenceInformation($cliRefInfoArr);

  $paymentRequestArr = [
    "clientReferenceInformation" => $client_reference_information
  ];
  $paymentRequest = new CyberSource\Model\VoidCreditRequest($paymentRequestArr);
  
  $api_response = list($response,$statusCode,$httpHeader) = null;
  
  try {
    $api_response = $api_instance->voidCredit($paymentRequest, $id);
    
	print_r($api_response);
  } 
  catch (Cybersource\ApiException $e) {
    print_r($e->getResponseBody());
    print_r($e->getMessage());
  }
}    

// Call Sample Code
if(!defined('DO_NOT_RUN_SAMPLES')){
    echo "Void Credit With Service Fee Sample code is Running.. \n";
    VoidCreditWithServiceFee();
}
?>	
