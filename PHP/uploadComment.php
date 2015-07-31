<?php

session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);


$comm= $_REQUEST["comm-text-post"];
$post= $_COOKIE["post"];
$profPost = $_COOKIE["idview"];
$profComm = $_COOKIE["idloggedon"];
$table= $profPost."_".$post."_comments";
$id=0;

$res = mysqli_query($conn, "SELECT * FROM ".$table);
					if (mysqli_num_rows($res) > 0) 
						while($row2 = mysqli_fetch_assoc($res)) 
								$id = $row2["id"];							

$id++;
$sql="INSERT INTO ".$table."(`id`, `idpers`, `comm`) VALUES ('".$id."','".$profComm."','".$comm."')";
mysqli_query($conn, $sql);
if($_COOKIE['idview']!=$_COOKIE['idloggedon']){
$res = mysqli_query($conn, "SELECT * FROM ".$profPost."_notifications");
$id=mysqli_num_rows($res)+1;
$sql="INSERT INTO `".$profPost."_notifications`(`pers`, `mes`, `post`, `date`) VALUES ('".$profComm."','Added a comment to your post','p".$post."' , '".$id."')";
echo $sql;
if(mysqli_query($conn, $sql)) echo "ok"; else echo mysql_error();
}
?>