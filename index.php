<?php 
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
<title>Page d'accueil</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<script type="text/javascript" src="js/jquery.core.js"></script>
<script type="text/javascript" src="js/jquery.superfish.js"></script>
<script type="text/javascript" src="js/jquery.jcarousel.pack.js"></script>
<script type="text/javascript" src="js/jquery.easing.js"></script>
<script type="text/javascript" src="js/jquery.scripts.js"></script>
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"/>
</head>

<body>
<div id="wrap">
	<div style="display: inline-block; margin-left: 680px;"> 
		<p> Bonjour M. <?php echo ucfirst($_SESSION['prenom'])." ".strtoupper($_SESSION['nom'])?> [ <a href="verification/logout.php" style="color: #B52025; text-decoration: none; font-weight: bold;">deconnexion</a> ] </p>
	</div>
    <div class="top_corner"></div>
    <div id="main_container">
    
        <div id="header">
            <div id="logo"><a href="index.php"><img src="images/logo.png" alt="" title="" border="0" /></a></div>
            
            <div id="nav-menu">
				<ul>                                                                                            
                    <li><a href="index.php" class="current"> Accueil</a></li>
                    <li><a href="stagiaire.php?page=0">Stagiaires</a></li>
                    <li><a href="encadrant.php?page=0">Encadrants</a></li>
                    <li><a href="attestation.php?num=0">Attestation</a></li>
                    <li><a href="transport.php?num=0">Transport</a></li>
					<li><a href="stagiaireOld.php?page=0">Anciens stagiaires</a></li>
                </ul> 
            </div>
            
        
        </div>
        
        
        <div class="middle_banner">               
           
<div class="featured_slider">
      	<!-- begin: sliding featured banner -->
         <div id="featured_border" class="jcarousel-container">
            <div id="featured_wrapper" class="jcarousel-clip">
               <ul id="featured_images" class="jcarousel-list">
                  <li><img src="images/slider_photo.jpg" width="965" height="280" alt="" /></li>

               </ul>
            </div>
            
            <ul id="featured_buttons" class="clear_fix">

            </ul>
         </div>
         <!-- end: sliding featured banner -->
</div>
          
        
        
        </div><!---------------------------------end of middle banner-------------------------------->
        
        
        <div class="center_content">

			        
         
        <div class="home_section_left">
            <img src="images/icon1.png" alt="" title="" class="home_section_icon" border="0">
                            
                <h2 class="home_title">Stagiaires</h2>
                <div class="home_subtitle">Ajout, Suppression et Modification </div>
    
                <div class="home_section_thumb">
                <img src="images/home_section_thumb1.jpg" alt="" title="" border="0">
                </div>
                <p><span>Gestion des stagiaires</span><br>
                Vous pouvez ajouter un nouveau stagiaire, modifier des informations sur des stagiaires existants ou les supprimer. 
                </p>
        <div class="clear"></div>
        </div>
        
        
        <div class="home_section_left">
            <img src="images/icon2.png" alt="" title="" class="home_section_icon" border="0">
                            
                <h2 class="home_title">Encadrants</h2>
                <div class="home_subtitle">Consultation</div>
    
                <div class="home_section_thumb">
                <img src="images/home_section_thumb2.jpg" alt="" title="" border="0">
                </div>
                <p><span>Consultation des encadrants</span><br>
                Vous pouvez dans cette zone consulter la liste de toutes les encadrants et ainsi la liste des stagiaires de chaque encadrant
                
                </p>
        <div class="clear"></div>
        </div>
        
        <div class="home_section_left">
            <img src="images/icon3.png" alt="" title="" class="home_section_icon" border="0">
                            
                <h2 class="home_title">Attestations</h2>
                <div class="home_subtitle">Modification et Téléchargement</div>
    
                <div class="home_section_thumb">
                <img src="images/home_section_thumb3.jpg" alt="" title="" border="0">
                </div>
                <p><span>Téléchargement des attestations</span><br>
                Une page pour les attestations des stages et une autre pour les autorisations du transport, générer l'attestation, modifier et imprimer.
                
                </p>
        <div class="clear"></div>
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
