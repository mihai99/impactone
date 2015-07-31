<?php
session_start();
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);
$res = mysqli_query($conn, "SELECT * FROM ".$_COOKIE['idview']."_friends WHERE idfriend=".$_COOKIE["idloggedon"]);
	if (mysqli_num_rows($res) > 0) 
		{while($row = mysqli_fetch_assoc($res)) 
			$s=$row["state"];	
		if($s==2) echo 2;
		else if($s==1) echo 1;
		}		
	else echo 0;



?>