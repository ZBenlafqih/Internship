

<?php 
require('constant.php');	
		$num = $_POST['num_stagiaire'];
		// connexion BDD mysql, verification si il est étudiant
		$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
		$sql = 'SELECT rapport, rapport_type, rapport_name,rapport_size FROM stagiaire where num_stagiaire = '.$num;  
		$req = $pdo->query($sql);    
		$row = $req->fetch(); 
		
		$type = $row['rapport_type'];
		$name = $row['rapport_name'];
		$size = $row['rapport_size'];
		
		header("Content-length: $size");
		header("Content-type: $type");
		header("Content-Disposition: attachment; filename=$name");
		echo $row['rapport'];
		exit;
?>