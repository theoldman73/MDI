<?php
//--- Azz:  Get Local Server Ip ---//
// https://stackoverflow.com/questions/3219178/php-how-to-get-local-ip-of-system
$exec = exec("hostname"); //the "hostname" is a valid command in both windows and linux
$hostname = trim($exec); //remove any spaces before and after
$ip = gethostbyname($hostname); //resolves the hostname using local hosts resolver or DNS
?>
<!DOCTYPE html>
<!-- saved from url=(0053)https://getbootstrap.com/docs/4.1/examples/jumbotron/ -->
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>MDI</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-min/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap-min/jumbotron.css" rel="stylesheet">

    <link rel="stylesheet" href="bootstrap-min/ol.css" type="text/css">	
	<!-- You have to add CSS Openlayer here. -->
    <link rel="stylesheet" href="bootstrap-min/popup.css">
    <link rel="stylesheet" href="bootstrap-min/LayersControl.css">
	
	<!-- Map  -->	
	<style>	
		.button {
		  background-color: #4CAF50;
		  border: none;
		  color: white;
		  padding: 15px 32px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 16px;
		  margin: 4px 2px;
		  cursor: pointer;
		}	

		/*---Azz:  To show coordinate msg. ---*/
		#main {
		  height: 100%;
		}
		#coordinates {
		  position: absolute;
		  bottom: .5em;
		  left: .5em;
		}
		/*---Azz:  To show OL3 Layer Control. ---*/	
      .layers-control {
        position: fixed;
        bottom: 10px;
        top: auto;
      }
      html, body, #map {
        height: 100%;
        width: 100%;
        overflow: hidden;
      }
      body {
        padding-top: 0px;
      }
      .navbar .navbar-brand {
        font-weight: bold;
        font-size: 25px;
        color: white;
      }
      #popup-content {
        max-height: 200px;
        overflow-y: auto;
      }
	  #parentMenu {
		display: block;
		float: right;
		text-align:right;
		top: 0;
		}
	/* Helps position submenu */
	.dropdown-submenu {
		position: relative;
		float:right;
	}
	/* Menus under the submenu should show up on the right of the parent */
	.dropdown-submenu>.dropdown-menu {
		top: 0;
		left: -100%;
		margin-top: -6px;
		margin-right: -1px;
		-webkit-border-radius: 0 6px 6px 6px;
		
		border-radius: 0 6px 6px 6px;
		float:right;
	}
	/* Make submenu visible when hovering on link */
	.dropdown-submenu:hover>.dropdown-menu {
		display: block;
	}
	/*--- Azz: add sub menu.... ---*/
	/* Add carot to submenu links */
	.dropdown-submenu>a:after {
		display: block;
		float: right;
		/*simple */
		content: "?";
		color: #cccccc;
		/* looks a little better */
		content: " ";
		width: 0;
		height: 0;
		border-color: transparent;
		border-style: solid;
		border-width: 5px 0 5px 5px;
		border-left-color: #cccccc;
		margin-top: 5px;
		margin-left:-5px;
	}
	/* Change carot color on hover */
	.dropdown-submenu:hover>a:after {
		border-left-color: #ffffff;
		}

	.modal-body {
		height: 400px;
		overflow-y: scroll;
		}

	.btn-xl {
    padding: 10px 20px;
    font-size: 20px;
    border-radius: 10px;
}		
 </style>	
 
  </head>

  <body>

 <!-- End Menu -->
 
 <!-- Start Main -->
<!--  Top Page  -->

