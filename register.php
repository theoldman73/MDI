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
	
  </head>
  <body>
 <!-- Start Main Menu -->
    <header class="bar bar-nav">
		<nav class="bar bar-tab">
		 <h1 class="title">Registration Form <img class="media-object pull-right" src="image/logo.png"  height="50" width="50"></h1>
		</nav>
    </header>
<!-- End of Main Menu -->
	<div class="content"">
		<form class="input-group">
			<div class="input-row">
				<label>Full name: </label>
				<input type="text" placeholder="Full name" value="" required>
			</div>		
			<div class="input-row">
				<label>National ID: </label>
				<input type="text" placeholder="National ID" value="" required>
			</div>	
			<div class="input-row">
				<label>Password: </label>
				<input type="password" placeholder="Password" value="" required>
			</div>	
			<div class="input-row">
				<label>Confirm: </label>
				<input type="password" placeholder="Confirm Password" value="" required>
			</div>							
			<div class="input-row">
				<label>Email: </label>
				<input type="email" placeholder="Email" value="" required>
			</div>	
			<div class="input-row">
				<label>Mobile: </label>
				<input type="number" placeholder="" value="" required>
			</div>
			<div class="input-row-left">
				 &nbsp; &nbsp;<label>Merchant</label>							
				<input type="radio" id="Merchant" name="Mon" value="Merchant" checked>
				 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label>Business </label>							
				<input type="radio" id="Business " name="Mon" value="Business ">				
			</div>				
			<div class="input-row">
				<button class="btn btn-positive btn-block"><a href="index.php">Submit</a></button>	
			</div>				
		</form>		<!-- End Form -->			
	</div> <!-- DIV:content -->	

 
				

		
  </body>
</html>
