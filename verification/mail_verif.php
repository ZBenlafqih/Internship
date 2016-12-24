<?php 
	require('constant.php');	

	$pdo = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
	$sql1 = 'SELECT id_admin FROM admin where mail = "'.$_POST['mail'].'"';    
	$req1 = $pdo->query($sql1);    
	$row1 = $req1->fetch(); 
	 
	if (isset($row1['id_admin']))
	{
	 
		$sql2 = 'SELECT user, pass, nom, prenom FROM admin WHERE id_admin='.$row1['id_admin'];    
		$req2 = $pdo->query($sql2);    
		$row2 = $req2->fetch();
		$user = $row2['user'];
		$pass = $row2['pass'];
		$nom = $row2['nom'];
		$prenom = $row2['prenom'];
		$req1->closeCursor(); 
		$req2->closeCursor();  
	
		date_default_timezone_set('Etc/UTC');

		require '_libphp/PHPMailerAutoload.php';

		//Create a new PHPMailer instance
		$mail = new PHPMailer;

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 2;

		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6

		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;

		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';

		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "recuperation.ram@gmail.com";

		//Password to use for SMTP authentication
		$mail->Password = "ram123pass";




		$mail->CharSet = 'UTF-8';
		//Set who the message is to be sent from
		$mail->setFrom('recuperation.fake@gmail.com', 'Gestion des stagiaires');

		//Set who the message is to be sent to
		$mail->addAddress($_POST['mail'], strtoupper($nom).' '.ucfirst($prenom));

		//Set the subject line
		$mail->Subject = 'Récuperation de mot de passe';

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body

		$body = "Bonjour M. ".strtoupper($nom)." ".ucfirst($prenom).",<br>
		<br>Vous avez demandé la récuperation de votre mot de passe pour l'accès à l'interface de gestion des stagiaire de la Royal Air Maroc.
		<br>
		<br>Username : ".$user."<br>
		Password : ".$pass."<br>
		<br>
		Merci pour votre utilisation.<br>";
			

		$mail->MsgHTML($body);

		//Replace the plain text body with one created manually
		$mail->AltBody = 'This is a plain-text message body';

		//send the message, check for errors
		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			header("location:../login.php?msg=4");
		}
	}
	else{
		header("location:../pass.php?msg=1");
	}

