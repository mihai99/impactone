<?php
$id= $_REQUEST["id"];

session_start();
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$ok=0;
$res = mysqli_query($conn, "SELECT * FROM `users` WHERE id='" . $id . "'");
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
    if($row["profilePic"]!="" && $row["coverPic"]=="") $ok=1;
	if($row["profilePic"]=="" && $row["coverPic"]!="") $ok=2;
	if($row["profilePic"]!="" && $row["coverPic"]!="") $ok=3;
	
    }
}
echo $ok;
mysqli_close($conn);

?>