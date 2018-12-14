<?php

session_start();
//$_SESSION['erabiliak'];
// $_SESSION['erabiliak'] = [];

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
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      <span class="right" id="login"><a href="logIn.php">LogIn</a> </span>
	  <span class="right" id="signup"><a href="signUp.php">Sign Up</a> </span>
      <span class="right" id="logout" style="display:none;"><a href="logOut.php?op=logeatua">LogOut</a> </span>
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php' id="layout">Home</a></span>
		<span id="spanQuiz"><a href='quizzes.php'>Quizzes</a></span>
		<span><a href='credits.php' id="cred">Credits</a></span>
		<!-- 
		<span><a href='addQuestionwithImages.php' style="display:none;" id="addQ">Galdera gehitu</a></span> 
		<span><a href='showQuestionswithImages.php' style="display:none;" id="showQ">Galderak ikusi</a></span>
		<span><a href='../xml/questions.xml' style="display:none;" id="xmlQ">XML galderak</a></span>
		<span><a href='showXMLQuenstions.php' style="display:none;" id="xmlQP">XML galderak (PHP)</a></span>
		<span><a href='../xml/questionsTransAuto.xml' style="display:none;" id="xmlTA">XML transfAuto</a></span>
		<span><a href='handlingQuizesAJAX.php' style="display:none;" id="xmlHQ">handlingQuizesAJAX</a></span>
		<span><a href='bezeroGaldera.php' style="display:none;" id="bezGal">BezeroGaldera</a></span>
		-->
		<span id="span"></span>

		
	</nav>
    <section class="main" id="s1">
    
	
	<div id="display">
	Quizzes and credits will be displayed in this spot in future laboratories ...
	</div>
    </section>
	<footer class='main' id='f1'>
		 <a href='https://github.com/jokinmartxel/pro'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>

<?php 
include "dbConfig.php";
$niremysqli = new mysqli($zerbitzaria,$erabiltzailea,$gakoa,$db);



if (isset ($_SESSION['eposta'])){
	//logeatua dago
	
	echo "<script> $('#login').css('display', 'none');</script>";
	echo "<script> $('#signup').css('display', 'none');</script>";
	echo "<script> $('#logout').css('display', 'block');</script>";

	
	// echo "<script> $('#addQ').css('display', 'block');</script>";
	// echo "<script> $('#showQ').css('display', 'block');</script>";
	// echo "<script> $('#xmlQ').css('display', 'block');</script>";
	// echo "<script> $('#xmlQP').css('display', 'block');</script>";
	// echo "<script> $('#xmlTA').css('display', 'block');</script>";
	// echo "<script> $('#xmlHQ').css('display', 'block');</script>";
	
	
	$eposta = strval($_SESSION['eposta']);
	echo "<script> $('#eposta').attr('value', '" . $eposta . "');</script>";
	
	// $addq = "addQuestionwithImage.php";
	// $addq = strval($addq) ;
	// echo "<script> $('#addQ').attr('href', '". $addq . "')</script>";
	
	// $lay = "layout.php";
	// $lay = strval($lay);
	// echo "<script> $('#layout').attr('href', '". $lay . "')</script>";
	
	// $showq = "showQuestionswithImages.php";
	// $showq = strval($showq);
	// echo "<script> $('#showQ').attr('href', '". $showq . "')</script>";
	
	// $cred = "credits.php";
	// $cred = strval($cred);
	// echo "<script> $('#cred').attr('href', '". $cred . "')</script>";
	
	// $xmlq = "showXMLQuenstions.php";
	// $xmlq = strval($xmlq);
	// echo "<script> $('#xmlQP').attr('href', '". $xmlq . "')</script>";	

	
	//<span class="right" id="login"><a href="./php/logIn.php">LogIn</a> </span>
	echo "<script> $('#logout').prepend('<span>".$eposta." <span>');</script>";
	
	$sql = "SELECT * FROM erabiltzaileak WHERE Eposta='$eposta'";
	$res = mysqli_query($niremysqli, $sql);
	$row = mysqli_fetch_assoc($res);
	$arg = $row['Argazkia'];	
	if($row['Argazkia']!="") echo "<script> $('#logout').prepend('<img src=".$arg." width=20 height=20 />');</script>";
	
	
	if (strcmp($_SESSION['rola'], "admin")==0){
		$url = "handlingAccounts.php";
		echo "<script> $('#span').append('<a href=".$url.">Handling Accounts</a>'); </script>";
		echo "<script> $('#spanQuiz').remove(); </script>";
		
	}	
	if (strcmp($_SESSION['rola'], "ikaslea")==0){
		$url = "handlingQuizesAJAX.php";
		echo "<script> $('#span').append('<a href=".$url.">Handling Accounts</a>'); </script>";
		
		
		echo "<script> $('#spanQuiz').remove(); </script>";
		
		
		
	}
	
}

?>
