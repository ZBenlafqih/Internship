<?php 
		require('constant.php');	

		
		$num_stagiaire = $_POST['num']; 
		$num_stage = $_POST['stage']; 
		$num_formation = $_POST['formation']; 
		$encadrant = $_POST['encadrant'];
		$nom = explode(" ", $encadrant);
		
		
		
		$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
		$pdo->exec("set names utf8");
		$pdo->exec("SET CHARACTER SET utf8");
		// recuperation de l'id de l'encadrant
		$sql0 = 'SELECT num_emp FROM employee where Nom = "'.$nom[0].'" and Prenom ="'.$nom[1].'"';    
		$req0 = $pdo->query($sql0);    
		$row0 = $req0->fetch(); 

		
		
		//Modification des tables
		
		$sql1 = "UPDATE stagiaire SET nom='".$_POST['nom_stag']."', prenom='".$_POST['prenom_stag']."',
				date_de_naissance='".$_POST['naiss']."', CIN='".$_POST['cin']."', mail='".$_POST['mail']."',
				num_encadrant=".$row0['num_emp']." WHERE num_stagiaire= ".$num_stagiaire.";";
				
		$sql2 = "UPDATE stage SET intitule='".$_POST['intitule_stage']."', date_debut='".$_POST['date_debut']."',
				date_fin='".$_POST['date_fin']."' WHERE id_stage= ".$num_stage.";";
				
		$sql3 = "UPDATE formation SET Etablissement='".$_POST['etablissement']."', Filiere='".$_POST['filiere']."',
				Diplome='".$_POST['diplome']."', Annee= ".$_POST['annee']." WHERE id_formation= ".$num_formation.";";
				
		$nb1 = $pdo->exec($sql1);
		$nb2 = $pdo->exec($sql2);
		$nb3 = $pdo->exec($sql3);
		
		$req0->closeCursor();
		
		
		echo "<center>Vous avez modifié le stagiaire ".strtoupper($_POST['nom_stag'])." ".ucfirst($_POST['prenom_stag'])." avec succès";
		header("Refresh: 1;URL=../stagiaire.php?page=".$_GET['page']);	
		print '<br><img src="../images/loading.gif" width="30px" height="30px"/> </center> ';				
		
?> 