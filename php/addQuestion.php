<?php

include "dbConfig.php";
$niremysqli = new mysqli($zerbitzaria,$erabiltzailea,$gakoa,$db);

$sql = "INSERT INTO questions (Id, Email, Galdera, Zuzena, Okerra1, Okerra2, Okerra3, Zailtasuna, Gaia, Irudia) VALUES(DEFAULT, '$_POST[eposta]' , '$_POST[galdera]' , '$_POST[zuzena]' , '$_POST[okerra1]' , '$_POST[okerra2]' , '$_POST[okerra3]' , '$_POST[zailtasuna]' , '$_POST[gaia]' , null)";
$ema= mysqli_query($niremysqli, $sql);

if(!$ema){
	echo("Errorea query-a gauzatzerakoan: ". mysqli_error($niremysqli));
	echo ('<a href="../addQuestion5.html">formulariora itzultzeko klikatu hemen</a>');
}
else{
	echo('DATUAK ONDO GORDE DIRA</br></br>');
	echo ('<a href="showQuestions.php">datubaseko datuak ikusteko klikatu hemen</a></br></br>');	
}
?>