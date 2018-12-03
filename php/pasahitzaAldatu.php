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
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      <span class="right"><a href="logIn.php">LogIn</a> </span>
	  <span class="right"><a href="signUp.php">Sign Up</a> </span>
      <!-- <span class="right" style="display:none;"><a href="/logout">LogOut</a> </span> -->
	<h2>Login</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Home</a></span>
		<span><a href='../quizzes'>Quizzes</a></span>
		<span><a href='credits.php'>Credits</a></span>
		<!-- <span><a href='addQuestion.html'>Galdera gehitu 4</a></span> -->
		<!--<span><a href='addQuestion5.html'>Galdera gehitu 5</a></span> -->
	</nav>
    <section class="main" id="s1">
    
	<h2>Pasahitza errekuperatu galdera</h2>
	<div>
	<fieldset>
		<legend>Erabiltzailearen galdera panela: </legend>
			<form id="pasaErrek" method="post" action="pasahitzaAldatu.php">
						Eposta: <input id="epostaB" name="epostaB" type="text" size="25" readonly /><br><br>
						Pasahitz berria*: <input id="pasahitza1" name="pasahitza1" type="password" size="25" required /><br><br>
						Pasahitz berria errep*: <input id="pasahitza2" name="pasahitza2" type="password" size="25" required /><br><br>
						<input name="reset" type="reset" id="reset" value="Reset"/>
						<input name="bidali" type="submit" id="bidali" value="Bidali"/>
			</form><br>
	</fieldset>
	</div>
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
if (isset ($_POST['erantzuna'])){
		$erantzuna = $_POST['erantzuna'];
		$usr_mail = $_POST['epostaB'];
		
		$sql = "select * from erabiltzaileak where eposta='$usr_mail' and Erantzuna='$erantzuna'";
		
		$result = $niremysqli->query($sql);
		
		if(! ($result)) {echo 'Error in the query'. $result->error;}
		else{
			$rows_cnt = $result->num_rows;
			if ($rows_cnt == 1){
				$rows_cnt = 0;
			
				echo "<script> alert('Erantzun zuzena')</script>";
				
				echo "<script> $('#epostaB').attr('value', '" . $usr_mail . "');</script>";
				
			}else{
				echo "<script> alert('Erantzun ez da zuzena')</script>";
				echo('<script>location.href="pasahitzaErrek.php" </script>');
			}
		}
			
}else{
	if (isset ($_POST['pasahitza1'])){
		$pasahitza1 = $_POST['pasahitza1'];
		$pasahitza2 = $_POST['pasahitza2'];
		$usr_mail = $_POST['epostaB'];
		
		
		if(strcmp(strval($pasahitza1), strval($pasahitza2))==0){
			$pasahitzEnk = password_hash($pasahitza1, PASSWORD_DEFAULT);
			$sql = "UPDATE erabiltzaileak SET Pasahitza = '$pasahitzEnk' where Eposta='$usr_mail'";
			
			$result = $niremysqli->query($sql);
			
			if(! ($result)) {echo 'Error in the query'. $result->error;}
			else{
				
				echo "<script> alert('Ondo eguneratu da pasahitza')</script>";
				echo('<script>location.href="login.php" </script>');
			}
		}else{
			echo "<script> alert('Pasahitzak ez dira berdinak')</script>";
			echo "<script> $('#epostaB').attr('value', '" . $usr_mail . "');</script>";
		}
		
			
	}else{
			header('location: login.php');
	}
}











?>

