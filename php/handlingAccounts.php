<?php
session_start();

if (isset ($_SESSION['rola'])){
	if (strcmp($_SESSION['rola'], "ikaslea")==0){
		
		header ('location: layout.php' );

	}
}
?>


<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>handlingAccounts</title>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
	<script language = "javascript">
		function eguneratu(eposta, kont) {
		
			var select ="";
			select = ('#select').concat(kont);
			var egoera = $(select).val();
			var param = "eposta='" + eposta + "'&egoera='"+egoera+"'";
			$.ajax({
				url : "eguneratu.php",
				dataType : '',
				data : param,
				cache : false,
				complete: function(){
					alert("Ondo eguneratu da");
				}
				
			});
					
		}
		
		function ezabatu(eposta) {
			var mezua = "";
			var option = confirm("Seguru zaude erabiltzailea ezabatu nahi duzula?");
			if (option == true){
				var param = "eposta='" + eposta + "'&egoera=ezabatu";
				$.ajax({
					url : "eguneratu.php",
					dataType : '',
					data : param,
					cache : false,
					complete: function() {
					$('#erabiltzaileak').load("handlingAccounts.php");
					}
				});
				mezua = "Erabiltzailea ezabatu duzu";
			}else{
				mezua = "Erabiltzailea ez duzu ezabatu";
			}
			alert(mezua);
			
					
		}
</script>
  </head>

</html>

<?php
include "dbConfig.php";
global $niremysqli;




$sql = "SELECT * FROM erabiltzaileak";
$res = mysqli_query($niremysqli, $sql); 

if (mysqli_num_rows($res) > 0) {
	$kont = 0;
	echo "<div = 'erabiltzaileak'>";
	echo "<table border = '1'> \n"; 
	echo "<tr><td>Eposta</td><td>Pasahitza</td><td>Argazkia</td><td>Egoera</td><td>Kudeatu</td></tr> \n"; 
	while ($row = mysqli_fetch_assoc($res)){ 
		if($row["Argazkia"]!=null){
			if (strcmp($row['Egoera'], "aktibo")==0){
				 echo "<tr><td>" . $row["Eposta"]. "</td><td>" . $row["Pasahitza"]. "</td><td> <img width='75' height='75' src='" . $row["Argazkia"] . "'/> </td><td><select id='select".$kont."'><option value='aktibo'>aktibo</option><option value='blokeatuta'>blokeatuta</option></select></td><td><input type='button' value='Eguneratu' id='botoia".$kont."' onclick='eguneratu(".'"'.$row["Eposta"].'"'.",".$kont.")'/><input type='button' value='Ezabatu' id='ezabatu".$kont."' onclick='ezabatu(".'"'.$row["Eposta"].'"'.")'/></td></tr> \n"; 
			}else{
				echo "<tr><td>" . $row["Eposta"]. "</td><td>" . $row["Pasahitza"]. "</td><td> <img width='75' height='75' src='" . $row["Argazkia"] . "'/> </td><td><select id='select".$kont."'><option value='aktibo'>aktibo</option><option value='blokeatuta' selected='selected'>blokeatuta</option></select></td><td><input type='button' value='Eguneratu' id='botoia".$kont."' onclick='eguneratu(".'"'.$row["Eposta"].'"'.",".$kont.")'/><input type='button' value='Ezabatu' id='ezabatu".$kont."' onclick='ezabatu(".'"'.$row["Eposta"].'"'.")'/></td></tr> \n"; 
			}
		}
		else{
			if (strcmp($row['Egoera'], "aktibo")==0){
				 echo "<tr><td>" . $row["Eposta"]. "</td><td>" . $row["Pasahitza"]. "</td><td> <img width='75' height='75' src='../images/default.png'/> </td><td><select id='select".$kont."'><option value='aktibo'>aktibo</option><option value='blokeatuta'>blokeatuta</option></select></td><td><input type='button' value='Eguneratu' id='botoia".$kont."' onclick='eguneratu(".'"'.$row["Eposta"].'"'.",".$kont.")'/><input type='button' value='Ezabatu' id='ezabatu".$kont."' onclick='ezabatu(".'"'.$row["Eposta"].'"'.")'/></td></tr> \n"; 
			}else{
				echo "<tr><td>" . $row["Eposta"]. "</td><td>" . $row["Pasahitza"]. "</td><td> <img width='75' height='75' src='../images/default.png'/> </td><td><select id='select".$kont."'><option value='aktibo'>aktibo</option><option value='blokeatuta' selected='selected'>blokeatuta</option></select></td><td><input type='button' value='Eguneratu' id='botoia".$kont."' onclick='eguneratu(".'"'.$row["Eposta"].'"'.",".$kont.")'/><input type='button' value='Ezabatu' id='ezabatu".$kont."' onclick='ezabatu(".'"'.$row["Eposta"].'"'.")'/></td></tr> \n"; 
			}
			
		} 
		$kont++;
	}
	echo "</div>";
	echo ("<a href='layout.php'> ITZULI HASIERAKO ORRIRA </a></br></br>");
}
else{ echo "Ez dago lerrorik";}
if (!$res){	echo("Errorea query-a gauzatzerakoan: ". mysqli_error($niremysqli));}



?>

