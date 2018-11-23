<html>
	<head>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
	</head>
	<body>
		<form method="post" action="">
		<label>
			Galderaren id-a:
		</label>
		<input type="text" name="idGaldera">
		<input type="submit" value="Galdera erakutsi">
		</form>
		<div id = "testua">
		Galdera:  
		<br> 
		Erantzun zuzena:  
		<br> 
		Egilea: 
		</div>
	</body>
</html>


<?php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

if (isset ($_GET['op'])){ 


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$soapclient = new nusoap_client('http://localhost/pro/php/getQuestionWZ.php?wsdl', true);
		$erantzuna = $soapclient->call('galdDatuakBueltatu',array('id'=>$_POST['idGaldera']));
		
		$egilea = $erantzuna[0];
		$galdera = $erantzuna[1];
		$zuzena = $erantzuna[2];
		
		echo "<script>$('#testua').empty()</script>";
		$testua = "'Galdera: ".$galdera."<br> Erantzun zuzena: ".$zuzena."<br> Egilea: ".$egilea."'";
		echo "<script>$('#testua').append(".$testua.")</script>";
		
	}

}else{
		header ('location: layout.php?op=ezlogeatua' );
}

?>