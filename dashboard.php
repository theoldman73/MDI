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
	
	<script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>	
    <script src="js/ratchet.min.js"></script>
    <script src="js/modals.js"></script>
    <script src="js/popovers.js"></script>
    <script src="js/segmented-controllers.js"></script>
    <script src="js/sliders.js"></script>
    <script src="js/toggles.js"></script>	
    <script src="js/push.js"></script> 	
	<!-- Azz -->
	<script src="js/gauge.min.js"></script>
	
  </head>
  <body>
    <header class="bar bar-nav">
		<nav class="bar bar-tab">
		  <a class="tab-item" href="main.php">
			<span class="icon icon-home"></span>
			<span class="tab-label">Home</span>
		  </a>
		  <a class="tab-item" href="transaction.php">
			<span class="icon icon-person"></span>
			<span class="tab-label">Transaction</span>
		  </a>
		  <a class="tab-item" href="merchant.php">
			<span class="icon icon-compose"></span>
			<span class="tab-label">Merchant</span>
		  </a>
		  <a class="tab-item" href="map.php">
			<span class="icon icon-star-filled"></span>
			<span class="tab-label">Map</span>
		  </a>
		  <a class="tab-item" href="dashboard.php">
			<span class="icon icon-list"></span>
			<span class="tab-label">Dashboard</span>
		  </a>
		  <a class="tab-item" href="#">
			<span class="icon icon-gear"></span>
			<span class="tab-label">عربي</span>
		  </a>		  
		</nav>
    </header>



	<div class="content">
        <div class="row">
          <div class="col-md">
		  <h3>Your Score</h3>
            <div align="center">
				<canvas id="canvas-id"></canvas>
			</div>
          </div>

			<div align="center">
				<h3>Top Score Card</h3>
				<table class="table-view">
				  <thead class="table-view-cell">
					<tr>
					  <th scope="col">Rank</th>
					  <th scope="col">Name</th>
					  <th scope="col">Transaction</th>								  
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <th scope="row" >1</th>
					  <td>Moataz Manaa</td>
					  <td>150</td>								  
					</tr>
					<tr>
					  <th scope="row" >2</th>
					  <td>Emad EL Azhary</td>
					  <td>145</td>
					</tr>
					<tr>
					  <th scope="row" >3</th>
					  <td>Alaa Zaher</td>
					  <td>135</td>
					</tr>
				  </tbody>
				</table>				
			</div>
    
		</div>
	</div>

  <script type="text/javascript">  
    $(document).ready(function () {  
		//	start User Gauge
		var gauge = new RadialGauge({
			renderTo: 'canvas-id',
			width: 280,
			height: 280,
			units: "Photos",
			minValue: 1,
			maxValue: 500,
			majorTicks: [ "1","50","100","150","200","250","300","350","400","450","500"],
			minorTicks: 2,
			strokeTicks: true,
			highlights: [
				{
					"from": 1,
					"to": 500,
					"color": "rgba(200, 50, 50, .75)"
				}
			],
			valueInt: 1,
			valueDec: 0,
			colorPlate: "#fff",
			borderShadowWidth: 0,
			borders: true,
			needleType: "arrow",
			needleWidth: 3,
			needleCircleSize: 16,
			needleCircleOuter: true,
			needleCircleInner: false,
			animationDuration: 1500,
			animationRule: "linear"
		}).draw();
		gauge.value = "120";	
		//end User Gauge
		//window.location.reload(false); 
		setTimeout(function () {location.reload()}, 5000);
	});		
		
	</script>		
  </body>
</html>
