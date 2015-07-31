<?php
session_start();
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$id1= $_REQUEST["id"];
$id2= $_COOKIE["idloggedon"];
echo $id1. $id2;
$res1 = mysqli_query($conn, "SELECT * FROM `".$id1."_friends` " );
$num1 = mysqli_num_rows($res1);
$res2 = mysqli_query($conn, "SELECT * FROM `".$id2."_friends` " );
$num2 = mysqli_num_rows($res2);
$table=$id2."_friends";

$res = mysqli_query($conn, "DELETE FROM `".$table."` WHERE idfriend=" . $id1 );
echo "DELETE FROM `".$table."` WHERE idfriend=" . $id1;
if($res) echo "ok1"; else echo mysqli_erorr($conn);
$table= $id2."_friends";	
	
?>