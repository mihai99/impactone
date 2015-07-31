<?php
session_start();
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);
$res = mysqli_query($conn, "SELECT * FROM ".$_COOKIE['idview']."_friends ");
$id=mysqli_num_rows($res)+1; 
	$state=2;
$sql= "INSERT INTO `".$_COOKIE['idview']."_friends`(`id`, `idfriend`, `state`) VALUES( '".$id."' , '".$_COOKIE['idloggedon']."' , '".$state."')";
echo $sql."<br>";
if(mysqli_query($conn, $sql)) 
	echo "<script>alert('Friend request sent')</script>"; else echo mysqli_error($conn);
$res = mysqli_query($conn, "SELECT * FROM ".$_COOKIE['idview']."_notifications");
$id=mysqli_num_rows($res)+1;
$sql="INSERT INTO `".$_COOKIE['idview']."_notifications`(`pers`, `mes`, `post`, `date`) VALUES ('".$_COOKIE['idloggedon']."','Sent you a friend request','q' , '".$id."')";
echo $sql;
if(mysqli_query($conn, $sql)) echo "ok"; else echo mysql_error();

?>