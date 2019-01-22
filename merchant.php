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
    <script src="js/ratchet.min.js"></script>
    <script src="js/modals.js"></script>
    <script src="js/popovers.js"></script>
    <script src="js/segmented-controllers.js"></script>
    <script src="js/sliders.js"></script>
    <script src="js/toggles.js"></script>	
    <script src="js/push.js"></script> 	
    <script src="js/jquery-3.3.1.min.js"></script>
	<script src="bootstrap-min/fun932017.js"></script> 	

	<script>
		function LoadData() {
			$('#' + getCookie("coo_MerchantBusiness")).prop('checked',true);			
			$("#txtMerchantName").val(getCookie("coo_MerchantName"));
			$("#txtCommercial").val(getCookie("coo_CommercialRegisterID"));
			$("#txtMobile").val(getCookie("coo_Mobile"));
			$("#txtPIN").val(getCookie("coo_Pin")); 
			$("#txtMeezaCard").val(getCookie("coo_MeezaCard"));
			$("#txtBankAccount").val(getCookie("coo_BankAccount"));
			$('#' + getCookie("coo_MizacardOrange")).prop('checked',true);
			$("#txtNotes").val(getCookie("coo_Notes"));
			//$("#imgInp").val(getCookie("coo_File"));
			//alert (getCookie("coo_File"));
		}
	</script>	
  </head>
  <body onload="LoadData()">
    <!-- Azz : Load Main Menu -->
	<?php include 'main_header.php';?>
    <!-- Azz : End Load Main Menu -->	
<!-- End of Main Menu -->

	<div class="content">
		<div class="content-padded">
			 &nbsp; &nbsp;<label>Merchant</label>							
			<input type="radio" id="txtMerchant" name="Mon" value="Merchant" >
			 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label>Business</label>							
					<input type="radio" id="txtBusiness" name="Mon" value="Business ">				
			<input type="text" id="txtMerchantName" placeholder="Merchant Name" value="" required>
			<input type="text" id="txtCommercial" placeholder="Commercial Register or ID" value="" required>
			<input type="number" id="txtMobile" placeholder="Mobile" value="" required>
			<input type="password" id="txtPIN" placeholder="PIN" value="" required>
			<input type="number" id="txtMeezaCard" placeholder="Meeza Card" value="" required>
			<input type="text" id="txtBankAccount"  placeholder="Bank Account" value="" required>
			
			<div>
				<input type="radio" id="Mizacard" name="Mon1" value="Meezacard" checked>
				<label for="Mizacard">Meeza card&nbsp;&nbsp;&nbsp;&nbsp;<img class="media-object" src="image/Meezacard_512.png"  height="22" width="22"></label>
			</div>

			<div>
				<input type="radio" id="Orange" name="Mon1" value="Orange">
				<label for="Orange">Orange&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="media-object" src="image/Orange_512.png"  height="22" width="22"></</label>
			</div>
				
			<h5>Merchant Image</h5>	
			<span class="btn btn-default btn-file btn btn-primary">Browse… <input type="file" id="imgInp"></span>	
			<img id='img-upload'/>
			
			<div class="content-padded">
			  <h5>Photo instructions:</h5>
			  <p>1. Enable GPS on your mobile</p>
			  <p>2. Take a photo on 10m distance & merchant name should apper clearly</p>  
			</div>
			
			<textarea rows="2" id="txtNotes" placeholder="Enter your notes"></textarea>
			
			<button class="btn btn-block" Onclick="cmd_submit()">Save Merchant Info (+)</button>
			<!-- <div align="center"> -->
			<!--	<img  src="image/QR.png" style="width:200px; height:200px"> 	-->
			<!-- </div>	-->  
		</div>
	</div> <!-- End DIV content -->

<script>
	function cmd_submit()
	{
		var MerchantBusiness = $('input[name=Mon]:checked').attr('id');
		var MerchantName = $("#txtMerchantName").val();		
		var CommercialRegisterID = $("#txtCommercial").val();
		var Mobile = $("#txtMobile").val();
		var Pin = $("#txtPIN").val(); 
		var MeezaCard = $("#txtMeezaCard").val(); 
		var BankAccount  = $("#txtBankAccount").val(); 
		var MizacardOrange = $('input[name=Mon1]:checked').attr('id');;
		var Notes = $("#txtNotes").val();
		var File = $("#imgInp").val(); 
		
		setCookie("coo_MerchantBusiness",MerchantBusiness, 1);
		setCookie("coo_MerchantName",MerchantName, 1);
		setCookie("coo_CommercialRegisterID",CommercialRegisterID, 1);		
		setCookie("coo_Mobile",Mobile, 1);
		setCookie("coo_Pin",Pin, 1);
		setCookie("coo_MeezaCard",MeezaCard, 1);		
		setCookie("coo_BankAccount",BankAccount, 1);	
		setCookie("coo_MizacardOrange",MizacardOrange, 1);
		setCookie("coo_Notes",Notes, 1);
		setCookie("coo_File",File, 1);
		
		alert("Data Saved");
		
	}
</script>	
  </body>
</html>
