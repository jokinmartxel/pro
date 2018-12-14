<?php

include "dbConfig.php";
global $niremysqli;

// $sql = "SELECT * FROM erabiltzaileak";
if (isset ($_GET['id'])){ 
	
	$id = $_GET['id'];
	$gustatu= $_GET['gustatu'];
	
	$sql = "SELECT * FROM questions where Id = $id";
	$result = mysqli_query($niremysqli, $sql); 
	$balo = mysqli_fetch_assoc($result);
	$balorazioa = $balo['Balorazioa'];
	
	if (strcmp($gustatu, "bai")==0){
		// gustatu
		$balorazioa = $balorazioa + 1;
		$sql = "UPDATE questions SET Balorazioa = $balorazioa where Id=$id";
		$res = mysqli_query($niremysqli, $sql); 
	}else{
		// ez gustatu
		$balorazioa = $balorazioa - 1;
		$sql = "UPDATE questions SET Balorazioa = $balorazioa where Id=$id";
		$res = mysqli_query($niremysqli, $sql); 
	}
}
?>