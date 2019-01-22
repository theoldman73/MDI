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
	<style>

	</style>		
	<!-- End Style -->
    <script src="js/ratchet.min.js"></script>
    <script src="js/modals.js"></script>
    <script src="js/popovers.js"></script>
    <script src="js/segmented-controllers.js"></script>
    <script src="js/sliders.js"></script>
    <script src="js/toggles.js"></script>	
    <script src="js/push.js"></script> 	
    <script src="js/jquery-3.3.1.min.js"></script> 
	<!-- <script src="js/qr_reader/jquery.min.js"></script> -->
	<script src="js/qr_reader/qrcode.js"></script>	
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
			<label>&nbsp;&nbsp;Company</label>
			<select class="input-row" id="optCompany" name="pref_edu_level">
				<option disabled selected value>-- select an Company --</option>
				<option value="1">Pepsico</option>
				<option value="2">CocaCola</option>
				<option value="3">Unilever</option>				
			</select>	
			<label>&nbsp;&nbsp;Product</label>	
			<!-- [Product]    --->
			<select class="input-row"  id="optProduct" name="pref_edu_level">
				<option disabled selected value>-- select an Product --</option>
				<option value="1">Cigarettes</option>
				<option value="2">Air time</option>
				<option value="3">Chocolate</option>	
				<option value="3">Soft drink</option>	
				
			</select>			
			<div class="input-row">
				<label>Amount&nbsp;(EGP): </label>
				<input type="number" id="txtAmount" placeholder="" value="" required>
			</div>
			<div class="input-row">
				<label>PIN: </label>
				<input type="text" id="txtPin" placeholder=""  maxlength="6" required>
			</div>				
			<button type="button" class="btn btn-block" Onclick="cmd_submit()">Submit</button>		
		</form>
	
		<div id="qrcode"  class="content-padded" style="width:200px; height:200px; margin-top:15px;"></div>

<script>

	var qrcode = new QRCode(document.getElementById("qrcode"), {
		width : 200,
		height : 200,
	colorDark : "#000000",
	colorLight : "#ffffff",
	correctLevel : QRCode.CorrectLevel.H			
	});	
	

	function cmd_submit()
	{
		var MerchantName = getCookie("coo_MerchantName");
		var Pin = $("#txtPin").val();
		var Amount = $("#txtAmount").val();
		var Product = $("#optProduct option:selected").text();
		var Company = $("#optCompany option:selected").text();	
		
		setCookie("coo_Pin",Pin, 1);
		setCookie("coo_Amount",Amount, 1);
		setCookie("coo_Product",Product, 1);
		setCookie("coo_Company",Company, 1);
		
		var vCheck=0;
		
		if (Product == "" || Product =="-- select an Product --")
		{
			alert ("Pls Select Product.");
			vCheck =1;
			return;
		}
		
		if (Company == "" || Company =="-- select an Company --")
		{
			alert ("Pls Select Company.");
			vCheck =1;
			return;
		}		
		
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
		
		if (vCheck==0) 
		{ 
			var str="Merchant Name;" + MerchantName + ";Product;" + Product + ";Amount;" + Amount + ";Company;" + Company;
			qrcode.clear();		
			qrcode.makeCode(str);
			alert ("All is done.");
		}


	}
$(document).ready(function(){		
});	
</script>
  </body>
</html>
