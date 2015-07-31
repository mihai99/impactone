<?php
session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);






$res = mysqli_query($conn, "SELECT * FROM `events` WHERE id='" . $_COOKIE["idviewevent"] . "'");
	if (mysqli_num_rows($res) > 0) 
		while($row = mysqli_fetch_assoc($res)) 
			echo $row["own"];
			
			
			

							
			?>