<?php 
	require('constant.php');	
	session_start(); // On démarre la session AVANT toute chose
?>
 
 <HTML>
 <HEAD>
 <TITLE>Redirection ...</TITLE>
 <BODY>

 <?php
 
$mail = $_POST['mail'];
$exist = 0;

		//connexion BDD mysql, verification si il est étudiant
			$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
			$sql = 'SELECT mail FROM admin';    
			$req = $pdo->query($sql);    
			while($row = $req->fetch()) {    
			if($row['mail'] == $mail)
				{ 
					$exist = 1;
					header("location:../login.php?msg=2");
				}
			}    
			$req->closeCursor();  
			
		
		if($exist == 0) {
			header("location:../pass.php?msg=1");
		}
	
	
	
?> 
 


 </BODY>
 </HTML>