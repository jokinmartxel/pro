<?php
	//nusoap.php klasea gehitzen dugu
	require_once('../lib/nusoap.php');
	require_once('../lib/class.wsdlcache.php');
	
	//soap_server motako objektua sortzen dugu
	$ns="egiaztatuPasahitza.php";
	$server = new soap_server;
	$server->configureWSDL('egiaztatuPass',$ns);
	$server->wsdl->schemaTargetNamespace=$ns;
	
	//inplementatu nahi dugun funtzioa erregistratzen dugu
	//funtzio bat baino gehiago erregistra liteke …
	$server->register('egiaztatuPass',
	array('x'=>'x: xsd:string'),
	array('z'=>'z: xsd:string'),
	$ns);
	
	//funtzioa inplementatzen da
	function egiaztatuPass($x){
		$ema = "BALIOZKOA";
		$file = fopen("../toppasswords.txt","r");
		if ($file) {
			while (($line = fgets($file)) !== false) {
				if(strcmp(strval(str_replace(array("\r", "\n"), '',$line)), strval($x))==0){
					$ema = "BALIOGABEA";
				}
			}
			fclose($file);
			return $ema;
		} else {
			// error opening the file.
		} 
	}
	
	//nusoap klaseko service metodoari dei egiten diogu, behin parametroak
	// prestatuta daudela
	if (!isset( $HTTP_RAW_POST_DATA )) {
	$HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
	}
	$server->service($HTTP_RAW_POST_DATA);

?>