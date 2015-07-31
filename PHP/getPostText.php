<?php
session_start();
$id= $_REQUEST["id"];
$prof= $_REQUEST["prof"];

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

;
$res = mysqli_query($conn, "SELECT * FROM `" . $prof . "_posts` WHERE id='" . $id ."';") ;
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
       echo $row["text"];		 
    }
}

?>