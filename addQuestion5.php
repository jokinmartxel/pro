<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>addQuestion 5</title>
	    <link rel='stylesheet' type='text/css' href='styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='styles/smartphone.css' />
		   
	<style type="text/css">
			fieldset {padding: 10px;}
			body {margin: 10px;}
	</style>

	
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
    <script>
            $(document).ready(function(){

				$("#galdetegia").submit(function(){
					
					//galdera
					var galdera = $("#galdera").val().trim();
					galdera = galdera.replace(/\s+ /gi, " ");

					if (galdera.length < 10){
						alert("Galderak 9 karaktere baino gehiago izan behar ditu");
						return false;
					}
										
                });
			
				
				function irudiaBistaratu(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();
						reader.readAsDataURL(input.files[0]);
						reader.onload = function (e) {
							$('#gehiIrudi').remove();
							$('#galdetegia').append('<img id ="gehiIrudi" style="margin: 10px" src="'+e.target.result+'"/>');
							}
					}
				}
	
				$("#irudia").change(function () {
					irudiaBistaratu(this);
				});

				$("#reset").click(function(){
					$('#gehiIrudi').remove();
				});		
			
			});
			
	</script>
  </head>
  <body>
  
<fieldset>
	<form id="galdetegia" method="post" action="php/addQuestionwithImage.php" enctype="multipart/form-data">
	
		
				Eposta(*)<input id="eposta" name="eposta" type="text" pattern="[a-zA-Z]{3,}[0-9]{3}@ikasle.ehu.eus" title="pro000@ikasle.ehu.eus" size="25" placeholder="proba000@ikasle.ehu.eus" autofocus required /><br><br>
				Galdera(*)<input id="galdera" name="galdera" type="text" size="50" required /><br>
				Erantzun zuzena(*)<input id="zuzena" name="zuzena" type="text" size="25" required /><br>
				Erantzun okerra 1(*)<input id="okerra1" name="okerra1" type="text" size="25" required /><br>
				Erantzun okerra 2(*)<input id="okerra2" name="okerra2" type="text" size="25" required /><br>
				Erantzun okerra 3(*)<input id="okerra3" name="okerra3" type="text" size="25" required /><br><br>
				
				Zailtasuna(*)<input id="zailtasuna" name="zailtasuna" type="number" size="25" min="0" max="5" placeholder="0-5" required><br>
				Gaia(*)<input id="gaia" name="gaia" type="text" size="25" required /><br>
				Irudia<input id="irudia" name="irudia" type="file" accept="image/png, image/jpg, image/jpeg" /><br><br>
				<input name="submit" type="submit" id="submit" value="Submit"/>
				<input name="reset" type="reset" id="reset" value="Reset"/><br>
	</form>
</fieldset>
<a href="layout.php" id="home">HOME</a>
</body>
</html>

<?php 
if (isset ($_GET['op'])){
	//logeatua dago
	if ($_GET['op'] == 'logeatua'){
		//echo "<script> $('#login').css('display', 'none');</script>";
		//echo "<script> $('#signup').css('display', 'none');</script>";
		//echo "<script> $('#logout').css('display', 'block');</script>";
		//echo "<script> $('#display').replaceWith('Ongi etorria! Logeatuta zaude.');</script>";
		
		//echo "<script> $('#addQ').css('display', 'block');</script>";
		//echo "<script> $('#showQ').css('display', 'block');</script>";
		//echo "<script> $( '.main' ).append( '<span id='addQ'> </span>' );</script>";
		 
		//echo "<script> $('.main').append('<span><a href='showQuestionWithImage.php'>Galdera ikusi</a></span>');</script>";
		//echo "<script> $('#n1').append('<span class='label label-important'>' + 'kaixo' + '</span>);</script>";
		//echo "<script> $('#n1').append('<span><a href='showQuestionWithImage.php'>Galdera ikusi</a></span>');</script>";
		$eposta = $_GET['eposta'];
		$eposta = strval($eposta);
		echo "<script> $('#eposta').attr('value', '" . $eposta . "');</script>";
		
		$lay = "layout.php?op=logeatua&eposta=" . $eposta;
		$lay = strval($lay);
		echo "<script> $('#home').attr('href', '". $lay . "')</script>";
		
		//echo $eposta;
		//echo "<script> $('#eposta').attr('value', '" . "kaixo" . "');</script>";
		//echo "<script> $('#eposta').attr('value', $emaila);</script>";
	}
}
?>