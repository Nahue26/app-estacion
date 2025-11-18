<?php 


	$pass = "Duende";


	echo "Con password_hash<br>";
	echo password_hash($pass, PASSWORD_DEFAULT)."<br>";
	echo "Con md5<br>";
	echo md5($pass);

 ?>