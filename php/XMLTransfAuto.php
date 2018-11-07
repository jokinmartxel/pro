<?php 

$xslDoc= new DOMDocument();
$xslDoc->load("../xml/showXMLQuestions.xsl");
$xmlDoc= new DOMDocument();
$xmlDoc->load("../xml/questionsTransAuto.xml");
$proc= new XSLTProcessor();
$proc->importStylesheet($xslDoc);
echo $proc->transformToXML($xmlDoc);

$eposta = strval($_GET['eposta']);
$lay = "layout.php?op=logeatua&eposta=" . $eposta;
$lay = strval($lay);
echo ("<a href=". $lay . "> ITZULI HASIERAKO ORRIRA </a></br></br>");

?>