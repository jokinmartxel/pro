<?php
session_start();

if (isset ($_SESSION['eposta'])){
	if (strcmp($_SESSION['rola'],"admin")==0){
		// administratzailea
		header ('location: layout.php' );
	}
}else{
	// logeatu gabe
	header ('location: layout.php' );
}
?>


<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>addQuestion 5</title>
	    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../styles/smartphone.css' />
		   
	<style type="text/css">
			fieldset {padding: 10px;}
			body {margin: 10px;}
	</style>

	
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
    <script>
            $(document).ready(function(){

				$("#galdetegia").submit(function(){
					
					//galdera
					var galdera = $("#galdera").val().trim();
					galdera = galdera.replace(/\s+ /gi, " ");

					if (galdera.length < 10){
						alert("Galderak 9 karaktere baino gehiago izan behar ditu");
						return false;
					}
										
                });
			
				
				function irudiaBistaratu(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();
						reader.readAsDataURL(input.files[0]);
						reader.onload = function (e) {
							$('#gehiIrudi').remove();
							$('#galdetegia').append('<img id ="gehiIrudi" style="margin: 10px" src="'+e.target.result+'" width="200" height="150"/>');
							}
					}
				}
	
				$("#irudia").change(function () {
					irudiaBistaratu(this);
				});

				$("#reset").click(function(){
					$('#gehiIrudi').remove();
				});		
			
			});
			
	</script>
  </head>
  <body>
  
<fieldset>
	<form id="galdetegia" method="post" action="addQuestionwithImage.php" enctype="multipart/form-data">
	
		
				Eposta(*)<input id="eposta" name="eposta" type="text" pattern="[a-zA-Z]{3,}[0-9]{3}@ikasle.ehu.eus" title="pro000@ikasle.ehu.eus" size="25" placeholder="proba000@ikasle.ehu.eus" autofocus required /><br><br>
				Galdera(*)<input id="galdera" name="galdera" type="text" size="50" required /><br>
				Erantzun zuzena(*)<input id="zuzena" name="zuzena" type="text" size="25" required /><br>
				Erantzun okerra 1(*)<input id="okerra1" name="okerra1" type="text" size="25" required /><br>
				Erantzun okerra 2(*)<input id="okerra2" name="okerra2" type="text" size="25" required /><br>
				Erantzun okerra 3(*)<input id="okerra3" name="okerra3" type="text" size="25" required /><br><br>
				
				Zailtasuna(*)<input id="zailtasuna" name="zailtasuna" type="number" size="25" min="0" max="5" placeholder="0-5" required><br>
				Gaia(*)<input id="gaia" name="gaia" type="text" size="25" required /><br>
				Irudia<input id="irudia" name="irudia" type="file" accept="image/png, image/jpg, image/jpeg" /><br><br>
				<input name="submit" type="submit" id="submit" value="Submit"/>
				<input name="reset" type="reset" id="reset" value="Reset"/><br>
	</form>
</fieldset>
<a href="../layout.php" id="home">HOME</a>
</body>
</html>

<?php

// if (isset ($_GET['op'])){
	// //logeatua dago
	// if ($_GET['op'] == 'logeatua'){
		// $eposta = $_GET['eposta'];
		// $eposta = strval($eposta);
		// echo "<script> $('#eposta').attr('value', '" . $eposta . "');</script>";
		
		// $lay = "layout.php?op=logeatua&eposta=" . $eposta;
		// $lay = strval($lay);
		// echo "<script> $('#home').attr('href', '". $lay . "')</script>";
		
		
		// $action = "addQuestionwithImage.php?op=logeatua&eposta=" . $eposta;
		// $action = strval($action);
		// echo "<script> $('#galdetegia').attr('action', '". $action . "')</script>";
		


	// }
// }


if (isset($_SESSION['eposta'])){
	// logeatuta
	$eposta = $_SESSION['eposta'];
	$eposta = strval($eposta);
	echo "<script> $('#eposta').attr('value', '" . $eposta . "');</script>";
	
	$lay = "layout.php";
	$lay = strval($lay);
	echo "<script> $('#home').attr('href', '". $lay . "')</script>";
	
	
	$action = "addQuestionwithImage.php";
	$action = strval($action);
	echo "<script> $('#galdetegia').attr('action', '". $action . "')</script>";
}

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
$eposta = isset($_POST['eposta']) ? $_POST['eposta'] : null;
$galdera = isset($_POST['galdera']) ? $_POST['galdera'] : null;
$zuzena = isset($_POST['zuzena']) ? $_POST['zuzena'] : null;
$okerra1 = isset($_POST['okerra1']) ? $_POST['okerra1'] : null;
$okerra2 = isset($_POST['okerra2']) ? $_POST['okerra2'] : null;
$okerra3 = isset($_POST['okerra3']) ? $_POST['okerra3'] : null;
$zailtasuna = isset($_POST['zailtasuna']) ? $_POST['zailtasuna'] : null;
$gaia = isset($_POST['gaia']) ? $_POST['gaia'] : null;


$extentsioak = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
$max_tamaina = 1024 * 1024 * 8;

$erroreak = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
		
		if($_FILES['irudia']['name']!="") $sql = "INSERT INTO questions (Id, Email, Galdera, Zuzena, Okerra1, Okerra2, Okerra3, Zailtasuna, Gaia, Irudia) VALUES(DEFAULT, '$_POST[eposta]' , '$_POST[galdera]' , '$_POST[zuzena]' , '$_POST[okerra1]' , '$_POST[okerra2]' , '$_POST[okerra3]' , '$_POST[zailtasuna]' , '$_POST[gaia]' , '$path_berria')";
		else $sql = "INSERT INTO questions (Id, Email, Galdera, Zuzena, Okerra1, Okerra2, Okerra3, Zailtasuna, Gaia, Irudia) VALUES(DEFAULT, '$_POST[eposta]' , '$_POST[galdera]' , '$_POST[zuzena]' , '$_POST[okerra1]' , '$_POST[okerra2]' , '$_POST[okerra3]' , '$_POST[zailtasuna]' , '$_POST[gaia]' , null)";
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