<?php
session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);



$table= $_COOKIE["idviewevent"] . "_ev_persons";
$sql="SELECT `pers`, `status` FROM  `".$table."` WHERE pers=" . $_COOKIE["idloggedon"] . "";
//echo $sql;
$res = mysqli_query($conn, $sql);
	if (mysqli_num_rows($res) > 0) 
	{while($row = mysqli_fetch_assoc($res)) 
	echo $row["status"];
	}
	else 
		echo 3;	
			

							
			?>