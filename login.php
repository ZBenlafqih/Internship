<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/structure.css">
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"/>
</head>

<body>

<br/><center> <img src="images/logo_RAM.png" > </center>

<form class="box login"  method="post" action="verification/login_verif.php">
	<fieldset class="boxBody">
			<?php
			if( isset($_GET['msg']) && $_GET['msg'] == 1) { 
					echo "<p align=center style='color:red'> Information de connexion incorrecte . Réessayer </p> ";
				}
			if( isset($_GET['msg']) && $_GET['msg'] == 2) { 
					echo "<p align=center style='color:red'> Vous recevez un email avec le nom d'utilisateur et le mot de passe associé </p> ";
				}
			if( isset($_GET['msg']) && $_GET['msg'] == 3) { 
					echo "<p align=center style='color:red'> Veuillez vous connecter d'abord ! </p> ";
				}
			if( isset($_GET['msg']) && $_GET['msg'] == 4) { 
					// email sent
					echo "<p align=center style='color:green'>Un message avec votre mot de passe vous a été envoyé dans la boite mail qui a été renseignée.</p> ";
				}
				?>
	  <label>Nom d'utilisateur ou email</label>
	  <input type="text" autocomplete="off"  name="user" class="main_input" placeholder="Username" required>
	  <label><a href="pass.php" class="rLink" tabindex="5">Mot de passe oublié&nbsp;?</a>Mot de passe</label>
	  <input type="password" autocomplete="off"  name="pass" class="main_input" required>
	</fieldset>
	<footer>
		<input type="submit" class="submit" value="Se connecter" tabindex="4">
	</footer>
</form>
<footer id="main">
  © 2015 Royal Air Maroc - Tous droits réservés
  </footer>
</body>
</html>
