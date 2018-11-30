<?php

include "dbConfig.php";
global $niremysqli;

// $sql = "SELECT * FROM erabiltzaileak";
if (isset ($_GET['eposta'])){ 
	
	$eposta = $_GET['eposta'];
	$egoera= $_GET['egoera'];

	if (strcmp($egoera, "ezabatu")==0){
		// ezabatu
		$sql = "DELETE FROM erabiltzaileak where Eposta=$eposta";
		$res = mysqli_query($niremysqli, $sql); 
	}else{
		// eguneratu
		$sql = "UPDATE erabiltzaileak SET Egoera = $egoera where Eposta=$eposta";
		$res = mysqli_query($niremysqli, $sql); 
	}
}
?>