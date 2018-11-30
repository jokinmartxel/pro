<?php 
session_start();

if (isset ($_SESSION['eposta'])){
	$eposta = $_SESSION['eposta'];
	$xml = simplexml_load_file('../xml/questions.xml');

	echo "<table border = '1'> \n"; 
	echo "<tr><td><b>Egilea</b></td><td><b>Enuntziatua</b></td><td><b>Erantzun zuzena</b></td></tr> \n"; 
	foreach($xml->assessmentItem as $assessmentItem){
		$egilea = $assessmentItem['author'];
		$enuntziatua = $assessmentItem->itemBody->p;
		$zuzena = $assessmentItem->correctResponse->value;
		if (strcmp($egilea, $eposta)==0){
			echo "<tr><td>" . $egilea. "</td><td>" . $enuntziatua. "</td><td>" . $zuzena. "</td></tr> \n";
		}
	}
}




?>