<div class="container">
	<div class="row">
	    <form class="col-md-3">
	        <label>Governorate</label>
	        <select class="form-control select2">
	           <option>Select</option> 
	           <option>New Valley</option> 
	           <option>Giza</option> 
	           <option>Matruh</option> 
	           <option>Red Sea</option> 
	           <option>Sharqia</option> 
	           <option>Alexandria</option> 
	           <option>Monufia</option> 
	           <option>Cairo</option> 
	           <option>6th of October</option> 			   
	        </select>
	    </form>
	
	    <form class="col-md-3">
	        <label>City</label>
	        <select class="form-control select2">
	           <option>Select</option> 
	           <option>Dokki</option> 
	           <option>Agouza</option> 
	           <option>Haram</option> 
	           <option>Omrania</option> 
	           <option>Monib</option> 
	        </select>
	    </form>	
		
	    <form class="col-md-3">
	        <label>Activity</label>
	        <select class="form-control select2">
	           <option>Select</option> 
	           <option>Food</option> 
	           <option>Candies</option> 
	           <option>Soft Drink</option> 
	           <option>MNO Agent (Vodafone, Orange…)</option> 
	           <option>Agent Banking (Fawry, Bee…)</option> 
			   <option>Others</option> 
	        </select>
	    </form>	
		<button  type="button" class="btn btn-primary" onclick="myFunction()">Find</button>		&nbsp; &nbsp; 
		<button  type="button" class="btn btn-primary" onclick="myFunctionHome()">Home</button>
 	</div>
</div>
	<br>
	<!-- MAP GIS Here -->
	<div id="map" class="map" styles="background-color=#00000;"></div>	<!-- Move Text With Lat,Lon -->
	<div id='coordinates'></div>
		
	<!--- Show Hide Info Location -->
	<div id="xyLocation" hidden="hidden" style="direction: rtl;opacity: 0.8;position: fixed; bottom: 120px; left: 10px;width: 250px;  height: 120px; z-index: 100;background:black; color: #FFFF00;">
	<!--  <div id="xyLocation" hidden="hidden" style="position: fixed; bottom: 20px; left: 10px;width:250px;  height: auto; z-index: 100;background:rgba(0,0,0,0.2); color: #FFFF00;">
          <label id="txt_info" style="width: 250px; height: 400px; color: #000000; background-color: #FFFFFF; font-size: medium; overflow: scroll;" dir="rtl"></label>   -->
	 <label id="txt_info" style="text-align: left;width: 250px; height: 200px; color:#FFFFFF; background-color:#000000; font-size: medium; overflow: auto;" dir="rtl"></label> 
	 </div>	
	 
	<!--- Show Hide Forms -->
	<div id="showForm" hidden="hidden" dir="rtl" style="opacity: 0.9;position: fixed; bottom: 5%; left: 10px;width: 30%;  height: 80%; z-index: 100;background:black; color: #FFFF00;">
		<div id="modBady" style="height: 100%">
			<iframe  id="fra1" width="100%" height="100%"  frameborder="0" scrolling="auto" allowtransparency="true" ></iframe>
		</div>	 
	</div>		 
	 
	<!-- Show Layer  CSS+DIV [ol-viewport] -->
	<div class="ol-viewport" style="position: relative; overflow: hidden; width: 100%; height: 100%;">
		<canvas class="ol-unselectable" width="1366" height="563" style="width: 100%; height: 100%;"></canvas>
		<div class="ol-overlaycontainer"></div>
		<div class="ol-overlaycontainer-stopevent">
			<div style="position: absolute; display: none;"></div>
			</div>
		</div>
		</div>
	</div>	
	
    <main role="main" class="container">
      <div class="starter-template"></div>
    </main><!-- /.container -->	
	
<!-- End Top Page -->	
   <main role="main">


       <!-- <hr> -->

      </div> <!-- /container -->

    </main>
 
 <!-- End Main -->
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster <hr>-->
    <script src="bootstrap-min/jquery-3.3.1.slim.min.js" integrity="" crossorigin="anonymous"></script> 
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="bootstrap-min/popper.min.js"></script>
    <script src="bootstrap-min/bootstrap.min.js"></script>
    <script src="bootstrap-min/jquery-3.3.1.min.js"></script>
    <script src="bootstrap-min//popper.min.js"></script>
    <script src="bootstrap-min/bootstrap.min.js"></script>
    <script src="bootstrap-min/ol.js"></script>	
	<script src="bootstrap-min/bootbox.min.js"></script>	
	<script src="bootstrap-min/LayersControl.js"></script>
	<script src="bootstrap-min/ol.js"></script>	
	<script src="bootstrap-min/reqwest.js"></script>
	<script src="bootstrap-min/bootbox.min.js"></script>
	<script src="bootstrap-min/fun932017.js"></script>
	
	<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
		//CenterMap(31.195823085316206 , 30.042330080205687,18);//--- Points
		
		
	});	
	
	
	function myFunction() {
		CenterMap(31.2018800000 , 30.0457010000 , 15);
	}
	
	function myFunctionHome() {
		CenterMap(31.1967669994,30.0430240608 , 8);
	}
	</script>

  <script>
	var URL = <?php echo "'$ip'"; ?>;
	//console.log ('Azz: Server IP = ' + URL);
