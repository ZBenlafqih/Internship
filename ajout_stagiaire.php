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
<title>Ajouter un stagiaire</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<script type="text/javascript" src="js/jquery.core.js"></script>
<script type="text/javascript" src="js/jquery.superfish.js"></script>
<script type="text/javascript" src="js/jquery.jcarousel.pack.js"></script>
<script type="text/javascript" src="js/jquery.easing.js"></script>
<script type="text/javascript" src="js/jquery.scripts.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/auto-complete.js"></script>
<link rel="stylesheet" type="text/css" href="css/autocomplete.css">
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
            
            <a href="make-a-donation.html" class="make_donation"></a>
            
            <div id="nav-menu">
				<ul>                                                                                            
                    <li><a href="index.php"> Accueil</a></li>
                    <li><a href="stagiaire.php?page=<?php echo $_GET['page'];?>" class="current">Stagiaires</a></li>
                    <li><a href="encadrant.php?page=0">Encadrants</a></li>
                    <li><a href="attestation.php?num=0">Attestation</a></li>
                    <li><a href="transport.php?num=0">Transport</a></li>
					<li><a href="stagiaireOld.php?page=0">Anciens stagiaires</a></li>
                </ul> 
            </div>
            
        
        </div>
        
        
        <div class="center_content_pages">
        
              <div class="financial-application-form">
             <center><h2>Ajouter un nouveau stagiaire</h2></center>
             
             <p></p>
				<form method="post" autocomplete="off" action="verification/ajout_stag.php" >
                <div class="form">
					<h2>
					Information sur le stagiaire :
					</h2>
                    <div class="form_row">
					
                    <label>Nom:</label>
                    <input type="text" name="nom_stag" class="main_input" />
                    </div>
                    
                    <div class="form_row">
                    <label>Prenom:</label>
                    <input type="text" name="prenom_stag" class="main_input" />
                    </div> 
                    
                    <div class="form_row">
                    <label>Date de naissance:</label>
                    <input type="date" name="naiss" class="main_input" />
                    </div> 
                    
                    <div class="form_row">
                    <label>CIN:</label>
                    <input type="text" name="cin" class="main_input" />
                    </div>  
                      
                    <div class="form_row">
                    <label>Email:</label>
                     <input type="email" name="mail" class="main_input" />
                    </div> 
                    
					<center> <img src="images/break.png" alt="" title="" border="0" /></center>
                      
					<h2>
						La formation :
					</h2>				  
					<div class="form_row">
					
                    <label>Etablissement:</label>
                    <input type="text" name="etablissement" class="main_input" />
                    </div>  
                      
                    <div class="form_row">
                    <label>Filière:</label>
                    <input type="text" name="filiere" class="main_input" />
                    </div> 
					
					<div class="form_row">
                    <label>Diplôme:</label>
                    <input type="text" name="diplome" class="main_input" />
                    </div>
					
					<div class="form_row">
                    <label>Niveau:</label>
                    <select name="annee">
					  <option value="1">Première année</option> 
					  <option value="2">Deuxième année</option>
					  <option value="3">Toisième année</option>
					  <option value="4">Quatrième année</option>
					  <option value="5">Cinquième année</option>
					</select>
                    </div>
					
					<center> <img src="images/break.png" alt="" title="" border="0" /></center>
					
					<h2>
						Le Stage :
					</h2>				  
					<div class="form_row">
					
                    <label>Intitulé de stage:</label>
                    <input type="text" name="intitule_stage" class="main_input" />
                    </div>  
                      
                    <div class="form_row">
                    <label>Date de debut:</label>
                    <input type="date" name="date_debut" class="main_input" />
                    </div> 
					
					<div class="form_row">
                    <label>Date de fin:</label>
                    <input type="date" name="date_fin" class="main_input" />
                    </div> 
					
					<center> <img src="images/break.png" alt="" title="" border="0" /></center>
					
					<h2>
						L'encadrant :
					</h2>				  
					
					<div >
                    <label>Le nom de l'employé:</label>
						
							<input type="text" name="encadrant" class="main_input"  id="keyword" list="datalist">
							<br/>
							&emsp; &emsp; &emsp; &emsp;<div style="margin-left: 115px;" id="results">
							</div>
                    </div>
					<br/>
					<br/>
					<center> <img src="images/break.png" alt="" title="" border="0" /></center>
                     
					 <input type="hidden" name="page" id="page" />
					 
                    <div class="form_row">
                     <input type="submit" name="" class="submit" value="&emsp;&emsp;Ajouter&emsp;&emsp;" />
                    </div>
					
					
                </div>
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
