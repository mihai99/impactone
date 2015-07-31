

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

$res = mysqli_query($conn, "INSERT INTO `".$id1."_friends`(`id`, `idfriend`, `state`) VALUES ('".$num2."','".$id2."','1')" );
if($res) echo "ok1"; else echo mysqli_erorr($conn);
$table= $id2."_friends";
echo $table;
$sql = 'UPDATE '.$table." SET state=1 WHERE idfriend=".$id1;
$res = mysqli_query($conn,$sql);

if($res) echo "ok2"; else echo mysqli_erorr($conn);

$res = mysqli_query($conn, "SELECT * FROM ".$id1."_notifications");
$id=mysqli_num_rows($res)+1;
$sql="INSERT INTO `".$id1."_notifications`(`pers`, `mes`, `post`, `date`) VALUES ('".$id2."','Accepted your friend request','f' , '".$id."')";
echo $sql;
if(mysqli_query($conn, $sql)) echo "ok"; else echo mysql_error();
	//if (mysqli_num_rows($res) > 0) 
	//	while($row = mysqli_fetch_assoc($res)) 
			
				
	
	


?>