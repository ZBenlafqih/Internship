<?php 
		require('constant.php');	

		
		$num_stagiaire = $_GET['num']; 

		
		
		$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
		$pdo->exec("set names utf8");
		$pdo->exec("SET CHARACTER SET utf8");		
		
		$fileName = $_FILES['fichier']['name'];
		$tmpName  = $_FILES['fichier']['tmp_name'];
		$fileSize = $_FILES['fichier']['size'];
		$fileType = $_FILES['fichier']['type'];

		$fp      = fopen($tmpName, 'r');
		$fichier = fread($fp, filesize($tmpName));
		$fichier = addslashes($fichier);
		fclose($fp);
		
		$sql1 = "UPDATE stagiaire SET rapport = '".$fichier."', rapport_type = '".$fileType."', rapport_name = '".$fileName."', rapport_size = '".$fileSize."' WHERE num_stagiaire= ".$num_stagiaire.";";
	
		$nb1 = $pdo->exec($sql1);

		echo "<center>Vous avez ajouté le rapport";
		header("Refresh: 1;URL=../stagiaireOld.php?page=".$_GET['page']);	
		print '<br><img src="../images/loading.gif" width="30px" height="30px"/> </center> ';				
		
?> 