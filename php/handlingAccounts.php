<?php
include "dbConfig.php";
global $niremysqli;

$sql = "SELECT * FROM erabiltzaileak";
$res = mysqli_query($niremysqli, $sql); 

if (mysqli_num_rows($res) > 0) {
	
	echo "<table border = '1'> \n"; 
	echo "<tr><td>Eposta</td><td>Pasahitza</td><td>Argazkia</td><td>Egoera</td><td>Kudeatu</td></tr> \n"; 
	while ($row = mysqli_fetch_assoc($res)){ 
		if($row["Argazkia"]!=null){
			if (strcmp($row['Egoera'], "aktibo")==0){
				 echo "<tr><td>" . $row["Eposta"]. "</td><td>" . $row["Pasahitza"]. "</td><td> <img width='75' height='75' src='" . $row["Argazkia"] . "'/> </td><td><select><option value='aktibo'>aktibo</option><option value='blokeatuta'>blokeatuta</option></select></td></tr> \n"; 
			}else{
				echo "<tr><td>" . $row["Eposta"]. "</td><td>" . $row["Pasahitza"]. "</td><td> <img width='75' height='75' src='" . $row["Argazkia"] . "'/> </td><td><select><option value='aktibo'>aktibo</option><option value='blokeatuta' selected='selected'>blokeatuta</option></select></td></tr> \n"; 
			}
		}
		else echo "<tr><td>" . $row["Eposta"]. "</td><td>" . $row["Pasahitza"]. "</td><td> <img width='75' height='75' src='../images/default.png'/> </td><td>".$row["Egoera"]."</td></tr> \n";	
	}
}
else{ echo "Ez dago lerrorik";}
if (!$res){	echo("Errorea query-a gauzatzerakoan: ". mysqli_error($niremysqli));}

?>