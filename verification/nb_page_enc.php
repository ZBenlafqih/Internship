
 <?php
		session_start ();
		$select = $_POST['selectednum'];  
		$_SESSION['selectE'] = $select;
		header("location:../encadrant.php?page=0");
?> 
