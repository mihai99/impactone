<?php
$id=  $_COOKIE["idloggedon"];

session_start();
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$res = mysqli_query($conn, "SELECT * FROM `events`");
$num = mysqli_num_rows($res);
for($i=1;$i<=$num;$i++)
{
$table= $i . "_ev_persons";
$res = mysqli_query($conn, "SELECT * FROM `".$table."` where pers=".$id." and status=1");
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
			$res2 = mysqli_query($conn, "SELECT * FROM `events` where id=".$i);
				if (mysqli_num_rows($res2) > 0) 
					while($row2 = mysqli_fetch_assoc($res2)) {
							echo '<div id="event-to" style=" height: 50px;text-align: left; border: 2px solid black;" onclick="setCookie(\'idviewevent\', '.$row2["id"].'); location.href=\'event.php\'">';
							echo '<img src="event'.$row2["id"].'/'.$row2["cover"].'" style="position: absolute; height: 50px; width: 50px;">';
							echo	'<div id="event-name" style="margin-left: 100px; margin-top: 10px;">';
							echo	$row2["name"];
							echo	'</div>';
							echo '</div>';
					}
    }
}
	
	
}

mysqli_close($conn);

?>