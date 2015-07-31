<?php
session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);
$email = $_POST["email"];
$user = $_POST["username"];
$pass = $_POST["password"];
echo $email .  " " . $user;
echo "<br>";

$res2 = mysqli_query($conn, "SELECT * FROM `users` WHERE username='" . $user . "' or email='".$email."'");
if(mysqli_num_rows($res2)!=0) echo "<script>alert('Username or Email alredy taken, please select another')</script>";
else
{$res = mysqli_query($conn, "SELECT * FROM `users` WHERE id='" . $_COOKIE["idloggedon"] . "'");
	if (mysqli_num_rows($res) > 0) 
		while($row = mysqli_fetch_assoc($res)) 
			{if($user=="")	$user=$row["username"];
			if($pass=="")	$pass=$row["password"];
			if($email=="")	$email=$row["email"];
			}
								
$sql="UPDATE users SET username='".$user."', password='".$pass."', email='".$email."' WHERE id=".$_COOKIE["idloggedon"];
echo $sql;
echo "<br>".gettype($sql);
if(mysqli_query( $conn, $sql)) echo "<script>alert('Account details updated')</script>";
 else echo "<script>alert('Account details update failed')</script>".mysql_error($conn);
}							
			?>