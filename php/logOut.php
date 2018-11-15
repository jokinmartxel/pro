<?php 
if (isset ($_GET['op'])){
	//logeatua dago
	if ($_GET['op'] == 'logeatua'){
		
		
		
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
		
				
		header ('location: layout.php' );
	}
}
?>