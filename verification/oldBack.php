<?php 
		require('constant.php');	

		
		$num_stagiaire = $_POST['num_stagiaire']; 

		
		
		$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
		$pdo->exec("set names utf8");
		$pdo->exec("SET CHARACTER SET utf8");		
		
		//Modification des tables
		
		$sql1 = "UPDATE stagiaire SET old = 0 WHERE num_stagiaire= ".$num_stagiaire.";";
	
		$nb1 = $pdo->exec($sql1);

		echo "<center>Vous avez designé le stagiaire comme ancien stagiaire";
		header("Refresh: 1;URL=../stagiaire.php?page=".$_GET['page']);	
		print '<br><img src="../images/loading.gif" width="30px" height="30px"/> </center> ';				
		
?> 