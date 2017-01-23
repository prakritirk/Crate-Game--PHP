<?php
	session_start();
	
	
		unset($_SESSION["uname"]);
	 session_destroy();
	echo 'Logged Off';
	header("Location:puzzlegame.php");
	exit;
       
?>
