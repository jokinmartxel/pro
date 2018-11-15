<?php
$eposta = $_GET['eposta'];
$xml = simplexml_load_file('../xml/questions.xml');
$guztira = 0;
$nireak = 0;

foreach($xml->assessmentItem as $assessmentItem){
	$egilea = $assessmentItem['author'];
	$guztira++;
	if (strcmp($egilea, $eposta)==0){
		$nireak++;
	}
}
echo "Nire galderak/Galderak guztira XML datu-basean: ".$nireak."/".$guztira;
?>