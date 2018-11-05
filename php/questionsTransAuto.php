<?php
$xslDoc = new DOMDocument();
$xslDoc->load("../xml/showXMLQuestions.xsl");
$xmlDoc = new DOMDocument();
$xmlDoc->load("../xml/questionsTransAuto.xml");
$proc = new XSLTProcessor();
$proc->importStylesheet($xslDoc);
echo $proc->transformToXML($xmlDoc);

if (isset ($_GET['op'])){
	//logeatua dago
	if ($_GET['op'] == 'logeatua'){
		//header ('location: ../layout.php' );
		$eposta = strval($_GET['eposta']);
		
		$lay = "layout.php?op=logeatua&eposta=" . $eposta;
		$lay = strval($lay);
		echo ("<a href=". $lay . "> ITZULI HASIERAKO ORRIRA </a></br></br>");
	}
}
?>