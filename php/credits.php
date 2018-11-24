<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Credits</title>
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../styles/smartphone.css' />
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
	
	
	
	<script>
		var lat ="";
		var lon = "";
		
		// geolokalizatzeko ip_api web aplikazioa erabili da http://ip-api.com/
		function geolokalizatu() {
			$.getJSON("http://ip-api.com/json/?callback=?", function(data) {

				var hiria = data.city;
				var lurraldea = data.country;
				var lat = data.lat;
				var lon = data.lon;
				var region = data.regionName;
				var zipcode = data.zip;
				var datuak = "Leku honetatik erabiltzen ari zara web aplikazioa: </br>" + hiria +", " + region + ", " + lurraldea + " Lat: "+ lat+ " Lon: " + lon ;
				
				$("#geoL").html(datuak);
				
				
				maparatu(lat, lon);

			});
			
		}
		
		// kokapena mapa batean bistaratzeko https://leafletjs.com/ erabili da Google Api ordainekoa delako
		function maparatu(lat, lon){
			var map = L.map('map').
			setView([lat, lon], 
			14);
			 
			L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					maxZoom: 18
			}).addTo(map);

			L.control.scale().addTo(map);
			L.marker([lat, lon], {draggable: true}).addTo(map);
		}
	
	</script>
	

	
	
	
	
	
  <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css">

 <style>
  #map { 
  widh: 300px;
  height: 300px; }
 </style>
 
 </head>
  <body onload="geolokalizatu()">
<center>
  <h1>Jokin Garmendia eta Martxel Eizaguirre</h1>
  <h2>Softare eta Konputazio espezialitateakoak</h2>
  <img src= "../images/pertsonak.jpg" alt="gu" width="300">
  <h3>Tolosa eta Hondarribia</h3>
  
  <div id="geoL"></div>
  <div id="map" style="width:400px ;height:360px"></div>
  </center>
  <a href="layout.php" id="home">HOME</a>
  
  

</body>
</html>



<?php 
if (isset ($_GET['op'])){
	//logeatua dago
	if ($_GET['op'] == 'logeatua'){
		
		$eposta = strval($_GET['eposta']);
				
		$home = "layout.php?op=logeatua&eposta=" . $eposta;
		$home = strval($home);
		echo "<script> $('#home').attr('href', '". $home . "')</script>";
				
	}else{
		header ('location: layout.php?op=ezlogeatua' );
	}
}
?>