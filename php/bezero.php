<?php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

if(isset($_GET['eposta'])){
	$soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl', true);
	$erantzuna = $soapclient->call('egiaztatuE',array( 'x'=>$_GET['eposta']));
	if(strcmp("BAI", strval($erantzuna))!=0){
		echo "true";
	}
	else{
		echo "false";
	}
}
if(isset($_GET['pasahitza']){
	$result = "true";
	$soapclient2 = new nusoap_client('http://localhost/ws18/pro/php/egiaztatuPasahitza.php?wsdl', true);
	$erantzuna2 = $soapclient2->call('egiaztatuPass',array( 'x'=>$_POST['password1'], 'y' => 1010));
		if(strcmp("BALIOGABEA", strval($erantzuna))!=0){
			$result = "false";
		}
	echo $result;
}
?>