<?php

// bueltatu logeatu dauden erabiltzaileak
$xml = simplexml_load_file('../xml/counter.xml');

if ($xml === false) {
	echo "Errorea XML fitxategia kargatzerakoan\n";
	foreach(libxml_get_errors() as $error) {
		echo "\t", $error->message;
	}
}else{
	echo "Logeatuta dauden erabiltzaile kopurua: " . $xml->kont[0];
}

?>	