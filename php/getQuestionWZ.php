<?php
	//nusoap.php klasea gehitzen dugu
	require_once('../lib/nusoap.php');
	require_once('../lib/class.wsdlcache.php');
	
	
	//datu baserako
	include "dbConfig.php";
	global $niremysqli;
	
	//soap_server motako objektua sortzen dugu
	$ns="http://localhost/pro/php/getQuestionWZ.php?wsdl";
	$server = new soap_server;
	$server->configureWSDL('galdDatuakBueltatu',$ns);
	$server->wsdl->schemaTargetNamespace=$ns;
	
	
	
	//inplementatu nahi dugun funtzioa erregistratzen dugu
	//funtzio bat baino gehiago erregistra liteke …
	$server->register('galdDatuakBueltatu',           // nombre método
		array('id' => 'xsd:int'),            //  parametros entrantes al servicio
		array('return' => 'xsd:Array'),          // valor(es) retornado(s)
		'urn:WSCourse',                                            // namespace (espacio de nombre)
		'urn:WSCourse#galdDatuakBueltatu',         // acción SOAP
		'rpc',                                                                 // estílo
		'encoded',                                                       // tipo de uso
		'This service returns a list of courses'    // documentación
	);
	
	//funtzioa inplementatzen da
	function galdDatuakBueltatu($x){


		$ema = datuBasetikAtera($x);
		return $ema;
		
	
		
		
	}
	
	function datuBasetikAtera($x){
		include 'dbConfig.php';
		$niremysqli = new mysqli($zerbitzaria,$erabiltzailea,$gakoa,$db);
		// $usr_pass = $_GET['id'];
		$sql = "select * from questions where Id='$x'";
		
		$result = $niremysqli->query($sql);
				
		if(! ($result)) {
			// echo 'Error in the query'. $result->error;
			$ema = array('','','');	
			return $ema;
		}
		else{
			
			
			
			$rows_cnt = $result->num_rows;
			
			if ($rows_cnt == 1) {
				$rows_cnt = 0;
				
				// arraya sortu datuekin
				while ($row = mysqli_fetch_assoc($result)){ 
					$ema = array($row['Email'],$row['Galdera'],$row['Zuzena']);	
				}
				return $ema;
				
				
			}
			else{
				$ema = array('','','');	
				return $ema;
			}			
		}
			
		$niremysqli->close();
	}
	
	
	//nusoap klaseko service metodoari dei egiten diogu, behin parametroak
	// prestatuta daudela
	if (!isset( $HTTP_RAW_POST_DATA )) {
	$HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
	}
	$server->service($HTTP_RAW_POST_DATA);

?>