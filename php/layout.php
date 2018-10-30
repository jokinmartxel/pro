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
      <span class="right" id="logout" style="display:none;"><a href="logout.php?op=logeatua">LogOut</a> </span>
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php' id="layout">Home</a></span>
		<span><a href='/quizzes'>Quizzes</a></span>
		<span><a href='credits.php' id="cred">Credits</a></span>
		<span><a href='addQuestionwithImages.php' style="display:none;" id="addQ">Galdera gehitu</a></span> 
		<span><a href='showQuestionswithImages.php' style="display:none;" id="showQ">Galderak ikusi</a></span>
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
if (isset ($_GET['op'])){
	//logeatua dago
	if ($_GET['op'] == 'logeatua'){
		echo "<script> $('#login').css('display', 'none');</script>";
		echo "<script> $('#signup').css('display', 'none');</script>";
		echo "<script> $('#logout').css('display', 'block');</script>";
		echo "<script> $('#display').replaceWith('Ongi etorria! Logeatuta zaude.');</script>";
		
		echo "<script> $('#addQ').css('display', 'block');</script>";
		echo "<script> $('#showQ').css('display', 'block');</script>";
		
		$eposta = strval($_GET['eposta']);

		$addq = "addQuestionwithImage.php?op=logeatua&eposta=" . $eposta;
		$addq = strval($addq) ;
		echo "<script> $('#addQ').attr('href', '". $addq . "')</script>";
		
		$lay = "layout.php?op=logeatua&eposta=" . $eposta;
		$lay = strval($lay);
		echo "<script> $('#layout').attr('href', '". $lay . "')</script>";
		
		$showq = "showQuestionswithImages.php?op=logeatua&eposta=" . $eposta;
		$showq = strval($showq);
		echo "<script> $('#showQ').attr('href', '". $showq . "')</script>";
		
		$cred = "credits.php?op=logeatua&eposta=" . $eposta;
		$cred = strval($cred);
		echo "<script> $('#cred').attr('href', '". $cred . "')</script>";
		
		//<span class="right" id="login"><a href="./php/logIn.php">LogIn</a> </span>
		echo "<script> $('#login').before('<span>".$eposta."<span>');</script>";
		
		
	}
	else {if ($_GET['op'] == 'erreg'){
		echo "<script> $('#display').replaceWith('Ongi etorria! Ondo erregistratu zara.');</script>";
	}else{
		header ('location: layout.php?op=ezlogeatua' );
	}
	}
}
?>
