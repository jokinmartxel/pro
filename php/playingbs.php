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
			var gaia = $('#gaiaks').val();
			var urla = "hirugaldera.php?gaia=" + gaia;
			$.ajax({
				url : urla,
				dataType : '',
				data : '',
				cache : false,
				complete : function() {
					$('#galderak').load(urla);
				}			
			});
			
			
		}
		
		function konprobatu(){
			if (zuzena2==null && zuzena3==null){
				// galdera bat
				if ((($('input[name="erantzunak1"]:checked').val()).localeCompare(zuzena1))==0){
					alert("Galdera asmatu duzu");
					
				}else{
					alert("Galdera ez duzu asmatu");
				}
				alert("Zailtasun batazbestekoa hau izan da: " + zailtasun1);
				location.href="quizzes.php";
			}else{
				if (zuzena3==null){
					// bi galdera
					if ((($('input[name="erantzunak1"]:checked').val()).localeCompare(zuzena1))==0){
						if ((($('input[name="erantzunak2"]:checked').val()).localeCompare(zuzena2))==0){
							alert("Bi galderak asmatu dituzu");				
						}else{
							alert("Bakarra asmatu duzu");
						}				
					}else{
						if ((($('input[name="erantzunak2"]:checked').val()).localeCompare(zuzena2))==0){
							alert("Bakarra asmatu duzu");				
						}else{
							alert("Ez duzu ezta bat asmatu");
						}
					}
					media = (parseInt(zailtasun1) + parseInt(zailtasun2))/2;
					alert("Zailtasun batazbestekoa hau izan da: " + media);
					location.href="quizzes.php";
				}else{
					// hiru galdera
					if ((($('input[name="erantzunak1"]:checked').val()).localeCompare(zuzena1))==0){
						if ((($('input[name="erantzunak2"]:checked').val()).localeCompare(zuzena2))==0){
							if ((($('input[name="erantzunak3"]:checked').val()).localeCompare(zuzena3))==0){
								alert("Hirurak asmatu dituzu");									
							}else{
								alert("Bi galdera asmatu dituzu");
							}				
						}else{
							if ((($('input[name="erantzunak3"]:checked').val()).localeCompare(zuzena3))==0){
								alert("Bi asmatu dituzu");									
							}else{
								alert("Bakarra asmatu dituzu");
							}
						}				
					}else{
						if ((($('input[name="erantzunak2"]:checked').val()).localeCompare(zuzena2))==0){
							if ((($('input[name="erantzunak3"]:checked').val()).localeCompare(zuzena3))==0){
								alert("Bi galdera asmatu dituzu");				
							}else{
								alert("Bakarra asmatu duzu");
							}				
						}else{
							if ((($('input[name="erantzunak3"]:checked').val()).localeCompare(zuzena3))==0){
								alert("Bakarra asmatu dituzu");				
							}else{
								alert("Ez duzu ezta bat asmatu");
							}
						}	
					}
					media = (parseInt(zailtasun1) + parseInt(zailtasun2) + parseInt(zailtasun3))/3;
					alert("Zailtasun batazbestekoa hau izan da: " + media);
					location.href="quizzes.php";
					
				}
			}
	
			
			
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
	echo "<script> $('#gaiak').append(".'"'."<select name='gaiaks' id='gaiaks'> ".'"'.");</script>";
	while ($row = mysqli_fetch_assoc($res)){ 
		echo "<script> $('#gaiaks').append(".'"'."<option value='".$row['Gaia']."'>".$row['Gaia']."</option> ".'"'.");</script>";
	}
	
}
else{ echo "Ez dago galderarik";}

?>