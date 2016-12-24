
 <?php
		session_start ();
		$select = $_POST['selectednum'];  
		$_SESSION['selectS'] = $select;
		header("location:../stagiaireOld.php?page=0");
?> 
