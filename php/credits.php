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
  </head>
  <body>
<center>
  <h1>Jokin Garmendia eta Martxel Eizaguirre</h1>
  <h2>Softare eta Konputazio espezialitateakoak</h2>
  <img src= "../images/pertsonak.jpg" alt="gu" width="300">
  <h3>Tolosa eta Hondarribia</h3>
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