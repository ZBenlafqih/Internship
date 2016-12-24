<?php 
		require('constant.php');	
		$name = $_POST['stagiaire'];
		$nom = explode(" ", $name); //fonction pour séparer le nom et le prenom
		//connexion BDD mysql, verification si il est étudiant
			$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
			$pdo->exec("set names utf8");
			$pdo->exec("SET CHARACTER SET utf8");
			$sql = 'SELECT num_stagiaire FROM stagiaire where nom = "'.$nom[0].'" and prenom ="'.$nom[1].'"';    
			$req = $pdo->query($sql);    
			$row = $req->fetch();   
			header("location:../stagiaire.php?page=0&num=".$row['num_stagiaire']."#1");
			$req->closeCursor();  
?> 
