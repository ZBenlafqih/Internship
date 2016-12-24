
 <?php
		session_start ();
		$select = $_POST['selectednum'];  
		$_SESSION['selectS'] = $select;
		header("location:../stagiaire.php?page=0");
?> 
