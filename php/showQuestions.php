<?php 

//$id= $_GET['id'];
//$zenb=0;
include "dbConfig.php";
global $niremysqli;
$sql = "SELECT * FROM questions";
$result = mysqli_query($niremysqli, $sql); 

if (mysqli_num_rows($result) > 0) {
	echo "<table border = '1'> \n"; 
	echo "<tr><td>ID</td><td>Emaila</td><td>Galdera</td><td>Erantzun zuzena</td><td>Erantzun okerra 1</td><td>Erantzun okerra 2</td><td>Erantzun okerra 3</td><td>Zailtasuna</td><td>Gaia</td></tr> \n"; 
	while ($row = mysqli_fetch_assoc($result)){ 
		   echo "<tr><td>" . $row["Id"]. "</td><td>" . $row["Email"]. "</td><td>" . $row["Galdera"]. "</td><td>" . $row["Zuzena"]. " </td><td>" . $row["Okerra1"]. "</td><td> " . $row["Okerra2"]. "</td><td>" . $row["Okerra3"]. "</td><td>" . $row["Zailtasuna"]. "</td><td>" . $row["Gaia"]. "</td></tr> \n"; 
	}
}
else{
	echo "0 lerro taulan";
}

if (!$result)
{
echo("Errorea query-a gauzatzerakoan: ". mysqli_error($niremysqli));
}
echo('<a href="../layout.html"> HASIERAKO ORRIRA ITZULTZEKO HEMEN KLIKATU </a></br></br>');
mysqli_close($niremysqli);

?>