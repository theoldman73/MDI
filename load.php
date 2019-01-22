<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Merchant Digital Identity(MDI)</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="icon" href="favicon.ico">
    <!-- Roboto -->
    <link rel="stylesheet" href="fix/family_Roboto_400_500_700.css">

    <link rel="stylesheet" href="css/ratchet.min.css">
    <link rel="stylesheet" href="css/ratchet-theme-android.min.css">
    <link rel="stylesheet" href="css/app.css">
	<!-- Start Style -->	
	<!-- End Style -->
    <script src="js/ratchet.min.js"></script>
    <script src="js/modals.js"></script>
    <script src="js/popovers.js"></script>
    <script src="js/segmented-controllers.js"></script>
    <script src="js/sliders.js"></script>
    <script src="js/toggles.js"></script>	
    <script src="js/push.js"></script> 	
    <script src="js/jquery-3.3.1.min.js"></script> 
	<script src="bootstrap-min/fun932017.js"></script>	
  </head>
  <body>
    <!-- Azz : Load Main Menu -->
	<?php include 'main_header.php';?>
    <!-- Azz : End Load Main Menu -->	
<!-- End of Main Menu -->  
	<div class="content">
	<h6></h6>
		<form class="input-group"> 				
			<div class="input-row">
				<label>Mobile: </label>
				<input type="text" id="txtMobile" placeholder="" value="01210539084" maxlength="11" required >
			</div>	
			<div class="input-row">
				<label>PIN: </label>
				<input type="text" id="txtPin" placeholder="135246"  maxlength="6" required>
			</div>	
			<div class="input-row">
				<label>Mobile To: </label>
				<input type="text" id="txtMobileto" placeholder="" value="01220394719" maxlength="11" required >
			</div>			
			<div class="input-row">
				<label>Amount&nbsp;(EGP): </label>
				<input type="number" id="txtAmount"  placeholder="" value="" required>
			</div>
			
			<button type="button" class="btn btn-block" Onclick="cmd_submit()">Submit</button>		
		</form>
		

		<div align="center">
			<img  src="image/QR.png" style="width:200px; height:200px">
		</div>		

<script>
	$(document).ready(function(){

	}); //--- Azz: $(document).ready(function(){	
	

	function cmd_submit()
	{
		var Pin = $("#txtPin").val();
		var Amount = $("#txtAmount").val();
		var Mobile = $("#txtMobile").val();
		var MobileTo = $("#txtMobileto").val();		
		

		setCookie("coo_lPin",Pin, 1);
		setCookie("coo_lAmount",Amount, 1);
		setCookie("coo_lMobile",Mobile, 1);
		setCookie("coo_lMobileTo",Mobile, 1);		
		
		var vCheck=0;
	
		if (Amount == "")
		{
			alert ("Pls Enter Amount.");
			vCheck =1;
			return;
		}		

		if (Pin == "")
		{
			alert ("Pls Enter PIN Code.");
			vCheck =1;
			return;
		}	
		
		if (Mobile == "")
		{
			alert ("Pls Enter From Mobile.");
			vCheck =1;
			return;
		}
		
		if (MobileTo == "")
		{
			alert ("Pls Enter To Mobile.");
			vCheck =1;
			return;
		}
		
		
		  if (vCheck==0){
			 var dataString="";
			dataString ="mobile=" + Mobile + "&pin=" + Pin + "&mobileto=" + MobileTo + "&amount=" + Amount;
			$.ajax({
				type: "POST",
				url: "./get_money.php?",
				data: dataString,
				cache: false,
				success: function(result) 	{
					alert(result);
					console.log ("Azz : Money is sent [POST is done] -> [" + result + "].");
					//---
					//$('#').val("");
					//$('#').val("");
					//$("#").val("");
					alert ("Money is sent.");
					//---			
											} 
					});
		  }		
		
	}
</script>
  </body>
</html>
