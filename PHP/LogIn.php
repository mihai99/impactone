<?php
$user= $_GET["user"];
$pass= $_GET["pass"];
session_start();
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);


$res = mysqli_query($conn, "SELECT * FROM `users` WHERE username='" . $user . "' and "  . " password='". $pass . "'");
$id=0;
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $id=$row["id"];
		 
    }
}
echo $id;
mysqli_close($conn);

?>