//----------------------------------------	  
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();  
		 document.getElementById('LayerControl').hidden = true;
	});	

//----------------------------------------
//--- Azz: Add icon to vecter layer to move X,y around the map
	var iconGeometry = new ol.geom.Point(ol.proj.transform([29.6850318564 , 28.8777330591], 'EPSG:4326', 'EPSG:3857'));
	var iconFeature = new ol.Feature({
	  geometry: iconGeometry,
	  id: 'iconPng'
	});

	var style = new ol.style.Style({
		image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
		scale: 0.06,
		anchor: [0.50, 512], // [0.5, 15]
		anchorXUnits: 'fraction',
		anchorYUnits: 'pixels',
		//opacity: 0.50,
		src: './../../php/image/m_icon.png'
	  }))
	});

	iconFeature.setStyle(style);

	var vectorSource = new ol.source.Vector({
	  features: [iconFeature]
	});

	var vectorLayer = new ol.layer.Vector({
		visible: false,
		title: 'Mouse',
		source: vectorSource
	});	
//----------------------------------------
// create the OpenLayers Map object
// we add a layer switcher to the map with two groups:
// 1. background, which will use radio buttons
// 2. default (overlays), which will use checkboxes
	var map = new ol.Map({
	  controls: ol.control.defaults().extend([
		new app.LayersControl({
		  groups: {
			background: {
			  title: "Base Map",
			  exclusive: true
			},
			'default': {
			  title: "Layer"
			}
		  }
		})
	  ]),
	  // render the map in the 'map' div
	  target: document.getElementById('map'),
	  // use the Canvas renderer
	  renderer: 'canvas',
	  layers: [
		 new ol.layer.Tile({
		 visible: true,
		 group: "background",
		 title: "OSM",
			  source: new ol.source.OSM()
			}) 
			,
		new ol.layer.Tile({visible: false,title: 'Egypt',group: 'background',source: new ol.source.TileWMS({url: 'http://' + URL + ':8080/geoserver/merchant/wms',params: {LAYERS: 'merchant:gis_egypt', VERSION: '1.1.1', VIEWPARAMS: '', 'TILED': true},serverType: 'geoserver',crossOrigin: 'anonymous'})}),new ol.layer.Tile({visible: false,title: 'Egypt_Section',group: 'background',source: new ol.source.TileWMS({url: 'http://' + URL + ':8080/geoserver/merchant/wms',params: {LAYERS: 'merchant:gis_egypt_sec', VERSION: '1.1.1', VIEWPARAMS: '', 'TILED': true},serverType: 'geoserver',crossOrigin: 'anonymous'})}),new ol.layer.Tile({visible: false,title: 'sec_cario_poly',source: new ol.source.TileWMS({url: 'http://' + URL + ':8080/geoserver/merchant/wms',params: {LAYERS: 'merchant:sec_cario_poly', VERSION: '1.1.1', VIEWPARAMS: '', 'TILED': true},serverType: 'geoserver',crossOrigin: 'anonymous',}) 		}), new ol.layer.Tile({visible: false,title: 'gov_cario_line',source: new ol.source.TileWMS({url: 'http://' + URL + ':8080/geoserver/merchant/wms',params: {LAYERS: 'merchant:gov_cario_linem', VERSION: '1.1.1', VIEWPARAMS: '', 'TILED': true},serverType: 'geoserver',crossOrigin: 'anonymous',}) 		}), new ol.layer.Tile({visible: true,title: 'Booth Info',source: new ol.source.TileWMS({url: 'http://' + URL + ':8080/geoserver/merchant/wms',params: {LAYERS: 'merchant:booth_info', VERSION: '1.1.1', VIEWPARAMS: '', 'TILED': true},serverType: 'geoserver',crossOrigin: 'anonymous',}) 		}), 		
	  ],
	  // initial center and zoom of the map's view [view:]
	  view :  new ol.View({
		center: ol.proj.transform([31.1967669994,30.0430240608], 'EPSG:4326', 'EPSG:3857'),
		zoom: 8
	  })
	});
	
	//---  30.6333270323 , 27.1215329042
	//---  31.1967669994,30.0430240608
		  //$('#fir_id').val()
