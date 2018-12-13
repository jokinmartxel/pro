<?php
session_start();
?>

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
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      <!-- <span class="right"><a href="logIn.php">LogIn</a> </span> -->
	  <span class="right"><a href="signUp.php">Sign Up</a> </span>
      <!-- <span class="right" style="display:none;"><a href="/logout">LogOut</a> </span> -->
	<h2>Login</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Home</a></span>
		<span><a href='quizzes.php'>Quizzes</a></span>
		<span><a href='credits.php'>Credits</a></span>
		<!-- <span><a href='addQuestion.html'>Galdera gehitu 4</a></span> -->
		<!--<span><a href='addQuestion5.html'>Galdera gehitu 5</a></span> -->
	</nav>
    <section class="main" id="s1">
    
	<h2>Erabiltzaile identifikazioa</h2>
	<div>
	<fieldset>
		<legend>Identifikazio panela: </legend>
			<form id="logIn" method="post" action="">
			
						Eposta: <input id="eposta" name="eposta" type="text" size="25" placeholder="proba000@ikasle.ehu.eus" autofocus/><br><br>
						Password: <input id="password" name="password" type="password" size="25"/><br>
						<input name="reset" type="reset" id="reset" value="Reset"/>
						<input name="login" type="submit" id="login" value="Login"/>
			</form><br>
	</fieldset>
	<a href="pasahitzaErrek.php">Pasahitza ahaztu duzu?</a>
	</div>
    </section>
	<footer class='main' id='f1'>
		 <a href='https://github.com/jokinmartxel/pro'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
<?php 
if (isset ($_POST['eposta'])){
	$usr_mail = $_POST['eposta'];
	include 'dbConfig.php';
	$niremysqli = new mysqli($zerbitzaria,$erabiltzailea,$gakoa,$db) or die ("Error while connecting");
	$usr_pass = $_POST['password'];
	$sql = "select Pasahitza from erabiltzaileak where eposta='$usr_mail' ";
	$sql1 = "select Egoera from erabiltzaileak where eposta='$usr_mail' ";
	$sql2 = "select Rola from erabiltzaileak where eposta='$usr_mail' ";
	
	$result = $niremysqli->query($sql);
	$pasa = mysqli_fetch_assoc($result);
	$pasahitzaDB = $pasa['Pasahitza'];
	
	//echo $pasahitzaDB;
	if(! ($result)) {echo 'Error in the query'. $result->error;}
		else{
			$rows_cnt = $result->num_rows;

			if (password_verify($usr_pass, $pasahitzaDB)) {
				
				
				$result1 = $niremysqli->query($sql1);
				$row = mysqli_fetch_assoc($result1);
				
				if (strcmp($row['Egoera'], "aktibo") == 0) {
					// eguneratu logeatu dauden erabiltzaileak
					$xml = simplexml_load_file('../xml/counter.xml');
					
					if ($xml === false) {
						echo "Errorea XML fitxategia kargatzerakoan\n";
						foreach(libxml_get_errors() as $error) {
							echo "\t", $error->message;
						}
					}else{
						$xml->kont[0] = $xml->kont[0] + 1;
						$xml->asXML('../xml/counter.xml');
					}

					// sesioa hasi
					$result2 = $niremysqli->query($sql2);
					$row2 = mysqli_fetch_assoc($result2);
					
					$_SESSION['eposta']=$usr_mail;
					$_SESSION['rola']=$row2['Rola'];
						
					if(strcmp($_SESSION['rola'], "ikaslea")==0){
						echo "<script> alert('Acces granted ikaslea')</script>";
						echo('<script>location.href="handlingQuizesAJAX.php" </script>');
					}else{
						echo "<script> alert('Acces granted admin')</script>";
						echo('<script>location.href="handlingAccounts.php" </script>');
					}
				}else{
					echo "<script> alert('Blokeatuta zaude logeatzeko')</script>";
				}
				
				
				
				
				
				
				
				
				
			}
			else{ echo "<script> alert('Autentifikazio errorea')</script>";}
		}
		$niremysqli->close();

}
?>