<?php

$local=0; //1 hodeiko kasua
if($local){
	$zerbitzaria="localhost";
	$erabiltzailea="id7414762_jokinmartxel";
	$gakoa="informatika18";
	$db="id7414762_quiz";
	$niremysqli = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
}
else{
	$zerbitzaria="localhost";
	$erabiltzailea="root";
	$gakoa="";//Hutsa
	$db="quiz";
	$niremysqli = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
}
if (mysqli_connect_errno()) {
		echo ("Konexio hutxegitea MySQLra: " . mysqli_connect_error());
		exit();
}

?>