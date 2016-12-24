<?php 
	require('verification/constant.php');
	session_start ();
	if (!isset($_SESSION['id']))
	{
		header("location:login.php?msg=3");
	}

	else $nbr_resultat = $_SESSION['selectS'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stagiaires</title>
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
						<li><a href="index.php">Accueil</a></li>
						<li><a href="stagiaire.php?page=<?php echo $_GET['page'];?>"  class="current">Stagiaires</a></li>
						<li><a href="encadrant.php?page=0">Encadrants</a></li>
						<li><a href="attestation.php?num=0">Attestation</a></li>
						<li><a href="transport.php?num=0">Transport</a></li>
						<li><a href="stagiaireOld.php?page=0">Anciens stagiaires</a></li>
					</ul> 
				</div>
            
        
		</div>
        
        
		<div class="center_content_pages">
				<br/><br/>
				<div> 
			
					<form method="post" autocomplete="off" action="verification/rech-stagiaire.php" style="display: inline-block; white-space:nowrap;">
						&emsp;&emsp; Rechercher un stagiaire :
						<input type="text" name="stagiaire"  id="keyword" list="datalist" style="background-color:#ffffff; border:1px #e2c7c8 solid;"/> 
						<!--img src="images/search.png" width="19px" height="19px" style="position:absolute; PADDING-LEFT: 5px;"/--> 
						<input type="image" value="submit" src="images/search.png"  width="19px" height="19px" style="PADDING-LEFT: 5px; position : absolute;"/>
						<div style="margin-left: 166px; border: 1px solid #c0c0c0; width:170px;" id="results"></div>
					</form>
					
			


					<form align="right"  method="post" action="verification/nb_page.php" style="display: inline-block; margin-left: 107px;">
					Nombre de stagiaires par page :
					
						<select name="selectednum"  style="height:19px; width:100px;">
						  <option value="3" <?php if($_SESSION['selectS']==3) echo "selected" ?>>3 Stagiares</option> 
						  <option value="5" <?php if($_SESSION['selectS']==5) echo "selected" ?>>5 Stagiares</option>
						  <option value="10" <?php if($_SESSION['selectS']==10) echo "selected" ?>>10 Stagiares</option>
						  <option value="20" <?php if($_SESSION['selectS']==20) echo "selected" ?>>20 Stagiares</option>
						</select>
						<input type="image" value="submit" src="images/go.png"  width="19px" height="19px" style="position:absolute; PADDING-LEFT: 5px;"/>
						&emsp;&emsp;&emsp;&emsp;&emsp;<a href="ajout_stagiaire.php?page=<?php echo $_GET['page']?>"> <img  align="right" src="images/addd.png" /> </a> 
					</form>
				
				</div>
				
				

				
<br/>

				<center>
					<div class="red_table" style="width:95%;">
					
					<?php
					
					$offset = $nbr_resultat * intval($_GET['page']);
					//connexion BDD mysql et affichage
						$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
						$pdo->exec("SET CHARACTER SET utf8");
						

						$sql = 'SELECT num_stagiaire, nom, prenom, num_stage FROM stagiaire where old = 0 order by num_stagiaire limit '.$offset.', '.$nbr_resultat.';';    
						$req = $pdo->query($sql);  
							echo "  <table > ";
							echo "<tr>";
								echo "<td> Nom </td>";
								echo "<td> Prenom </td>";
								echo "<td> Intitulé de stage </td>";
								echo "<td> Date de début </td>";
								echo "<td> Date de fin </td>";
								echo "<td> Plus de détails </td>";
							echo "</tr>";
							while($row = $req->fetch()) {
								$sql0 = 'SELECT intitule, date_debut, date_fin FROM stage where id_stage="'.$row['num_stage'].'"';
								$req0 = $pdo->query($sql0);
								$row0 = $req0->fetch();					
								echo "<tr>";
									echo "<td>".strtoupper($row['nom'])."</td>";
									echo "<td>".ucfirst($row['prenom'])."</td>";
									echo "<td>".$row0['intitule']."</td>";
									echo "<td>".$row0['date_debut']."</td>";
									echo "<td>".$row0['date_fin']."</td>";
									echo '<td> <center>';
										echo '<a href="?page='.$_GET['page'].'&num='.$row['num_stagiaire'].'#1">  <img src="images/info\'.png"  width="19px" height="19px" /></a>  &nbsp;&nbsp; ';
										echo '&emsp;';
										echo '<form method="post" action="modif_stagiaire.php?page='.$_GET['page'].'&num='.$row['num_stagiaire'].'" style="display: inline-block;">';
											echo '<input id="num_stagiaire" name="num_stagiaire" type="hidden" value="'.$row['num_stagiaire'].'" />';
											echo '<input type="image" value="submit" src="images/edit\'.png"  width="19px" height="19px" onClick="return confirm(\'Voulez vous vraiment modifier le stagiaire '.strtoupper($row['nom']).' '.ucfirst($row['prenom']).' ?\')";/>';
										echo '</form>';
										echo '&emsp;&emsp;';
										echo '<form method="post" action="verification/delete.php?page='.$_GET['page'].'&num='.$row['num_stagiaire'].'" style="display: inline-block;">';
											echo '<input id="num_stagiaire" name="num_stagiaire" type="hidden" value="'.$row['num_stagiaire'].'" />';
											echo '<input type="image" value="submit" src="images/delete\'.png"  width="19px" height="19px" onClick="return confirm(\'Voulez vous vraiment supprimer le stagiaire '.strtoupper($row['nom']).' '.ucfirst($row['prenom']).' ?\')";/>';
										echo '</form>';
										echo '&emsp;&emsp;';
										echo '<form method="post" action="verification/old.php?page='.$_GET['page'].'&num='.$row['num_stagiaire'].'" style="display: inline-block;">';
											echo '<input id="num_stagiaire" name="num_stagiaire" type="hidden" value="'.$row['num_stagiaire'].'" />';
											echo '<input type="image" value="submit" src="images/terminer.png"  width="19px" height="19px" onClick="return confirm(\'Voulez vous vraiment désigner le stagiaire '.strtoupper($row['nom']).' '.ucfirst($row['prenom']).' comme ancien stagiaire ?\')";/>';
										echo '</form>';
									echo '</center> </td>';
										
									echo "</tr>";
								$req0->closeCursor();
							}    
						echo "</table>";
						

					echo "</center>";

					echo "<div id='1' class='modalDialog'>";
						echo "<div>";
							echo "<a href='#close' title='Close' class='close'>X</a>";
							echo "<h2 align='center'>" ;
					$sql2 = 'SELECT nom, prenom, date_de_naissance, CIN, mail, num_formation, num_stage, num_encadrant FROM stagiaire where num_stagiaire="'.$_GET["num"].'"';
					$req2 = $pdo->query($sql2); 
					$row2 = $req2->fetch();
					$sql5 = 'SELECT intitule, date_debut, date_fin FROM stage where id_stage="'.$row2['num_stage'].'"';
					$sql3 = 'SELECT Etablissement, Filiere, Diplome, Annee FROM formation where id_formation="'.$row2['num_formation'].'"';
					$sql4 = 'SELECT Nom, Prenom, Dept FROM employee where num_emp="'.$row2['num_encadrant'].'"';
					$req3 = $pdo->query($sql3); 
					$row3 = $req3->fetch();
					$req4 = $pdo->query($sql4); 
					$row4 = $req4->fetch();
					$req5 = $pdo->query($sql5); 
					$row5 = $req5->fetch();
				echo strtoupper($row2['nom'])." ".ucfirst($row2['prenom']);
				echo "</h2>";
				echo "<p>Date de naissance : ".$row2['date_de_naissance']."</p>";
				echo "<p>CIN : ".$row2['CIN']."</p>";
				echo "<p>Email : ".$row2['mail']."</p>";
				echo "<p align='center'>----------------------------------------------------------------------------------------------------</p>";
				echo "<p>Etablissement : ".$row3['Etablissement']."</p>";
				
				echo "<p>Filière : ".$row3['Filiere']."</p>";
				echo "<p>Diplôme : ".$row3['Diplome']."</p>";
				echo "<p>Niveau : ";
				if($row3['Annee']==1) echo "Première année";
				if($row3['Annee']==2) echo "Deuxième année";
				if($row3['Annee']==3) echo "Toisième année";
				if($row3['Annee']==4) echo "Quatrième année";
				if($row3['Annee']==5) echo "Cinquième année";
				"</p>";
				
				echo "<p align='center'>----------------------------------------------------------------------------------------------------</p>";
				echo "<p>Intitulé de stage : ".$row5['intitule']."</p>";
				echo "<p>Date de debut : ".$row5['date_debut']."</p>";
				echo "<p>Date de fin : ".$row5['date_fin']."</p>";
				echo "<p align='center'>----------------------------------------------------------------------------------------------------</p>";
				echo "<p>Encadrant :".$row4['Nom']." ".$row4['Prenom']."</p>";
				echo "<p align='center'>----------------------------------------------------------------------------------------------------</p>";
				echo "<center>";
				echo '<form method="post" action="modif_stagiaire.php?page='.$_GET['page'].'&num='.$_GET["num"].'" style="display: inline-block;">';
					echo '<input id="num_stagiaire" name="num_stagiaire" type="hidden" value="'.$_GET["num"].'" />';
					echo '<input type="image" value="submit" src="images/edit.png" onClick="return confirm(\'Voulez vous vraiment modifier le stagiaire '.strtoupper($row2['nom']).' '.ucfirst($row2['prenom']).' ?\')";/>';
				echo '</form>';
				echo '&emsp;&emsp;';
				echo '<form method="post" action="verification/delete.php?page='.$_GET['page'].'&num='.$_GET["num"].'" style="display: inline-block;">';
					echo '<input id="num_stagiaire" name="num_stagiaire" type="hidden" value="'.$_GET["num"].'" />';
					echo '<input type="image" value="submit" src="images/delete.png" onClick="return confirm(\'Voulez vous vraiment supprimer le stagiaire '.strtoupper($row2['nom']).' '.ucfirst($row2['prenom']).' ?\')";/>';
				echo '</form>';
				echo "</center>";
				echo "</div>";
				echo "</div>";
						
				$sql6 = 'SELECT COUNT(*) as number FROM stagiaire where old = 0';
				$req6 = $pdo->query($sql6); 
				$row6 = $req6->fetch();

				$number = $row6['number']/$nbr_resultat;
				echo "</br><center><strong>";
				for($i=0;$i<$number;$i++){
					if($i == $_GET['page'])
						echo "<a class='pages' style='color: #ffffff; background-color: #B52025;'>".($i+1)."</a>";
					else
						echo "<a href='stagiaire.php?page=".$i."' class='pages'>".($i+1)."</a>";
				}
				echo "</strong></center>";


				
				$req2->closeCursor();
				$req3->closeCursor();
				$req4->closeCursor();
				$req5->closeCursor();
				$req6->closeCursor();
				?>	


			
			</div>
	   
			<br>
			<br>
			<br>
			
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
