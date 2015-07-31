<?php
session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);
$name = $_POST["name"];
$loc = $_POST["location"];
$date = $_POST["date"];
$about = $_POST["about"];


echo "<br>";


$res = mysqli_query($conn, "SELECT * FROM `events` WHERE id='" . $_COOKIE["idviewevent"] . "'");
	if (mysqli_num_rows($res) > 0) 
		while($row = mysqli_fetch_assoc($res)) 
			{if($name=="")	$name=$row["name"];
			if($loc=="")	$loc=$row["location"];
			if($date=="")	$date=$row["date"];
			if($about=="")	$about=$row["about"];
			
			}
								
$sql="UPDATE events SET name='".$name."', location='".$loc."', date='".$date."', about='".$about."' WHERE id=".$_COOKIE["idviewevent"];
echo $sql;
echo "<br>".gettype($sql);
if(mysqli_query( $conn, $sql)) echo "<script>alert('Account details updated')</script>";
 else echo "<script>alert('Account details update failed')</script>".mysql_error($conn);
							
			?>