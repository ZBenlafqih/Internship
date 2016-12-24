<?php 
require('verification/constant.php');
 
session_start ();
if (!isset($_SESSION['id']))
{
	header("location:login.php?msg=3");
}
else $nbr_resultat = $_SESSION['selectE'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Encadrants</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/modal.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/table.css" media="screen" />
<script type="text/javascript" src="js/jquery.core.js"></script>
<script type="text/javascript" src="js/jquery.superfish.js"></script>
<script type="text/javascript" src="js/jquery.jcarousel.pack.js"></script>
<script type="text/javascript" src="js/jquery.easing.js"></script>
<script type="text/javascript" src="js/jquery.scripts.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/auto-complete-Encadrant.js"></script>
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
                    <li><a href="encadrant.php?page=0" class="current">Encadrants</a></li>
                    <li><a href="attestation.php?num=0">Attestation</a></li>
                    <li><a href="transport.php?num=0">Transport </a></li>
					<li><a href="stagiaireOld.php?page=0">Anciens stagiaires</a></li>
                </ul> 
            </div>
            
        
        </div>
        
        
        <div class="center_content_pages">
        
		
        
		<br/>
		<br/>

		
		
		
		<form method="post" autocomplete="off" action="verification/rech-encadrant.php" style="display: inline-block; white-space:nowrap;">
			&emsp;&emsp;Rechercher un encadrant :
			<input type="text" name="encadrant" id="keyword" list="datalist" style="background-color:#ffffff; border:1px #e2c7c8 solid;"/> 
			<!--img src="images/search.png" width="19px" height="19px" style="position:absolute; PADDING-LEFT: 5px;"/--> 
			<input type="image" value="submit" src="images/searchEnc.png"  width="19px" style="position:absolute; PADDING-LEFT: 5px;  ">
		</form>
		
		<form  method="post" action="verification/nb_page_enc.php" style="display: inline-block; margin-left: 275px;">
					Nombre d'encadrants par page :
					
						<select name="selectednum"  style="height:19px; width:110px;">
						  <option value="3" <?php if($_SESSION['selectE']==3) echo "selected" ?>>3 Encadrants</option> 
						  <option value="5" <?php if($_SESSION['selectE']==5) echo "selected" ?>>5 Encadrants</option>
						  <option value="10" <?php if($_SESSION['selectE']==10) echo "selected" ?>>10 Encadrants</option>
						  <option value="20" <?php if($_SESSION['selectE']==20) echo "selected" ?>>20 Encadrants</option>
						</select>
						<input type="image" value="submit" src="images/go.png"  width="19px" height="19px" style="position:absolute; PADDING-LEFT: 5px; white-space:nowrap;y"/>
						&emsp;&emsp;&emsp;&emsp;
					</form>
					 </br>
		<div style="margin-left: 171px; border: 1px solid #c0c0c0; width:170px;" id="results">
		</div> <br/> 
		 
		
		
		

	<center>
		<div class="red_table" style="width:95%;">
		<?php
		$offset = $nbr_resultat * intval($_GET['page']);
		//connexion BDD mysql et affichage
			$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
			$pdo->exec("set names utf8");
			$sql = 'SELECT num_emp, Nom, Prenom, Dept FROM employee where num_emp in (select distinct(num_encadrant) from stagiaire) order by num_emp limit '.$offset.', '.$nbr_resultat.';';  
			$req = $pdo->query($sql); 
				echo "  <table > ";
				echo "<tr>";
						echo "<td> &emsp; &emsp; Nom  &emsp; &emsp;</td>";
						echo "<td> &emsp; &emsp; Prenom  &emsp; &emsp;</td>";
						echo "<td> &emsp; &emsp; Département &emsp; &emsp; </td>";
						echo "<td> &emsp; &emsp; Liste des stagiaires &emsp; &emsp; </td>";
				echo "</tr>";
				while($row = $req->fetch()) {
					// $sql0 = 'SELECT intitule, date_debut, date_fin FROM stage where id_stage="'.$row['num_stage'].'"';
					// $req0 = $pdo->query($sql0);
					// $row0 = $req0->fetch();					
					echo "<tr>";
						echo "<td>".strtoupper($row['Nom'])."</td>";
						echo "<td>".ucfirst($row['Prenom'])."</td>";
						echo "<td>".$row['Dept']."</td>";
						echo '<td> <a href="?page='.$_GET['page'].'&num='.$row['num_emp'].'#1"> <center> <img src="images/info\'.png"  width="19px" height="19px" /></center> </a> </td>';
					echo "</tr>";
					// $req0->closeCursor();
				}    
			echo "</table>";
			

	echo "</center>";

	
		$sql6 = 'SELECT COUNT(distinct(num_encadrant)) as number FROM stagiaire';
		$req6 = $pdo->query($sql6); 
		$row6 = $req6->fetch();

		$number = $row6['number']/$nbr_resultat;
		echo "</br><center><strong>";
		for($i=0;$i<$number;$i++){
					if($i == $_GET['page'])
						echo "<a class='pages' style='color: #ffffff; background-color: #B52025;'>".($i+1)."</a>";
					else
						echo "<a href='encadrant.php?page=".$i."' class='pages'>".($i+1)."</a>";
		}
		echo "</strong></center>";
		
		
	
	
	
echo "<div id='1' class='modalDialog'>";
	echo "<div>";
		echo "<a href='#close' title='Close' class='close'>X</a>";
		echo "<h2 align='center'>" ;
			$sql2 = 'SELECT nom, prenom FROM stagiaire where num_encadrant="'.$_GET["num"].'"';
			$req2 = $pdo->query($sql2); 
			echo "<h2 align='center'>";
			echo "Liste des stagiaires </br>";
			echo "</h2>";
			echo "<p>";
			while($row2 = $req2->fetch()) {
					echo "<p> - ".strtoupper($row2['nom'])." ".ucfirst($row2['prenom'])."</p>"; 
			}
			echo "</p>";
		echo "</div>";






	$req->closeCursor();
	$req2->closeCursor();

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

    

</body>
</html>