<?php
session_start();

include "dbConfig.php";
global $niremysqli;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>OnePlay</title>

	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
	<script language="javascript">
		function konprobatu(){
			if (($('input[name="erantzunak"]:checked').val()).localeCompare(zuzena)){
				alert("Erantzun Okerra");				
			}else{
				alert("Erantzun Zuzena");
			}
			
			var option = confirm("Galdera gustatu zaizu?");
			if (option == true){
				var param = "id='" + id + "'&gustatu=bai";
				$.ajax({
					url : "eguneratuGald.php",
					dataType : '',
					data : param,
					cache : false,
										
				});
			}else{
				var param = "id='" + id + "'&gustatu=ez";
				$.ajax({
					url : "eguneratuGald.php",
					dataType : '',
					data : param,
					cache : false,
										
				});
			}
						
			var option = confirm("Beste galdera bat nahi duzu?");
			if (option == true){
				location.href="oneplay.php";				
			}else{
				location.href="layout.php";
			}
			
		}
	</script>
  </head>
  <body>

	<form id="oneplay" method="post" action="">
				Galdera: <input id="galdera" name="galdera" type="text" size="50" readonly /><br><br>
				Erantzunak: <br/> 
				<div id="erantz">

				</div>
				<br/><br/>
				<input name="reset" type="reset" id="reset" value="Reset"/>
				<input name="bidali" type="button" id="bidali" value="Konprobatu" onClick="konprobatu()"/>
	</form><br>


</body>
</html>




<?php 


include "dbConfig.php";
global $niremysqli;


$sql = "SELECT * FROM questions ORDER BY RAND()";
$res = mysqli_query($niremysqli, $sql); 

if (mysqli_num_rows($res) > 0) {
	galderaBete($res);
}else{
	echo "<script> alert('Ez daude galderarik');</script>";
}


if (!$res){	echo("Errorea query-a gauzatzerakoan: ". mysqli_error($niremysqli));}



$lay = "layout.php";
$lay = strval($lay);
echo ("<a href=". $lay . "> ITZULI HASIERAKO ORRIRA </a></br></br>");
	

//echo('<a href="../layout.html"> ITZULI HASIERAKO ORRIRA </a></br></br>');
mysqli_close($niremysqli);


function galderaBete($res){
	if ($res == null){
		echo "<script> alert('Galdera guztiak erantzun dituzu');</script>";
	}else{
		$row = mysqli_fetch_assoc($res);
		if ($row== null){
			echo "<script> alert('Galdera guztiak erantzun dituzu');</script>";
			echo "<script> location.href='layout.php';</script>";
		}else{
			$galdera = $row['Galdera'];	
			$zuzena = $row['Zuzena'];	
			$okerra1 = $row['Okerra1'];	
			$okerra2 = $row['Okerra2'];	
			$okerra3 = $row['Okerra3'];
			$id = $row['Id'];
			$_SESSION['gId'] = $id;
			if (in_array($id, $_SESSION['erabiliak'])){
				galderaBete($res);
			}else{
				$_SESSION['erabiliak'][]= $id; 
				
				echo "<script> $('#galdera').attr('value', '".$galdera."');</script>";
				echo "<script> $('#bat').attr('value', '".$okerra1."');</script>";
				echo "<script> $('#galdera').prepend('".$okerra1."');</script>";

					
				$rand = rand(0,3);
				switch ($rand){
					case 0: 
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$zuzena."'>".$zuzena." <br/> ".'"'.");</script>";
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$okerra1."'>".$okerra1." <br/> ".'"'.");</script>";
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$okerra2."'>".$okerra2." <br/> ".'"'.");</script>";
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$okerra3."'>".$okerra3." <br/> ".'"'.");</script>";
						break;
					case 1: 
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$okerra1."'>".$okerra1." <br/> ".'"'.");</script>";
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$zuzena."'>".$zuzena." <br/> ".'"'.");</script>";
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$okerra2."'>".$okerra2." <br/> ".'"'.");</script>";
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$okerra3."'>".$okerra3." <br/> ".'"'.");</script>";
						break;
					case 2: 
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$okerra1."'>".$okerra1." <br/> ".'"'.");</script>";
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$okerra2."'>".$okerra2." <br/> ".'"'.");</script>";
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$zuzena."'>".$zuzena." <br/> ".'"'.");</script>";
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$okerra3."'>".$okerra3." <br/> ".'"'.");</script>";
						break;
					case 3: 
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$okerra1."'>".$okerra1." <br/> ".'"'.");</script>";
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$okerra2."'>".$okerra2." <br/> ".'"'.");</script>";
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$okerra3."'>".$okerra3." <br/> ".'"'.");</script>";
						echo "<script> $('#erantz').append(".'"'."<input type='radio' id='bat' name='erantzunak' value='".$zuzena."'>".$zuzena." <br/> ".'"'.");</script>";
						break;
				}
							
				echo "<script> var zuzena = '".$zuzena."';</script>";
				echo "<script> var id = '".$id."';</script>";
				
				$arg = $row['Irudia'];	
				if($row['Irudia']!="") echo "<script> $('#erantz').after('<img src=".$arg." width=100  />');</script>";
			}
		}
	}	
}

?>