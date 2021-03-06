<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../styles/smartphone.css' />
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
    <script>
            $(document).ready(function(){		
				
				function irudiaBistaratu(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();
						reader.readAsDataURL(input.files[0]);
						reader.onload = function (e) {
							$('#gehiIrudi').remove();
							$('#argazkia').append('<span>'+files[0].name+'</span>');
							}
					}
				}
	
				$("#argazkia").change(function () {
					irudiaBistaratu(this);
				});

				$("#argazkia").click(function(){
					$('#gehiIrudi').remove();
				});

				var epostaBalio="false";
				var passBalio="false";
					
				$("#eposta").change(function (){
					$.ajax(
					{
						url: 'bezero.php',
						type:'GET',
						dataType: 'text',
						data: {'eposta' : $('#eposta').val()},
						success: function(data)
						{
							epostaBalio=data;
							$('#mezuak').empty();
							if(epostaBalio.localeCompare("false")==0){
								$('<p style="color:red;">Eposta WS irakasgaian matrikulatua egon behar da</p>').appendTo('#mezuak');
							}
							else{
								$('<p>Eposta erregistratua dago</p>').appendTo('#mezuak');
							}
							konprobatu();
						}
					});		
								
				});
				
				$("#password1").change(function (){
					$.ajax(
					{
						url: 'bezero.php',
						type:'GET',
						dataType: 'text',
						data: {'pasahitza' : $('#password1').val()},
						success: function(data)
						{
							passBalio=data;
							$('#mezuak').empty();
							if(passBalio.localeCompare("false")==0){
								$('<p style="color:red;">Pasahitza baliozkoa izan behar da</p>').appendTo('#mezuak');
							}
							else if(passBalio.localeCompare("true")==0){
								$('<p>Pasahitza baliozkoa da</p>').appendTo('#mezuak');
							}
							else{
								$('<p style="color:red;">ZERBITZURIK GABE</p>').appendTo('#mezuak');
							}
							konprobatu();
						}
					});				
				});
				
				function konprobatu(){
					if((epostaBalio.localeCompare("true")==0) && (passBalio.localeCompare("true")==0)){
						$('#submit').removeAttr('disabled');
					}
					else{
						$('#submit').attr('disabled','disabled');
					}
				}
			
			});
			
	</script>
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      <span class="right"><a href="logIn.php">LogIn</a> </span>
	  <span class="right"><a href="signUp.php" style="display:none;">Sign Up</a> </span>
      <span class="right" style="display:none;"><a href="/logout">LogOut</a> </span>
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Home</a></span>
		<span><a href='/quizzes'>Quizzes</a></span>
		<span><a href='credits.php'>Credits</a></span>
		<!-- <span><a href='addQuestion.html'>Galdera gehitu 4</a></span> -->
		<!--<span><a href='../addQuestion5.html' >Galdera gehitu 5</a></span> -->
	</nav>
    <section class="main" id="s1">
    
	
<fieldset>
	<form id="signUp" method="post" action="signUp.php" enctype="multipart/form-data">
	
		
				Eposta(*)<input id="eposta" name="eposta" type="text" pattern="[a-zA-Z]{3,}[0-9]{3}@ikasle.ehu.eus" size="25" placeholder="proba000@ikasle.ehu.eus" autofocus required /><br>
				Deitura(*)<input id="deitura" name="deitura" type="text" size="50" required /><br>
				Password(*)<input id="password1" name="password1" type="password" size="25" required /><br>
				Password(*)<input id="password2" name="password2" type="password" size="25" required /><br>
				Argazkia<input type="file" name="argazkia" id="argazkia"><br><br>
				Segurtasun galdera(*)<input id="sgaldera" name="sgaldera" type="text" size="50" required /><br>
				Erantzuna(*)<input id="erantzuna" name="erantzuna" type="text" size="50" required /><br>
				<input name="submit" type="submit" id="submit" value="Submit" disabled="disabled"/>
				<input name="reset" type="reset" id="reset" value="Reset"/><br>
	</form>
	<div id="mezuak"></div>
</fieldset>
    </section>
	<footer class='main' id='f1'>
		 <a href='https://github.com/jokinmartxel/pro'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>

