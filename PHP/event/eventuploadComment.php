<?php

session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);


$comm= $_REQUEST["comm-text-post"];
$post= $_COOKIE["post"];
$profPost = $_COOKIE["idviewevent"];
$profComm = $_COOKIE["idloggedon"];
$table= $profPost."_".$post."_ev_comments";
$id=0;

$res = mysqli_query($conn, "SELECT * FROM ".$table);
					if (mysqli_num_rows($res) > 0) 
						while($row2 = mysqli_fetch_assoc($res)) 
								$id = $row2["id"];	


$res = mysqli_query($conn, "SELECT * FROM events where id=" . $profPost);
					if (mysqli_num_rows($res) > 0) 
						while($row2 = mysqli_fetch_assoc($res)) 
								$id2 = $row2["own"];													

$id++;
$sql="INSERT INTO ".$table."(`id`, `idpers`, `comm`) VALUES ('".$id."','".$profComm."','".$comm."')";
mysqli_query($conn, $sql);
if($_COOKIE["idviewevent"]!=$_COOKIE['idloggedon']){
$res = mysqli_query($conn, "SELECT * FROM ".$id2."_notifications");
$id=mysqli_num_rows($res)+1;
$sql="INSERT INTO `".$id2."_notifications`(`pers`, `mes`, `post`, `date`) VALUES ('".$profComm."','Added a comment to your event post','e".$_COOKIE["idviewevent"]."' , '".$id."')";
echo "<script>alert('".$sql."')</script>";
if(mysqli_query($conn, $sql)) echo "ok"; else echo mysql_error();
}
?>