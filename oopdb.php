<?php
	//*** Class CCheckEligibility 	***//
	//*** Date : 21/01/2019 ***//	
	//---  Start Check_eligibility ---//	
	class CCheckEligibility {
	public $TYPE;
	public $MSISDN;
	public $PROVIDER;
	public $URL;
	public $TXNSTATUS;
	public $TRID;
	public $MESSAGE;
	
		public function __construct()
		{		
			$this->URL			= 	"";	//--- Serve Side
			$this->TYPE			=	"FTUREQ"; //--- Request Type of the service. 
			$this->MSISDN		=	""; //--- Mobile number of the subscriber.
			$this->PROVIDER		=	"101";	//--- Provider ID for the subscriber.
			$this->TXNSTATUS	=	"";	//--- Status of the request (200).
			$this->TRID			=	""; //--- Provider ID for the subscriber.
			$this->MESSGE		=	""; //--- Status descriptions (Success).	
		}	

		public function	XML_Request_Tag()
		{
			$rcXML='<?xml version="1.0"?>';
			$rcXML .='<COMMAND>';
			$rcXML .='<TYPE>' . $this->TYPE . '</TYPE>';
			$rcXML .='<MSISDN>' . $this->MSISDN . '</MSISDN>';
			$rcXML .='<PROVIDER>' . $this->PROVIDER . '</PROVIDER>';
			$rcXML .='</COMMAND>';			
			return $rcXML;
		}
		
		public function Request_XML()
		{		
			//--- Azz: URL: https://www.codediesel.com/php/posting-xml-from-php/
			//$url =  "http://www.some_domain.com";

			$post_string = XML_Request_Tag();

			$header  = "POST HTTP/1.0 \r\n";
			$header .= "Content-type: text/xml \r\n";
			$header .= "Content-length: ".strlen($post_string)." \r\n";
			$header .= "Content-transfer-encoding: text \r\n";
			$header .= "Connection: close \r\n\r\n"; 
			$header .= $post_string;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt($ch, CURLOPT_URL,$this->URL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 4);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $header);

			$data = curl_exec($ch); 

			if(curl_errno($ch))
				print curl_error($ch);
			else
				curl_close($ch);
			return ($data);

		}	// Request_Check_eligibility_XML
		
		public function Request2_XML() 
		{
			//--- Azz: URL: https://gist.github.com/jnaskali/2000102
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->URL);

			// For xml, change the content-type.
			curl_setopt ($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));

			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, RE_Request_XML());

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // ask for results to be returned

			//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //  if you post to a https address, you put this another line.
			// Send to remote and return data to caller.
			$result = curl_exec($ch);
			curl_close($ch);
			return $result;
		}			
	
		public function Response_XML($MsgXML)
		{
			//echo $MsgXML;
			
			//--- Azz: URL: https://stackoverflow.com/questions/18000904/extract-data-from-xml-response-w-php
			//$xml = simplexml_load_string($MsgXML) or die("Error: Cannot create object [Response_XML]");
			$xml_output=simplexml_load_string($MsgXML) or die("Error: Cannot create object");
			
			//echo $xml_output->MESSAGE;
			//die;
			/*if ($xml === false) {
				echo "Failed loading XML: ";
				foreach(libxml_get_errors() as $error) {
					echo "<br>", $error->message;
				}
			} else {
				print_r($xml);
			}*/
			//--- OOP
			//echo($xml_output);
			//return;
			  $this->TYPE			 =  $xml_output->TYPE;
			  $this->TXNSTATUS		 =  $xml_output->TXNSTATUS;
			  $this->TRID			=  $xml_output->TRID;
			  $this->MESSGE			=  $xml_output->MESSAGE;
			//--- OPP
			return ($xml_output);
		}
	
	} // CCheckEligibility	
	//---  End Check_eligibility ---//	
	//------------------------------------------------//
	//*** Class CWallet_balance_inquiry 	***//
	//*** Date : 21/01/2019 ***//	
	//---  Start Check_eligibility ---//
	class CWalletbalanceinquiry {
		public $TYPE;
		public $MSISDN;
		public $PROVIDER;
		public $URL;
		public $PAYID;
		public $PIN;
		public $TRID;
		public $MESSAGE;	
		public $TXNID;	
		public $BALANCE;
		public $FRBALANCE;
		
		public function __construct()
		{		
			$this->TYPE			=	"FTUREQ"; //--- Request Type of the service. 
			$this->MSISDN		=	""; //--- Status of the request.	
			$this->PROVIDER		=	"101";	//--- Provider ID for the subscriber.			
			$this->URL			= 	"";	//--- Serve Side	
			$this->PAYID		=	"12"; //--- Wallet ID of payer.
			$this->PIN			=	""; //--- Personal identification number of payer.
			$this->TRID			=	""; //-- Provider ID for the subscriber.
			$this->MESSAGE		=	""; //--- Status descriptions
			$this->TXNID		=	"";	//--- Status of the request	
			$this->BALANCE		=	"";	//--- Available Balance for the subscriber.
			$this->FRBALANCE	=	"";	//--- Frozen subscriber Balance	
		}	
		
		public function	XML_Request_Tag()
		{	
			$rcXML='<?xml version="1.0"?>';
			$rcXML .='<COMMAND>';
			$rcXML .='<TYPE>' . $this->TYPE . '</TYPE>';
			$rcXML .='<MSISDN>' . $this->MSISDN . '</MSISDN>';
			$rcXML .='<PROVIDER>' . $this->PROVIDER . '</PROVIDER>';	
			$rcXML .='<PAYID>' . $this->PAYID . '</PAYID>';
			$rcXML .='<PIN>' . $this->PAYID . '</PIN>';			
			$rcXML .='</COMMAND>';			
			return $rcXML;
		}
		
		public function Request_XML()
		{		
			//--- Azz: URL: https://www.codediesel.com/php/posting-xml-from-php/
			//$url =  "http://www.some_domain.com";

			$post_string = XML_Request_Tag();

			$header  = "POST HTTP/1.0 \r\n";
			$header .= "Content-type: text/xml \r\n";
			$header .= "Content-length: ".strlen($post_string)." \r\n";
			$header .= "Content-transfer-encoding: text \r\n";
			$header .= "Connection: close \r\n\r\n"; 
			$header .= $post_string;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt($ch, CURLOPT_URL,$this->URL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 4);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $header);

			$data = curl_exec($ch); 

			if(curl_errno($ch))
				print curl_error($ch);
			else
				curl_close($ch);
			return ($data);

		}	// Request_Check_eligibility_XML

		public function Request2_XML() 
		{
			//--- Azz: URL: https://gist.github.com/jnaskali/2000102
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->URL);

			// For xml, change the content-type.
			curl_setopt ($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));

			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, RE_Request_XML());

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // ask for results to be returned

			//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //  if you post to a https address, you put this another line.
			// Send to remote and return data to caller.
			$result = curl_exec($ch);
			curl_close($ch);
			return $result;
		}	
		
		public function Response_XML($MsgXML)
		{
			//--- Azz: URL: https://stackoverflow.com/questions/18000904/extract-data-from-xml-response-w-php
			$xml = simplexml_load_string($MsgXML) or die("Error: Cannot create object [Response_XML]");
			/*if ($xml === false) {
				echo "Failed loading XML: ";
				foreach(libxml_get_errors() as $error) {
					echo "<br>", $error->message;
				}
			} else {
				print_r($xml);
			}*/
			//--- OOP		
			  $this->TYPE			=  $xml->TYPE;
			  $this->TXNID			=  $xml->TXNID;
			  $this->TXNSTATUS		=  $xml->TXNSTATUS;
			  $this->TRID			=  $xml->TRID;
			  $this->MESSGE			=  $xml->MESSGE;
			  $this->BALANCE		=  $xml->BALANCE;
			  $this->FRBALANCE		=  $xml->FRBALANCE;
			//--- OPP
			return ($xml);
		}	
	
	} // CWalletbalanceinquiry
	//---  End CWalletbalanceinquiry ---//
	//------------------------------------------------//
	//*** Class CAddpayment 	***//
	//*** Date : 21/01/2019 ***//	
	//---  Start App Payment ---//
	class CAddpayment {
		public $TYPE;
		public $MSISDN;
		public $PIN;	
		public $PROVIDER;
		public $PAYID;	
		public $MSISDN2;
		public $PROVIDER2;
		public $PAYID2;
		public $AMOUNT;
		public $URL;
		public $TXNSTATUS;
		public $TRID;
		public $MESSAGE;
		public $TXNID;
		
		public function __construct()
		{		
			$this->TYPE			=	"FTUREQ"; //--- Request Type of the service. 
			$this->MSISDN		=	""; //--- Status of the request.	
			$this->PIN			=	""; //--- Personal identification number of payer.
			$this->PROVIDER		=	"101";	//--- Provider ID for the subscriber.			
			$this->PAYID		=	"12"; //--- Wallet ID of payer.
			$this->MSISDN2		=	""; //--- Mobile number of the payee (receive).
			$this->PROVIDER2	=	"101";	//--- Provider ID for payee.
			$this->PAYID2		=	"12";	//--- Wallet ID of payee.
			$this->AMOUNT		=	"";	//--- Money amount to transfer.
			$this->URL			= 	"";	//--- Serve Side	
			$this->TXNSTATUS	= 	"";	
			$this->TRID			= 	"";	
			$this->MESSAGE		= 	"";	
			$this->TXNID		= 	"";	
		
		}			

		public function	XML_Request_Tag()
		{	
		
			$rcXML='<?xml version="1.0"?>';
			$rcXML .='<COMMAND>';
			$rcXML .='<TYPE>'		. $this->TYPE 		. '</TYPE>';
			$rcXML .='<MSISDN>' 	. $this->MSISDN 	. '</MSISDN>';
			$rcXML .='<PIN>'		. $this->PIN 		. '</PIN>';
			$rcXML .='<PROVIDER>' 	. $this->PROVIDER 	. '</PROVIDER>';
			$rcXML .='<PAYID>' 		. $this->PAYID 		. '</PAYID>';
			$rcXML .='<MSISDN2>' 	. $this->MSISDN2 	. '</MSISDN2>';
			$rcXML .='<PROVIDER2>' 	. $this->PROVIDER2 	. '</PROVIDER2>';
			$rcXML .='<PAYID2>' 	. $this->PAYID2		. '</PAYID2>';
			$rcXML .='<AMOUNT>' 	. $this->AMOUNT 	. '</AMOUNT>';
			$rcXML .='</COMMAND>';
			
			return $rcXML;
		}		
	
		public function Request_XML()
		{		
			//--- Azz: URL: https://www.codediesel.com/php/posting-xml-from-php/
			//$url =  "http://www.some_domain.com";

			$post_string = XML_Request_Tag();

			$header  = "POST HTTP/1.0 \r\n";
			$header .= "Content-type: text/xml \r\n";
			$header .= "Content-length: ".strlen($post_string)." \r\n";
			$header .= "Content-transfer-encoding: text \r\n";
			$header .= "Connection: close \r\n\r\n"; 
			$header .= $post_string;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt($ch, CURLOPT_URL,$this->URL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 4);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $header);

			$data = curl_exec($ch); 

			if(curl_errno($ch))
				print curl_error($ch);
			else
				curl_close($ch);
			return ($data);

		}	// Request_Check_eligibility_XML
		
		public function Request2_XML() 
		{
			//--- Azz: URL: https://gist.github.com/jnaskali/2000102
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->URL);

			// For xml, change the content-type.
			curl_setopt ($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));

			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, RE_Request_XML());

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // ask for results to be returned

			//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //  if you post to a https address, you put this another line.
			// Send to remote and return data to caller.
			$result = curl_exec($ch);
			curl_close($ch);
			return $result;
		}			
	
		public function Response_XML($MsgXML)
		{
			//echo $MsgXML;
			
			//--- Azz: URL: https://stackoverflow.com/questions/18000904/extract-data-from-xml-response-w-php
			//$xml = simplexml_load_string($MsgXML) or die("Error: Cannot create object [Response_XML]");
			$xml_output=simplexml_load_string($MsgXML) or die("Error: Cannot create object");
			
			//echo $xml_output->MESSAGE;
			//die;
			/*if ($xml === false) {
				echo "Failed loading XML: ";
				foreach(libxml_get_errors() as $error) {
					echo "<br>", $error->message;
				}
			} else {
				print_r($xml);
			}*/
			//--- OOP
			//echo($xml_output);
			//return;
			  $this->TYPE			 =  $xml_output->TYPE;
			  $this->TXNSTATUS		 =  $xml_output->TXNSTATUS;
			  $this->TRID			=  $xml_output->TRID;
			  $this->MESSAGE		=  $xml_output->MESSAGE;
			  $this->TXNID			=	$xml_output->TXNID;
			//--- OPP
			return ($xml_output);
		}
		
	}
?>