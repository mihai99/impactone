<?php
session_start();
$user= $_GET["user"];
$pass= $_GET["pass"];
$name= $_GET["nume"];
$age= $_GET["age"];
$nick= $_GET["nick"];
$city= $_GET["city"];
$games= $_GET["games"];
$email= $_GET["email"];

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$result = mysqli_query($conn, "SELECT * FROM `users` WHERE username= '".$user. "';") ;
if(mysqli_num_rows($result)==0){
	$res = mysqli_query($conn, "SELECT * FROM `users`;") ;
	$id=mysqli_num_rows($res);
	$id++;
	$pers = $id;
	$sql =" INSERT INTO `users` (`id`, `username`, `password`,`email`, `name`, `nickname`, `age`, `city`, `recentplayed`) 
			VALUES ('".$id."', '".$user."', '".$pass."', '".$email."', '".$name."', '".$nick."', '".$age."', '".$city."', '".$games."')";
	$res = mysqli_query($conn, $sql);
	if($res)  {
		$sql="CREATE TABLE ".$id."_posts
			(
			id int,
			text varchar(5000),
			photo varchar(255)
			)";			
	if( mysqli_query($conn, $sql)) echo "Acount Created, you can now Log in"; else echo "Error creating table: " . mysqli_error($conn);
	$sql="INSERT INTO `impact`.`".$id."_posts` (`id`, `text`, `photo`) VALUES ('1', '<h1> Created Impact Account!</h1>', NULL)";
	mysqli_query($conn, $sql);
$sql="CREATE TABLE ".$pers."_1_comments (
id INT ,
idpers VARCHAR(255) ,
comm VARCHAR(255)
)";

mysqli_query($conn, $sql);

$sql="CREATE TABLE ".$pers."_friends (
id INT ,
idfriend VARCHAR(255),
state INT 
)";
mysqli_query($conn, $sql);

$sql="CREATE TABLE ".$pers."_messages (
pers INT ,
state INT ,
mes VARCHAR(255) 
)";
mysqli_query($conn, $sql);


$sql="CREATE TABLE ".$pers."_notifications (
pers INT ,
mes VARCHAR(255), 
post  VARCHAR(255),
date INT
)";
mysqli_query($conn, $sql);

	$sql="CREATE TABLE ".$id."_photos
			(
			id int,
			photo varchar(255)
			)";	
	mysqli_query($conn, $sql);

	
	mkdir("profile" .$id);
	}	else echo "Username alredy taken";
	} 
	mysqli_close($conn);
?>