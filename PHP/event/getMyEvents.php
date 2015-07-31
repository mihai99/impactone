<?php
$id=  $_COOKIE["idloggedon"];

session_start();
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$res = mysqli_query($conn, "SELECT * FROM `events` WHERE own=".$id);
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {

	echo '<div id="event-to" style=" height: 50px;text-align: left; border: 2px solid black;" onclick="setCookie(\'idviewevent\', '.$row["id"].'); location.href=\'event.php\'">';
	echo '<img src="event'.$row["id"].'/'.$row["cover"].'" style="position: absolute; height: 50px; width: 50px;">';
	echo	'<div id="event-name" style="margin-left: 100px; margin-top: 10px;">';
	echo	$row["name"];
	echo	'</div>';
	echo '</div>';
    }
}

mysqli_close($conn);

?>