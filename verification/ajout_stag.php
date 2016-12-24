<?php 
		require('constant.php');
 
		session_start(); // On démarre la session
 
		$nom_stag = $_POST['nom_stag']; 
		$prenom_stag = $_POST['prenom_stag']; 
		$naiss = $_POST['naiss']; 
		$cin = $_POST['cin'];
		$mail = $_POST['mail'];
		$etablissement = $_POST['etablissement'];
		$filiere = $_POST['filiere'];
		$diplome = $_POST['diplome'];
		$annee = $_POST['annee'];
		$intitule_stage = $_POST['intitule_stage'];
		$date_debut = $_POST['date_debut'];
		$date_fin = $_POST['date_fin'];
		
		$encadrant = $_POST['encadrant'];
		$nom = explode(" ", $encadrant);
	
			
		//Remplir bdd MySql	

		
		$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
		//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec("set names utf8");
		$pdo->exec("SET CHARACTER SET utf8");
		// recuperation de l'id de l'encadrant
		$sql0 = 'SELECT num_emp FROM employee where Nom = "'.$nom[0].'" and Prenom ="'.$nom[1].'"';    
		$req0 = $pdo->query($sql0);    
		$row0 = $req0->fetch(); 

		
		//insertion de la formation et le stage
		$sql = "INSERT INTO formation(Etablissement,Filiere,Diplome,Annee)
				VALUES ('".$etablissement."','".$filiere."','".$diplome."',".$annee.");
				INSERT INTO stage(intitule, date_debut, date_fin)
				VALUES ('".$intitule_stage."','".$date_debut."','".$date_fin."');
				";
		$nb = $pdo->exec($sql);
		
		//recuperation du numero de stage
		$sql2 = 'SELECT id_stage FROM stage where intitule = "'.$intitule_stage.'" and date_debut = "'.$date_debut.'" and date_fin = "'.$date_fin.'"'; 
		$req2 = $pdo->query($sql2);
		$row2 = $req2->fetch();
		
		
		//recuperation du numero de formation
		$sql3 = 'SELECT id_formation FROM formation where Etablissement = "'.$etablissement.'" and Filiere = "'.$filiere.'" and Diplome = "'.$diplome.'"'; 
		$req3 = $pdo->query($sql3);
		$row3 = $req3->fetch();
		
		
		//insertion du stagiaire
		$sql4 = "INSERT INTO stagiaire(nom,prenom,date_de_naissance,CIN,mail,num_formation,num_stage,num_encadrant) 
				VALUES ('".$nom_stag."','".$prenom_stag."','".$naiss."','".$cin."','".$mail."','".$row2['id_stage']."','".$row3['id_formation']."','".$row0['num_emp']."');
				";
		$nb = $pdo->exec($sql4);
		$req2->closeCursor();
		$req3->closeCursor();
		
		echo "<center>Vous avez ajouté le stagiaire ".strtoupper($nom_stag)." ".ucfirst($prenom_stag)." avec succès";
		header("Refresh: 1;URL=../stagiaire.php?page=".$_POST['page']);	
		print '<br><img src="../images/loading.gif" width="30px" height="30px"/> </center> ';				
		
?> 