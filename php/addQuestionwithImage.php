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

//$irudia = isset($_FILES['irudia']) ? $_FILES['irudia'] : null;

$erroreak = array();

echo $_FILES['irudia']['name'];
echo $_FILES['irudia']['tmp_name'];
echo $_FILES['irudia']['type'];
echo $_FILES['irudia']['size'];
echo $_FILES['irudia']['error'];

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
	
	
	$ruta_indexphp = dirname(realpath(__FILE__));
	$ruta_fichero_origen = $_FILES['irudia']['tmp_name'];
	$ruta_nuevo_destino = '../images/galdIrudi/' . $_FILES['irudia']['name'];
	if ( in_array($_FILES['irudia']['type'], $extentsioak) ) {
		echo 'Es una imagen';
		if ( $_FILES['irudia']['size']< $max_tamaina ) {
			echo 'Pesa menos de 1 MB';
			if( move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino ) ) {
				echo 'Fichero guardado con éxito';
			}
		}
	}

	//lo comvertimos en binario antes de guardarlo
	$irudia= addslashes (file_get_contents(Normalizer::normalize($ruta_fichero_origen, Normalizer::FORM_D))); //pasa \ -> /
	//file_get_contents("ehu.jpg");
	
	$sql = "INSERT INTO questions (Id, Email, Galdera, Zuzena, Okerra1, Okerra2, Okerra3, Zailtasuna, Gaia, Irudia) VALUES(DEFAULT, '$_POST[eposta]' , '$_POST[galdera]' , '$_POST[zuzena]' , '$_POST[okerra1]' , '$_POST[okerra2]' , '$_POST[okerra3]' , '$_POST[zailtasuna]' , '$_POST[gaia]' , '$irudia')";
	$ema= mysqli_query($niremysqli, $sql);

	if(!$ema){
		echo("Errorea query-a gauzatzerakoan: ". mysqli_error($niremysqli));
		echo ('<a href="../addQuestion5.html">Formulariora itzultzeko klikatu hemen</a>');
	}
	else{
		echo('DATUAK ONDO GORDE DIRA</br></br>');
		echo ('<a href="showQuestions.php">Datubaseko datuak ikusteko klikatu hemen</a></br></br>');	
	}
	}
}
?>