//---
map.getTarget().style.cursor = 'pointer'; //--- Azz: Map Setting [Change Map mouse icon]: 'pointer' crosshair move ---//

//---
	map.addControl(new ol.control.ScaleLine());
	
	map.addControl(new ol.control.OverviewMap());	

    function ShowHideSearch() {
    if (document.getElementById('LayerControl').hidden===false) {
         document.getElementById('LayerControl').hidden = true;
    }
    else{
        document.getElementById('LayerControl').hidden = false;
    }
    }	
	
	function ShowHideLocation() {
    if (document.getElementById('xyLocation').hidden===false)
	{
		//alert( Distance_Km(31,30,30,31));
        document.getElementById('xyLocation').hidden = true;
    }
    else{
        document.getElementById('xyLocation').hidden = false;
    }
	}		
	
	var view = new ol.View({
        center: [0, 0],
        zoom: 1
      });
	
	map.on('click', function (evt) {
		//var geometry = feature.getGeometry();
		//var coordinate = geometry.getCoordinates();
		//var pixel = map.getPixelFromCoordinate(coordinate);		
		//console.debug( "Azz: pixel=[" + pixel + "]");
		//moves(pixel);
		/*
		var coord = map.getCoordinateFromPixel(evt.pixel);
		alert(coord);
		*/
		//--- Azz: I have to do this to check location with WGS84. ---//
		var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
		var lon = lonlat[0];
		var lat = lonlat[1];
		localStorage.setItem("LonWGS84", lonlat[0]);
		localStorage.setItem("LatWGS84", lonlat[1]);		
		//alert(lon + " <---> " + lat);
		// Azz: Not used. $("#mouse_click").text("Lon= " + lon + "  Lat= " + lat);
		var lonlat = evt.coordinate;
		// Azz: Not used. $("#mouse_click").text("[X=" +  Math.floor(lonlat[0]) + ",Y=" +  Math.floor(lonlat[1]) + "]");
		//--- Azz: Start Send X,y to local. ---//	
		localStorage.setItem("sLon", lonlat[0]);
		localStorage.setItem("sLat", lonlat[1]);		
        //var source = this.map.getSource();
		//alert(ol.Feature.prototype.getLayer);
		iconGeometry.setCoordinates(lonlat); //--- Azz: To move point gemotery X,y ---//
		//popup.show(lonlat, "azZ");
		var feature = evt.selected;
		if(feature){
		var layer = feature.getLayer(map);

		console.info(layer.getStyle());
		console.info(layer.get('name'));
		}
	
		map.getLayers().forEach(function(lyr) {
			 // console.log(lyr);
			});	
		//vectorLayer.setCoordinates(evt.coordinate);		
	});	  	
	//extent: ol.proj.transformExtent([24.28403430398554,21.463966042874,37.63656930398554,31.949021042874], 'EPSG:4326', 'EPSG:3857'),
	
	var wmsSource = new ol.source.TileWMS({	
    url: 'http://' + URL + ':8080/geoserver/merchant/wms',
    serverType: 'geoserver',
    params: {LAYERS: 'merchant:sql_booth_info', VERSION: '1.1.1', VIEWPARAMS: ''} 
    });

	map.on('singleclick', function(evt) {
		// 78271.51696402048 viewResolution=78271.51696402048 DIF=271.516964020484
		var viewProjection = view.getProjection();
		var viewResolution = view.getResolution();		
		console.debug("viewProjection=" + viewProjection); // 4326 3857
		console.debug("viewResolution=" + viewResolution + " DIF=" + (viewResolution - 78000));		
		var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
		//alert(lonlat[0] + " <> " + lonlat[1]);
        document.getElementById('txt_info').innerHTML = '';
	    var coordinates = evt.coordinate;
	    console.debug( "Azz: [" + coordinates + "]");
		console.debug( "Azz: [" + view.getResolution() + "]");
        //var viewResolution = /** @type {number} */ (view.getResolution());
       // var url = wmsSource.getGetFeatureInfoUrl(evt.coordinate, viewResolution, 'EPSG:3857',{'INFO_FORMAT': 'application/json'}); 
		var url = wmsSource.getGetFeatureInfoUrl(evt.coordinate, 5 , viewProjection,{'INFO_FORMAT': 'application/json'}); 	
		//console.debug("*** viewResolution=" + (viewResolution) + ' <> ' + ' Location= ' + evt.coordinate + ' <> ' + lonlat);		
			// application/json -- text/html
        if (url) {
		//	console.debug (url);
		//	alert (url);
		//	console.debug (url);
       //   document.getElementById('txt_info').innerHTML =
       //       '<iframe seamless src="' + url + '"></iframe>';
        reqwest({
        url: url,
        type: 'json',
        }).then(function (data) {
		//alert(data);
		var feature = data.features[0];
		//alert(feature);
		if (isEmpty(feature) == true ){
			//--- Azz: Send  Lat/Lon ---//
		setCookie("jLat", lonlat[1], 1);
		setCookie("jLon", lonlat[0], 1);
		//alert(lonlat[0] + " <> " + lonlat[1]); 
		var props = feature.properties;
		var space =  "&nbsp;&nbsp;";	  
		var info =  "";
		  
			//info  = info + "ID" + space + ":"  + space + props.boo_id + "<br>";
			info  = info + "ID" + space + ":"  + space + lonlat[0] + " - " + lonlat[1] + "<br>";
			info  = info + "Name" + space + ":"  + space + props.boo_name + "<br>";
			info  = info + "Address" + space + ":"  + space + props.boo_address + "<br>";
			var img =  '<img src="./upload/' + props.boo_image + '" class="img-thumbnail" alt="None" width="304" height="336">';
			var imgf = '<img src="./upload/' + props.boo_idf_img + '" class="img-thumbnail" alt="None" width="204" height="236">';
			//var imgb = '<img src="./upload/' + props.boo_idb_img + '" class="img-thumbnail" alt="None" width="204" height="236">';
			//info  = info +  img + imgf + imgb + "<br>";
			info  = info +  img + "<br>";
			//info  = info +  img + "<br>";
			info  = info +  imgf + "<br>";			
			//info  = info +  imgb + "<br>";
			//info = info + '<iframe src="./mgo.php" height="100%" width="100%"></iframe>' + "<br>";
			bootbox.alert("<div class='text-left'>" + info + "</div>");
		   // document.getElementById('txt_info').innerHTML = info;			   
			// console.log ('Azz: ');
			//console.log ( url );
			// alert (info);
			}
        });
		
       }  
		//--->>>
		
	});	
				
	function isEmpty(obj) {
		for(var prop in obj) {
			if(obj.hasOwnProperty(prop))
				return true;
		}
		return false;
	}
				
 function CenterMap(long, lat , zoom) {
    console.log("Long: " + long + " Lat: " + lat);
    map.getView().setCenter(ol.proj.transform([long, lat], 'EPSG:4326', 'EPSG:3857'));
    map.getView().setZoom(zoom);
}
//----------------------------------------
//--- Azz: Not used ---//
//map.addControl(vectorLayer);

	</script>	
</body>
</html>