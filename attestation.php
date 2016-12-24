<?php 
	require('verification/constant.php');
	session_start ();
	if (!isset($_SESSION['id']))
	{
		header("location:login.php?msg=3");
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attestations</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/modal.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/table.css" media="screen" />

<script type="text/javascript" src="js/jquery.core.js"></script>
<script type="text/javascript" src="js/jquery.superfish.js"></script>
<script type="text/javascript" src="js/jquery.jcarousel.pack.js"></script>
<script type="text/javascript" src="js/jquery.easing.js"></script>
<script type="text/javascript" src="js/jquery.scripts.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/auto-complete-Stagiaire.js"></script>
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"/>

</head>

<body>
<div id="wrap">
	<div style="display: inline-block; margin-left: 680px;"> 
		<p> Bonjour M. <?php echo ucfirst($_SESSION['prenom'])." ".strtoupper($_SESSION['nom'])?> [ <a href="verification/logout.php" style="color: #B52025; text-decoration: none; font-weight: bold;">deconnexion</a> ] </p>
	</div>
    <div class="top_corner"></div>
    <div id="main_container">
    
        <div id="header" class="nothing">
            <div id="logo"><a href="index.php"><img src="images/logo.png" alt="" title="" border="0" /></a></div>
           
            <div id="nav-menu">
				<ul>                                                                                            
                    <li><a href="index.php"> Accueil</a></li>
                    <li><a href="stagiaire.php?page=0">Stagiaires</a></li>
                    <li><a href="encadrant.php?page=0">Encadrants</a></li>
                    <li><a href="attestation.php?num=0" class="current">Attestation</a></li>
                    <li><a href="transport.php?num=0">Transport</a></li>
					<li><a href="stagiaireOld.php?page=0">Anciens stagiaires</a></li>
                </ul> 
            </div>
            
        
        </div>
        
        
        <div class="center_content_pages">
        
		
        
		<br/>
		<br/>

		
		<div > 
		
		<form autocomplete="off" method="post" action="verification/rech-attestation.php">
			&emsp;&emsp;&emsp;&emsp; Rechercher un stagiaire :
			<input type="text" name="stagiaire" id="keyword" list="datalist" style=" border:1px #e2c7c8 solid;"/>
			<!--img src="images/search.png" width="19px" height="19px" style="position:absolute; PADDING-LEFT: 5px;"/--> 
			<input type="image" value="submit" src="images/search.png"  width="19px" height="19px" style="position:absolute; PADDING-LEFT: 5px;">
		</form>
		
		<div style="margin-left: 191px; border: 1px solid #c0c0c0; width:170px;" id="results">
		</div> <br/> <br/> 
		<div <?php if($_GET["num"]!=0) echo "hidden" ?> >
		<center>
			<h2>Exemple de l'attestation </h2>
			<img src="images/attestation_example.jpg" width="400px"  style="box-shadow: 1px 1px 12px #555;"/> 
		</center>
		</div>
		<center>
		<?php

		//connexion BDD mysql et affichage
			$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
			$sql2 = 'SELECT nom, prenom, date_de_naissance, CIN, mail, num_formation, num_stage, num_encadrant FROM stagiaire where num_stagiaire="'.$_GET["num"].'"';
			$req2 = $pdo->query($sql2); 
			$row2 = $req2->fetch();
			$sql5 = 'SELECT intitule, DATE_FORMAT(date_debut,"%d/%m/%Y") as date_debut, DATE_FORMAT(date_fin,"%d/%m/%Y") as date_fin FROM stage where id_stage="'.$row2['num_stage'].'"';
			$req5 = $pdo->query($sql5); 
			$row5 = $req5->fetch();
			$req2->closeCursor();
			$req5->closeCursor();
			setlocale(LC_ALL, 'fr-FR');
		?>	
<form method="post" action="verification/print.php" target="_blank" <?php if($_GET["num"]==0) echo "hidden" ?> >	
		<textarea name="area" style="width: 850px; height: 480px; outline: none; resize: none; overflow: hidden;" >
	
	
	
	
	Direction technique

                                                                                         Nouasser, le <?php echo utf8_encode(strftime('%d %B %Y')); ?>

																					
                                               ATTESTATION DE STAGE
											  

Nous soussignés, Compagnie Nationale de Transport Aérien Royal Air Maroc,
attestons que <?php echo strtoupper($row2['nom']);?> <?php echo  ucfirst($row2['prenom']);?>, a effectuer un stage du <?php echo $row5['date_debut']; ?>
 au <?php echo $row5['date_fin']; ?> au sein de la Direction Technique.

Cette attestation lui est délivrée pour servir et valoir ce que de droit.




                                                                                 M <?php echo strtoupper($_SESSION['prenom'])." ".ucfirst($_SESSION['nom'])?> 
                                                                                 HR Supervisor
                                                                                 Direction Technique
                    </textarea>
	</br>
	</br>
	<center><input type="image" value="submit" src="images/pdf-telech.png" TARGET=_BLANK width="70px" height="70px" ></center><br/><br/>
	</form>
		
		</div>

		
        <div class="clear"></div>
        </div>
        
        <div class="footer">
        	<div class="copyright">© 2015 Royal Air Maroc - Tous droits réservés</div>
        
        	<div class="footer_links">
               <?php include("includes/footer_admin.php"); ?>          
            </div>
        </div>
      
      
    
    </div>
</div>
</body>
</html>
