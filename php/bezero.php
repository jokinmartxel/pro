<?php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

if(isset ($_GET['eposta'])){
	$soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl', true);
	$erantzuna = $soapclient->call('egiaztatuE',array( 'x'=>$_GET['eposta']));
	if(strcmp("BAI", strval($erantzuna))!=0){
		echo "false";
	}
	else{
		echo "true";
	}
}
if(isset($_GET['pasahitza'])){
	$result = "true";
	$soapclient2 = new nusoap_client('http://localhost/ws18/pro/php/egiaztatuPasahitza.php?wsdl', true);
	$erantzuna2 = $soapclient2->call('egiaztatuPass',array( 'x'=>$_GET['pasahitza'], 'y' => 1010));
	if(strcmp("BALIOGABEA", strval($erantzuna2))==0){
		$result = "false";
	}
	if(strcmp("ZERBITZURIK GABEA", strval($erantzuna2))==0){
		$result = "zerbitzua";
	}
	echo $result;
}

//$item1 = $_GET['test'];

//echo $item1;
?>