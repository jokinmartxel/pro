<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>OnePlay</title>

	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
  </head>
  <body>

	<form id="oneplay" method="post" action="zuzendu.php">
				Galdera: <input id="galdera" name="galdera" type="text" size="50" readonly /><br><br>
				Erantzunak: <br/>  
				<input type="radio" id="bat" name="erantzunak" value=""> 
				<input type="radio" id="bi" name="erantzunak" value=""> 
				<input type="radio" id="hiru" name="erantzunak" value=""> 
				<input type="radio" id="lau" name="erantzunak" value="">
				<br/><br/>
				<input name="reset" type="reset" id="reset" value="Reset"/>
				<input name="bidali" type="submit" id="bidali" value="Bidali"/>
	</form><br>


</body>
</html>




<?php 


include "dbConfig.php";
global $niremysqli;

$sql = "SELECT * FROM questions";
$res = mysqli_query($niremysqli, $sql); 

if (mysqli_num_rows($res) > 0) {
	
	echo rand(1, mysqli_num_rows($res));
}
else{ echo "Ez dago lerrorik";}
if (!$res){	echo("Errorea query-a gauzatzerakoan: ". mysqli_error($niremysqli));}



$lay = "layout.php";
$lay = strval($lay);
echo ("<a href=". $lay . "> ITZULI HASIERAKO ORRIRA </a></br></br>");
	

//echo('<a href="../layout.html"> ITZULI HASIERAKO ORRIRA </a></br></br>');
mysqli_close($niremysqli);

?>