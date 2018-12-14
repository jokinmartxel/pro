<?php
session_start();

include "dbConfig.php";
global $niremysqli;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Playingbs</title>

	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
	<script language="javascript">
		function erakutsi(){
			var gaia = "";
			$.ajax({
				url : "hirugaldera.php?gaia=kaixo",
				dataType : '',
				data : param,
				cache : false,
				complete : function() {
					$('#galderak').load("hirugaldera.php?gaia=kaixo");
				}			
			});
			
			
		}
	</script>
  </head>
  <body>

	<form id="playingbs" method="post" action="">
				Aukeratu galderen gaia:
				<div id="gaiak">
				
					
				</div>
				<br/>
				<input name="bidali" type="button" id="bidali" value="Erakutsi galderak" onClick="erakutsi()"/>
				<div id="galderak">
					
				</div>
	</form><br>


</body>
</html>




<?php 
include "dbConfig.php";
global $niremysqli;

$sql = "SELECT * FROM questions GROUP BY Gaia";
$res = mysqli_query($niremysqli, $sql); 

if (mysqli_num_rows($res) > 0) {
	echo "<script> $('#gaiak').append(".'"'."<select name='cars' id='gaiaks'> ".'"'.");</script>";
	while ($row = mysqli_fetch_assoc($res)){ 
		echo "<script> $('#gaiaks').append(".'"'."<option value='".$row['Gaia']."'>".$row['Gaia']."</option> ".'"'.");</script>";
	}
	
}
else{ echo "Ez dago galderarik";}

?>