<?php 


// eguneratu logeatu dauden erabiltzaileak
$xml = simplexml_load_file('../xml/counter.xml');

if ($xml === false) {
	echo "Errorea XML fitxategia kargatzerakoan\n";
	foreach(libxml_get_errors() as $error) {
		echo "\t", $error->message;
	}
}else{
	$xml->kont[0] = $xml->kont[0] - 1;
	$xml->asXML('../xml/counter.xml');
}

session_start();
session_destroy();		
header ('location: layout.php' );

?>