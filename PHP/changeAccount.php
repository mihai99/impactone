<?php
session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);
$name = $_POST["name"];
$nick = $_POST["nick"];
$age = $_POST["age"];
$city = $_POST["city"];
$games = $_POST["games"];

echo "<br>";


$res = mysqli_query($conn, "SELECT * FROM `users` WHERE id='" . $_COOKIE["idloggedon"] . "'");
	if (mysqli_num_rows($res) > 0) 
		while($row = mysqli_fetch_assoc($res)) 
			{if($name=="")	$name=$row["username"];
			if($nick=="")	$nick=$row["nickname"];
			if($age=="")	$age=$row["age"];
			if($city=="")	$city=$row["city"];
			if($games=="") $games=$row["recentplayed"];
			}
								
$sql="UPDATE users SET name='".$name."', nickname='".$nick."', age='".$age."', city='".$city."', recentplayed='".$games."' WHERE id=".$_COOKIE["idloggedon"];
echo $sql;
echo "<br>".gettype($sql);
if(mysqli_query( $conn, $sql)) echo "<script>alert('Account details updated')</script>";
 else echo "<script>alert('Account details update failed')</script>".mysql_error($conn);
							
			?>