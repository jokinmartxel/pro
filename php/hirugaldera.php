<?php

include "dbConfig.php";
global $niremysqli;

$gaia = $_GET['gaia'];

$sql = "SELECT * FROM questions WHERE Gaia = '$gaia' ORDER BY RAND()";
$res = mysqli_query($niremysqli, $sql); 
if (($res->num_rows)==1){
	galderaBete($res, 1);
	echo "<script> $('#galderak').append(".'"'."<input name='bidali' type='button' id='bidali' value='Konprobatu' onClick='konprobatu()'/> ".'"'.");</script>";
}else{
	if (($res->num_rows)==1){
		galderaBete($res, 1);
		galderaBete($res, 2);
		echo "<script> $('#galderak').append(".'"'."<input name='bidali' type='button' id='bidali' value='Konprobatu' onClick='konprobatu()'/> ".'"'.");</script>";
	}else{
		galderaBete($res, 1);
		galderaBete($res, 2);
		galderaBete($res, 3);
		echo "<script> $('#galderak').append(".'"'."<input name='bidali' type='button' id='bidali' value='Konprobatu' onClick='konprobatu()'/> ".'"'.");</script>";
		
	}
}


function galderaBete($res, $zen){
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
			$zailtasun = $row['Zailtasuna'];
			$id = $row['Id'];
			$_SESSION['gId'] = $id;
				$_SESSION['erabiliak'][]= $id; 
				
				
				echo "<script> $('#galderak').append(".'"'."Galdera: <input id='galdera".$zen."' name='galdera' type='text' size='50' readonly /><br>Erantzunak: <br/>".'"'.");</script>";
				
				
				echo "<script> $('#galdera".$zen."').attr('value', '".$galdera."');</script>";
				echo "<script> $('#bat').attr('value', '".$okerra1."');</script>";
				echo "<script> $('#galdera').prepend('".$okerra1."');</script>";

					
				$rand = rand(0,3);
				switch ($rand){
					case 0: 
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$zuzena."'>".$zuzena." <br/> ".'"'.");</script>";
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$okerra1."'>".$okerra1." <br/> ".'"'.");</script>";
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$okerra2."'>".$okerra2." <br/> ".'"'.");</script>";
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$okerra3."'>".$okerra3." <br/> ".'"'.");</script>";
						break;
					case 1: 
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$okerra1."'>".$okerra1." <br/> ".'"'.");</script>";
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$zuzena."'>".$zuzena." <br/> ".'"'.");</script>";
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$okerra2."'>".$okerra2." <br/> ".'"'.");</script>";
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$okerra3."'>".$okerra3." <br/> ".'"'.");</script>";
						break;
					case 2: 
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$okerra1."'>".$okerra1." <br/> ".'"'.");</script>";
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$okerra2."'>".$okerra2." <br/> ".'"'.");</script>";
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$zuzena."'>".$zuzena." <br/> ".'"'.");</script>";
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$okerra3."'>".$okerra3." <br/> ".'"'.");</script>";
						break;
					case 3: 
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$okerra1."'>".$okerra1." <br/> ".'"'.");</script>";
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$okerra2."'>".$okerra2." <br/> ".'"'.");</script>";
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$okerra3."'>".$okerra3." <br/> ".'"'.");</script>";
						echo "<script> $('#galderak').append(".'"'."<input type='radio' id='bat' name='erantzunak".$zen."' value='".$zuzena."'>".$zuzena." <br/> ".'"'.");</script>";
						break;
				}
				echo "<script> $('#galderak').append(".'"'."<br/> ".'"'.");</script>";
				
				
				echo "<script> var zuzena".$zen." = '".$zuzena."';</script>";
				echo "<script> var zailtasun".$zen." = '".$zailtasun."';</script>";
				echo "<script> var id = '".$id."';</script>";
				
				$arg = $row['Irudia'];	
				if($row['Irudia']!="") echo "<script> $('#erantz').after('<img src=".$arg." width=100  />');</script>";
			
		}
	}	
}




?>