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
						Eposta: <input id="epostaB" name="epostaB" type="text" size="75" readonly /><br><br>
						Galdera: <input id="galdera" name="galdera" type="text" size="75" readonly /><br><br>
						Erantzuna*: <input id="erantzuna" name="erantzuna" type="text" size="25" required /><br><br>
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
if (isset ($_POST['eposta'])){
	$usr_mail = $_POST['eposta'];
	
	$sql = "select SGaldera from erabiltzaileak where eposta='$usr_mail' ";
		
	$result = $niremysqli->query($sql);
		
	//echo $pasahitzaDB;
	if(! ($result)) {echo 'Error in the query'. $result->error;}
		else{
			$rows_cnt = $result->num_rows;

			if ($rows_cnt == 1){
				$rows_cnt = 0;
				$galdera = mysqli_fetch_assoc($result);
				$galdera1 = $galdera['SGaldera'];
				echo "<script> $('#galdera').attr('value', '" . $galdera1 . "');</script>";
				echo "<script> $('#epostaB').attr('value', '" . $usr_mail . "');</script>";
			}
				
				
					
				
				
				
			
			else{ echo "<script> alert('Ez dago erabiltzailerik eposta horrekin')</script>";}
		}
		$niremysqli->close();

}else{

		header('location: login.php');
	
}











?>

