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
    
	<h2>Pasahitza errekuperatu</h2>
	<div>
	<fieldset>
		<legend>Pasahitza errekuperatzeko panela: </legend>
			<form id="pasaErrek" method="post" action="pasahitzaGaldera.php">
						Eposta: <input id="eposta" name="eposta" type="text" size="25" placeholder="proba000@ikasle.ehu.eus" autofocus required /><br><br>
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
