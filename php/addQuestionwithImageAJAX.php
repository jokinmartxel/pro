<?php


include "dbConfig.php";
$niremysqli = new mysqli($zerbitzaria,$erabiltzailea,$gakoa,$db);


function balidatuBeharrez($balorea){
   if(trim($balorea) == ''){
      return false;
   }else{
      return true;
   }
}


//BALIDATZEN BALIOAK ZERBITZARIAN
$eposta = isset($_GET['eposta']) ? $_GET['eposta'] : null;
$galdera = isset($_GET['galdera']) ? $_GET['galdera'] : null;
$zuzena = isset($_GET['zuzena']) ? $_GET['zuzena'] : null;
$okerra1 = isset($_GET['okerra1']) ? $_GET['okerra1'] : null;
$okerra2 = isset($_GET['okerra2']) ? $_GET['okerra2'] : null;
$okerra3 = isset($_GET['okerra3']) ? $_GET['okerra3'] : null;
$zailtasuna = isset($_GET['zailtasuna']) ? $_GET['zailtasuna'] : null;
$gaia = isset($_GET['gaia']) ? $_GET['gaia'] : null;


$extentsioak = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
$max_tamaina = 1024 * 1024 * 8;

$erroreak = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	//eposta balidatu
	if (!balidatuBeharrez($eposta)){
		$erroreak[]= "Eposta beharrezko balio bat da"; 
	}
	if (!preg_match('/[a-zA-Z]{3,}[0-9]{3}\@ikasle\.ehu\.eus/', $eposta)){
		$erroreak[]= "Eposta pro000@ikasle.ehu.eus bezalakoa izan behar du"; 
	}
	
	//galdera balidatu
	$galdera = preg_replace('/([\s])+/', ' ', $galdera);
	if (!balidatuBeharrez($galdera)){
		$erroreak[]= "Galdera beharrezko balio bat da"; 
	}
	if (strlen($galdera) < 10){
		$erroreak[]= "Galdera 9 karaktere baino gehiago izan behar ditu"; 
	}
	
	//zuzena
	if (!balidatuBeharrez($zuzena)){
		$erroreak[]= "Erantzun zuzena beharrezko balio bat da"; 
	}
	
	//okerra1
	if (!balidatuBeharrez($okerra1)){
		$erroreak[]= "Erantzun okerra1 beharrezko balio bat da"; 
	}
	
	//okerra2
	if (!balidatuBeharrez($okerra2)){
		$erroreak[]= "Erantzun okerra2 beharrezko balio bat da"; 
	}
	
	//okerra3
	if (!balidatuBeharrez($okerra3)){
		$erroreak[]= "Erantzun okerra3 beharrezko balio bat da"; 
	}
	
	//zailtasuna
	if (!balidatuBeharrez($zailtasuna)){
		$erroreak[]= "Zailtasuna zuzena beharrezko balio bat da"; 
	}
	$opciones = array(
    'options' => array(
        //'default' => 3, // valor a retornar si el filtro falla
        // más opciones aquí
        'min_range' => 0,
		'max_range' => 5,
		'flags' => FILTER_NULL_ON_FAILURE
    ),
    //'flags' => FILTER_FLAG_ALLOW_OCTAL,
);
	
	//if (!(filter_var($zailtasuna, FILTER_VALIDATE_INT) === 0) || filter_var($zailtasuna, FILTER_VALIDATE_INT, $opciones) == FALSE){
	//	$erroreak[]= "Zailtasuna 0-5 artean egon behar du"; 
	//}
	
	//gaia
	if (!balidatuBeharrez($gaia)){
		$erroreak[]= "Gaia beharrezko balio bat da"; 
	}


	if( count($erroreak) > 0 ){
            echo "<p>ERROREAK EGON DIRA:</p>";
            // Erroreak erakutsi:
            for( $kont=0; $kont < count($erroreak); $kont++ )
                echo $erroreak[$kont]."<br/>";
    }else{
	
		//$path = '../images/' . $_FILES['irudia']['name'];
		$path = $_FILES['irudia']['tmp_name'];
		
		$path_berria = '../images/galdIrudi/' . $_FILES['irudia']['name'];
		if ( in_array($_FILES['irudia']['type'], $extentsioak) ) {
			//echo 'Irudia da';
			//echo '</br>';
			if ( $_FILES['irudia']['size']< $max_tamaina ) {
				//echo '1 MB baino txikiagoa';
				//echo '</br>';
				if( move_uploaded_file ( $path, $path_berria ) ) {
					//echo 'Irudia zuzen gorde da';
					//echo '</br>';
				}
			}
		}
		
		if($_FILES['irudia']['name']!="") $sql = "INSERT INTO questions (Id, Email, Galdera, Zuzena, Okerra1, Okerra2, Okerra3, Zailtasuna, Gaia, Irudia) VALUES(DEFAULT, '$_GET[eposta]' , '$_GET[galdera]' , '$_GET[zuzena]' , '$_GET[okerra1]' , '$_GET[okerra2]' , '$_GET[okerra3]' , '$_GET[zailtasuna]' , '$_GET[gaia]' , '$path_berria')";
		else $sql = "INSERT INTO questions (Id, Email, Galdera, Zuzena, Okerra1, Okerra2, Okerra3, Zailtasuna, Gaia, Irudia) VALUES(DEFAULT, '$_GET[eposta]' , '$_GET[galdera]' , '$_GET[zuzena]' , '$_GET[okerra1]' , '$_GET[okerra2]' , '$_GET[okerra3]' , '$_GET[zailtasuna]' , '$_GET[gaia]' , null)";
		$ema= mysqli_query($niremysqli, $sql);

		if(!$ema){
			echo("Errorea query-a gauzatzerakoan: ". mysqli_error($niremysqli));
			echo ('<a href="addQuestionwithImage.php">Formulariora itzultzeko klikatu hemen</a>');
		}
		else{
			echo('</br>DATUAK ONDO GORDE DIRA</br></br>');
			
			$showi = "showQuestionswithImages.php?op=logeatua&eposta=" . $eposta;
			$showi = strval($showi);
			//echo "<script> $('#galdetegia').attr('action', '". $showi . "')</script>";
			echo ('<a href="'.$showi.'">Datubaseko datuak ikusteko klikatu hemen</a></br></br>');	
		}
		
		//XML
		
		$xml = simplexml_load_file('../xml/questions.xml');
		
		if ($xml === false) {
			echo "Errorea XML fitxategia kargatzerakoan\n";
			foreach(libxml_get_errors() as $error) {
				echo "\t", $error->message;
			}
		}else{
		
			$assessmentItem = $xml->addChild('assessmentItem');
			$assessmentItem->addAttribute('author', $eposta);
			$assessmentItem->addAttribute('subject', $gaia);
			$itemBody = $assessmentItem->addChild('itemBody');
			$p = $itemBody->addChild('p', $galdera);
			$correctResponse = $assessmentItem->addChild('correctResponse');
			$value = $correctResponse->addChild('value', $zuzena);
			$incorrectResponses = $assessmentItem->addChild('incorrectResponses');
			$value1 = $incorrectResponses->addChild('value', $okerra1);
			$value2 = $incorrectResponses->addChild('value', $okerra2);
			$value3 = $incorrectResponses->addChild('value', $okerra3);
		
			
			// <assessmentItem author="rosa001@ikasle.ehu.eus" subject="mikologia">
				// <itemBody> 
					// <p>Zein Amanita da jangarria?</p>
				// </itemBody>
				// <correctResponse>
					// <value>Caesarea</value>
				// </correctResponse>
				// <incorrectResponses>
					// <value>Phalloides</value>
					// <value>Muscaria</value>
					// <value>Virosa</value>
				// </incorrectResponses>
			// </assessmentItem>
		
			//echo $xml->asXML();
			$xml->asXML('../xml/questions.xml');
			
			echo ('<a href="showXMLQuenstions.php">XMLko datuak ikusteko klikatu hemen</a></br></br>');	
		
		}
	}
}
?>