<?php

	
	
	
	include 'dbConfig.php';
	$niremysqli = new mysqli($zerbitzaria,$erabiltzailea,$gakoa,$db) or die ("Error while connecting");
	
	function balidatuBeharrez($balorea){
	   if(trim($balorea) == ''){
		  return false;
	   }else{
		  return true;
	   }
	}
	
	$extentsioak = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
	$max_tamaina = 1024 * 1024 * 8;
	
	$erroreak = array();
	
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$eposta = $_POST['eposta'];
		$deitura = $_POST['deitura'];
		$pasahitza1 = $_POST['password1'];
		$pasahitza2 = $_POST['password2'];
		$sgaldera = $_POST['sgaldera'];
		$erantzuna = $_POST['erantzuna'];
		
		//eposta balidatu
		if (!balidatuBeharrez($eposta)){
			$erroreak[]= "Eposta beharrezko balio bat da"; 
		}
		if (!preg_match('/[a-zA-Z]{3,}[0-9]{3}\@ikasle\.ehu\.eus/', $eposta)){
			$erroreak[]= "Eposta pro000@ikasle.ehu.eus bezalakoa izan behar du"; 
		}
		//deitura balidatu
		if (!balidatuBeharrez($deitura)){
			$erroreak[]= "Deitura beharrezko balio bat da"; 
		}
		if (!preg_match('$[A-Z][a-zA-Z]{2,}[a-zA-Z\s]*[A-Z][a-zA-Z]{2,}[a-zA-Z\s]*$', $deitura)){
			$erroreak[]= "Deitura: gutxienez bi hitz hizki larriz hasten direnak"; 
		}
		//pasahitza balidatu
		if (!balidatuBeharrez($pasahitza1)){
			$erroreak[]= "Pasahitza1 beharrezko balio bat da"; 
		}
		if (!balidatuBeharrez($pasahitza2)){
			$erroreak[]= "Pasahitza2 beharrezko balio bat da"; 
		}
		if (strlen($pasahitza1) < 8){
			$erroreak[]= "Pasahitzak 8 karaktere baino gehiago izan behar ditu"; 
		}
		if(strcmp(strval($pasahitza1), strval($pasahitza2))!=0){
			$erroreak[]= "Pasahitzak berdinak izan behar dira";
		}
		
		if( count($erroreak) > 0 ){
            echo "<p>ERROREAK EGON DIRA:</p>";
            // Erroreak erakutsi:
            for( $kont=0; $kont < count($erroreak); $kont++ )
                echo $erroreak[$kont]."<br/>";
		}else{
			
			$path = $_FILES['argazkia']['tmp_name'];
		
			$path_berria = '../images/pertsonak/' . $_FILES['argazkia']['name'];
			if ( in_array($_FILES['argazkia']['type'], $extentsioak) ) {
				//echo 'Irudia da';
				//echo '</br>';
				if ( $_FILES['argazkia']['size']< $max_tamaina ) {
					//echo '1 MB baino txikiagoa';
					//echo '</br>';
					if( move_uploaded_file ( $path, $path_berria ) ) {
						//echo 'Irudia zuzen gorde da';
						//echo '</br>';
					}
				}
			}
			$sql = "select * from erabiltzaileak where eposta='$eposta'";
			$result = $niremysqli -> query($sql);
			if(! ($result)) {echo 'Error in the query'. $result->error;}
			else{
				$rows = $result -> num_rows;
				if($rows==0){
					$pasahitzEnk = password_hash($pasahitza1, PASSWORD_DEFAULT);
					if($_FILES['argazkia']['name']!="") $sql1 = "INSERT INTO erabiltzaileak (Eposta, Deitura, Pasahitza, Argazkia, Rola, Egoera, SGaldera, Erantzuna) VALUES ('$eposta', '$deitura', '$pasahitzEnk', '$path_berria', 'ikaslea', 'aktibo', '$sgaldera', '$erantzuna')";
					else $sql1 = "INSERT INTO erabiltzaileak (Eposta, Deitura, Pasahitza, Argazkia, Rola, Egoera, SGaldera, Erantzuna) VALUES ('$eposta', '$deitura', '$pasahitzEnk', null, 'ikaslea', 'aktibo', '$sgaldera', '$erantzuna')";
					$ema= mysqli_query($niremysqli, $sql1);
					if(!$ema){
						echo("Errorea query-a gauzatzerakoan: ". mysqli_error($niremysqli));
						echo "<script>alert('Autentikazio errorea')</script>";
					}
					else{
						//echo('DATUAK ONDO GORDE DIRA</br></br>');
						//header ('location: layout.php?op=erreg' );
						echo('<script>location.href="layout.php"</script>');
					}
				}
				else{
					echo "<script>alert('Dagoeneko badago eposta hau duen erabiltzailea')</script>";
				}
			}
			
			
		}
	}
?>