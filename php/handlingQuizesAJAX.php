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
	<script language = "javascript">
		xhro = new XMLHttpRequest();
		xhro.onreadystatechange = function(){
			//alert(xhro.readyState);
			if ((xhro.readyState==4))
			{ document.getElementById("display").innerHTML= xhro.responseText;}
		}
		function datuakEskatu(){
			xhro.open("GET","showXMLMyQuestions.php?eposta=<?php echo $_GET['eposta']?>");
			xhro.send(null);
		}
		
		function datuakGehitu(){
			
			
			//falta da gehitzea datuak datu basean eta xml-an

			
			
						
			$('#display').load("showXMLMyQuestions.php?eposta=<?php echo $_GET['eposta']?>");
			
			

		}
		

		
	</script>
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
		<span><a href='/quizzes'>Quizzes</a></span>
		<span><a href='credits.php' id="cred">Credits</a></span>
		<span><a href='addQuestionwithImages.php' style="display:none;" id="addQ">Galdera gehitu</a></span> 
		<span><a href='showQuestionswithImages.php' style="display:none;" id="showQ">Galderak ikusi</a></span>
		<span><a href='../xml/questions.xml' style="display:none;" id="xmlQ">XML galderak</a></span>
		<span><a href='showXMLQuenstions.php' style="display:none;" id="xmlQP">XML galderak (PHP)</a></span>
		<span><a href='../xml/questionsTransAuto.xml' style="display:none;" id="xmlTA">XML transfAuto</a></span>
		<span><a href='handlingQuizesAJAX.php' style="display:none;" id="xmlHQ">handlingQuizesAJAX</a></span>
	</nav>
    <section class="main" id="s1">

	<div id="buttons">
		<input type="button" id="showB" name="showB" value="Show me my questions" onclick="datuakEskatu()" />
		<input type="button" id="addB" name="addB" value="Add question" onclick="datuakGehitu()" />
	</div>
	<fieldset>
	<form id="galdetegia" enctype="multipart/form-data">
	
				
				Eposta(*)<input id="eposta" name="eposta" type="text" pattern="[a-zA-Z]{3,}[0-9]{3}@ikasle.ehu.eus" title="pro000@ikasle.ehu.eus" size="25" placeholder="proba000@ikasle.ehu.eus" autofocus required /><br><br>
				Galdera(*)<input id="galdera" name="galdera" type="text" size="50" required /><br>
				Erantzun zuzena(*)<input id="zuzena" name="zuzena" type="text" size="25" required /><br>
				Erantzun okerra 1(*)<input id="okerra1" name="okerra1" type="text" size="25" required /><br>
				Erantzun okerra 2(*)<input id="okerra2" name="okerra2" type="text" size="25" required /><br>
				Erantzun okerra 3(*)<input id="okerra3" name="okerra3" type="text" size="25" required /><br><br>
				
				Zailtasuna(*)<input id="zailtasuna" name="zailtasuna" type="number" size="25" min="0" max="5" placeholder="0-5" required><br>
				Gaia(*)<input id="gaia" name="gaia" type="text" size="25" required /><br>
				Irudia<input id="irudia" name="irudia" type="file" accept="image/png, image/jpg, image/jpeg" /><br><br>
	</form>
</fieldset>
	
	
	
	
	<div id="display">
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

if (isset ($_GET['op'])){
	//logeatua dago
	if ($_GET['op'] == 'logeatua'){
		echo "<script> $('#login').css('display', 'none');</script>";
		echo "<script> $('#signup').css('display', 'none');</script>";
		echo "<script> $('#logout').css('display', 'block');</script>";

		
		echo "<script> $('#addQ').css('display', 'block');</script>";
		echo "<script> $('#showQ').css('display', 'block');</script>";
		echo "<script> $('#xmlQ').css('display', 'block');</script>";
		echo "<script> $('#xmlQP').css('display', 'block');</script>";
		echo "<script> $('#xmlTA').css('display', 'block');</script>";
		echo "<script> $('#xmlHQ').css('display', 'block');</script>";
		
		
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
		
		$xmlq = "showXMLQuenstions.php?op=logeatua&eposta=" . $eposta;
		$xmlq = strval($xmlq);
		echo "<script> $('#xmlQP').attr('href', '". $xmlq . "')</script>";	

						
		


		
		//<span class="right" id="login"><a href="./php/logIn.php">LogIn</a> </span>
		echo "<script> $('#logout').prepend('<span>".$eposta." <span>');</script>";
		
		$sql = "SELECT * FROM erabiltzaileak WHERE Eposta='$eposta'";
		$res = mysqli_query($niremysqli, $sql);
		$row = mysqli_fetch_assoc($res);
		$arg = $row['Argazkia'];	
		if($row['Argazkia']!="") echo "<script> $('#logout').prepend('<img src=".$arg." width=20 height=20 />');</script>";
	}
	else {if ($_GET['op'] == 'erreg'){
		echo "<script> $('#display').replaceWith('Ongi etorria! Ondo erregistratu zara.');</script>";
	}else{
		header ('location: layout.php?op=ezlogeatua' );
	}
	}
}
?>