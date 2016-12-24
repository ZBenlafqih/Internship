<!DOCTYPE HTML>
<html>
<head>
<title>Retrouvez votre compte</title>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/structure.css">
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"/>
</head>

<body>

<br/><center> <img src="images/logo_RAM.png" > </center>

<form class="box login2"  method="post" action="verification/mail_verif.php">

	<fieldset class="boxBody">
		<center> <label>Retrouvez votre compte </label></center><br/>
		<?php
				if( isset($_GET['msg']) && $_GET['msg'] == 1) { 
					echo "<p align=center style='color:red'>Email introuvable. Réessayer </p> ";
				}
			?>	
		<label><a href="login.php" class="rLink" tabindex="5">Retour à la page de connexion</a>Entrer votre Email</label>
		<input type="email" autocomplete="off"  name="mail" class="main_input" placeholder="Email" required><br/><br/>
	</fieldset>
	
	<footer>
		<input type="submit" class="submit" value="Envoyer" tabindex="4"><br/><br/>
	</footer>
	
</form>
<footer id="main">
  © 2015 Royal Air Maroc - Tous droits réservés
  </footer>
</body>
</html>
