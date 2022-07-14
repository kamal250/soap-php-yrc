<?php 
require_once("./vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new SoapClient($_ENV['YRC_SOAP_ENDPOINT']);

// $types = $client->__getTypes();
// echo "---types---";
// echo "<pre>"; print_r($types);

// echo "---functions---";
// $functions = $client->__getFunctions();
// echo "<pre>"; print_r($functions);

// Credentials
$usernameToken = [];
$usernameToken['Username'] = $_ENV['YRC_SOAP_USERNAME'];
$usernameToken['Password'] = $_ENV['YRC_SOAP_PASSWORD'];

$submitBOLRequest = [];

// BOL Detail
$bolDetail = [];
$bolDetail['pickupDate'] = '07/18/2022';
$bolDetail['role'] = 'SH';
$bolDetail['autoSchedulePickup'] = true;
$bolDetail['autoEmailBOL'] = true;
$bolDetail['autoEmailBOLaddress'] = 'kamal@solvative.com';
$bolDetail['paymentTerms'] = 'P';
$bolDetail['originAddressSameAsShipper'] = true;
$submitBOLRequest['bolDetail'] = $bolDetail;

// Shipper
$shipper = [];
$shipper['companyName'] = 'My Shipping Co';
$shipper['address'] = '1213 Main St.';
$shipper['city'] = 'STOW';
$shipper['state'] = 'OH';
$shipper['zip'] = '44224';
$shipper['country'] = 'USA';
$shipper['phoneNumber'] = '3303849000';
$shipper['businessID'] = '';
$submitBOLRequest['shipper'] = $shipper;

// Consignee
$consignee = [];
$consignee['companyName'] = 'Ship To';
$consignee['address'] = '100 main st';
$consignee['city'] = 'beverly hills';
$consignee['state'] = 'CA';
$consignee['zip'] = '90210';
$consignee['country'] = 'USA';
$consignee['storeNumber'] = '21';
$consignee['contactName'] = 'Bob';
$consignee['phoneNumber'] = '330-456-1234';
$submitBOLRequest['consignee'] = $consignee;

// Commodity Information
$commodityInformation = [];
$commodityInformation['weightTypeIdentifier'] = 'LB';
$submitBOLRequest['commodityInformation'] = $commodityInformation;

// Commodity Items allowed upto 20 only
$commodityItems = [];
$commodityItem1 = [];
$commodityItem1['totalWeight'] = 100;
$commodityItem1['handlingUnitQuantity'] = 1;
$commodityItem1['handlingUnitType'] = 'SKD';
$commodityItem1['packageQuantity'] = 10;
$commodityItem1['packageUnitType'] = 'BOX';
$commodityItem1['productDesc'] = 'Books';
$commodityItem1['nmfc'] = '486001';
$commodityItem1['freightClass'] = '60';
$commodityItem1['isHazardous'] = false;
$commodityItems[0] = $commodityItem1;
$submitBOLRequest['commodityItem'] = $commodityItems;

// Reference Numbers allowed upto 20 only
$referenceNumbers = [];
$referenceItem1 = [];
$referenceItem1['refNumber'] = '345344555';
$referenceItem1['refNumberType'] = 'BM';
$referenceItem1['storeNumber'] = '32';
$referenceItem1['deptNumber'] = '563';
$referenceItem1['pieces'] = '3';
$referenceNumbers[0] = $referenceItem1;
$submitBOLRequest['referenceNumbers'] = $referenceNumbers;

// Special Instructions
$specialInstuctions = [];
$specialInstuctions['dockInstructions'] = 'my dock instructions';
$submitBOLRequest['specialInstuctions'] = $specialInstuctions;

// COD
$cod = [];
$cod['codAmount'] = 125.44;
$cod['codCurrency'] = 'USD';
$cod['customerCheckOk'] = true;
$cod['codFee'] = 'P';
$submitBOLRequest['cod'] = $cod;

// Service Options allowed upto 20
$serviceOptions = [];
$serviceItem1 = [];
$serviceItem1['serviceOptionType'] = 'LFTD';
$serviceItem1['serviceOptionPaymentTerms'] = 'P';
$serviceOptions[0] = $serviceItem1;
$submitBOLRequest['serviceOptions'] = $serviceOptions;

// Delivery Service Options
$deliveryServiceOptions = [];
$deliveryServiceOptions['deliveryServiceOption'] = 'LTL';
$submitBOLRequest['deliveryServiceOptions'] = $deliveryServiceOptions;

// Pickup request
$pickupRequest = [];
$pickupRequest['pickupLocationContactName'] = 'Jim Bob';
$pickupRequest['pickupLocationPhone'] = '3303849000';
$pickupRequest['pickupLocationPhoneExtension'] = '123';
$pickupRequest['pickupNotes'] = 'Notes for pickup';
$pickupRequest['shipmentReadyTime'] = '10:00';
$pickupRequest['dockCloseTime'] = '16:00';
$pickupRequest['isCertifiedPickup'] = true;
$pickupRequest['certifiedPickupEmailAddress'] = 'kamal+cert@solvative.com';
$pickupRequest['sendConfirmationEmail'] = true;
$pickupRequest['confirmationEmailAddress'] = 'kamal+confirm@solvative.com';
$submitBOLRequest['pickupRequest'] = $pickupRequest;

// BOL PDF labeling
$bolLabelPDF = [];
$bolLabelPDF['generateBolPDF'] = true;
$bolLabelPDF['bolDocumentType'] = 'STD';
$bolLabelPDF['generateShippingLabelsPDF'] = true;
$bolLabelPDF['numberOfLabelsPerShipment'] = '1';
$bolLabelPDF['labelStartingPosition'] = '1';
$bolLabelPDF['labelFormat'] = 'AVERY_5164';
$bolLabelPDF['generateProLabelsPDF'] = true;
$bolLabelPDF['proLabelBorders'] = false;
$bolLabelPDF['proLabelsPerPage'] = '5';
$submitBOLRequest['bolLabelPDF'] = $bolLabelPDF;

// Call wsdl function
$result = $client->__soapCall("submitBOL", array(
    "Credentials" => $usernameToken,
    "submitBOLRequest" => $submitBOLRequest,
));

// $client->submitBOL($usernameToken, $submitBOLRequest);

// echo "<pre>";
// print_r($result);

?>
