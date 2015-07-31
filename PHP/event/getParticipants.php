<?php
$id=  $_COOKIE["idviewevent"];

session_start();
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);
$table= $id.'_ev_persons';

$res = mysqli_query($conn, "SELECT * FROM `".$table."` WHERE status=1");
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
		
        $res2 = mysqli_query($conn, "SELECT * FROM `users` WHERE id=".$row["pers"]);
			if (mysqli_num_rows($res2) > 0) 
				while($row2 = mysqli_fetch_assoc($res2))
				{$name=$row2["name"];
				$idp=$row2["id"];
				$pic=$row2["profilePic"];
				}
		echo '<div id="part" onclick="setCookie(\'idview\', '.$row["pers"].');location.href=\'profile.php\';">';
		echo 	'<img src="profile'.$idp.'/'.$pic.'" style=" width: 50px;  height: 50px;  position: absolute;"> <div id="part-name">';
		echo 	$name;
		echo 	'</div>';
		echo '</div>';
    }
}

mysqli_close($conn);

?>