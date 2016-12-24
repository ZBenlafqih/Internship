<?php 
		require('constant.php');	
		$name = $_POST['encadrant'];
		$nom = explode(" ", $name); //fonction pour séparer le nom et le prenom
		//connexion BDD mysql, verification si il est étudiant
			$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
			$sql = 'SELECT num_emp FROM employee where Nom = "'.$nom[0].'" and Prenom ="'.$nom[1].'"';    
			$req = $pdo->query($sql);    
			$row = $req->fetch();   
			header("location:../encadrant.php?num=".$row['num_stagiaire']."#1");
			$req->closeCursor();  
?> 
