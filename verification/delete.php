<?php 
		require('constant.php');	
		$num = $_POST['num_stagiaire'];
		// connexion BDD mysql, verification si il est étudiant
		$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
		$sql = 'SELECT nom, prenom, num_formation, num_stage FROM stagiaire where num_stagiaire = '.$num;  
		$req = $pdo->query($sql);    
		$row = $req->fetch(); 
		$nom = $row['nom'];
		$prenom = $row['prenom'];
		// echo $num." ".$row['num_stage']." ".$row['num_formation'];
		$sql ='DELETE from stagiaire WHERE num_stagiaire="'.$num.'"';
		$nb = $pdo->exec($sql);
		$sql ='DELETE from stage WHERE id_stage="'.$row['num_stage'].'"';
		$nb = $pdo->exec($sql);
		$sql ='DELETE from formation WHERE id_formation="'.$row['num_formation'].'"';
		$nb = $pdo->exec($sql);
		
		$req->closeCursor();

		echo "<center>vous avez supprimé le stagiaire ".strtoupper($nom)." ".ucfirst($prenom)." avec succès";
		header("Refresh: 1;URL=../stagiaire.php?page=".$_GET['page']);	
		print '<br><img src="../images/loading.gif" width="30px" height="30px"/> </center> ';	
		
?> 
