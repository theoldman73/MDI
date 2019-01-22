<?php
include('oopdb.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$mobile		= test_input($_POST["mobile"]);
	$pin		= test_input($_POST["pin"]);
	$mobileto	= test_input($_POST["mobileto"]);	
    $amount		= test_input($_POST["amount"]);
   // printf("%s %s %s",$mobile,$pin,$amount);
	
	$url = 'http://10.58.210.36:7890/mmoney/CelliciumSelector?LOGIN=Ussd_Bearer1&PASSWORD=MPtc1ToayCkCMZZeHUu0snA3aUaPbSFQ9UzIkNGbVRU=&REQUEST_GATEWAY_CODE=USSD&REQUEST_GATEWAY_TYPE=USSD';
	$obj = new CAddpayment;
	
	
	$obj->MSISDN = '01210539084';
	$tmp = $obj->XML_Request_Tag();
	$baseUrl = $url;
	$requestPayload = array(
	  "commandFile"=>"/tmp/test.sh",
	  "initialWorkingDirectory"=>"/tmp",
	  "user"=>"adaptive",
	  "requirements"=>array(
      array("requiredNodeCountMinimum"=>1)
							)
							);	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/xml"));
	//curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_URL, "$baseUrl");
	// Setup POST request
	curl_setopt($ch, CURLOPT_POSTFIELDS, $tmp);
	curl_setopt($ch, CURLOPT_POST, 1);
	$responseBody = curl_exec($ch);
	$ObjGet=$obj->Response_XML($responseBody);
	echo ($ObjGet->MESSAGE);	
	
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>