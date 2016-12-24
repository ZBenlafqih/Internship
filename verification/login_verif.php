
 <HTML>
 <HEAD>
 <TITLE>Redirection ...</TITLE>
 <BODY>

<?php 
		require('constant.php');	

 
$user = $_POST['user']; 
$pass = $_POST['pass'];
$exist = 0;

		//connexion BDD mysql, verification si il est étudiant
			$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
			$sql = 'SELECT id_admin, user, pass, nom, prenom, mail FROM admin';    
			$req = $pdo->query($sql);    
			while($row = $req->fetch()) {    
			if(($row['user'] == $user || $row['mail'] == $user) && $row['pass'] == $pass)
				{ 
					$exist = 1;
					session_start ();
					$_SESSION['nom'] = $row['nom'];
					$_SESSION['prenom'] = $row['prenom'];
					$_SESSION['id'] = $row['id_admin'];
					$_SESSION['selectS'] = 5;
					$_SESSION['selectOS'] = 5;
					$_SESSION['selectE'] = 3;
					header("location:../index.php");
				}
			}    
			$req->closeCursor();  
			
		
		if($exist == 0) {
			header("location:../login.php?msg=1");
		}
	
	
	
?> 
 


 </BODY>
 </HTML>