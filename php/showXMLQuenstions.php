<?php 

session_start();

if (!isset ($_SESSION['eposta'])){
	header ('location: layout.php' );
}


$xml = simplexml_load_file('../xml/questions.xml');

echo "<table border = '1'> \n"; 
echo "<tr><td><b>Egilea</b></td><td><b>Enuntziatua</b></td><td><b>Erantzun zuzena</b></td></tr> \n"; 
foreach($xml->assessmentItem as $assessmentItem){
	$egilea = $assessmentItem['author'];
	$enuntziatua = $assessmentItem->itemBody->p;
	$zuzena = $assessmentItem->correctResponse->value;
	echo "<tr><td>" . $egilea. "</td><td>" . $enuntziatua. "</td><td>" . $zuzena. "</td></tr> \n";
}


$eposta = strval($_SESSION['eposta']);

$lay = "layout.php";
$lay = strval($lay);
echo ("<a href=". $lay . "> ITZULI HASIERAKO ORRIRA </a></br></br>");
	

	//egilea enuntziatua erantzunzuzena

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

?>