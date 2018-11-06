<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('vendor/autoload.php');
require_once('./Resources/Configuration.php');

function DeletePaymentsInstruments()
{
	$commonElement = new CyberSource\Configuration();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\PaymentInstrumentApi($apiclient);
  	include_once '../cybersource-rest-samples-php/Samples/TMS/CoreServices/RetrievePaymentInstrument.php';
  	$tokenId = RetrievePaymentInstrument(true);
  	$profileId = '93B32398-AD51-4CC2-A682-EA3E93614EB1';
	$api_response = list($response,$statusCode,$httpHeader)=null;
	try {
		$api_response = $api_instance->paymentinstrumentsTokenIdDelete($profileId, $tokenId);
		echo "<pre>";print_r($api_response);

	} catch (Cybersource\ApiException $e) {
    print_r($e->getMessage());
	}
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
	DeletePaymentsInstruments();

}
?>	
