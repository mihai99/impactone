<?php

session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$res = mysqli_query($conn, "SELECT * FROM `users`");
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $a[] = $row["name"];
		 
    }
}
$res = mysqli_query($conn, "SELECT * FROM `events`");
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $a[] = $row["name"];
		 
    }
}
$q = $_POST["id"];
$hint = "";
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
				$res = mysqli_query($conn, "SELECT * FROM `users` WHERE name='" . $name . "'");
					if (mysqli_num_rows($res) > 0) 
						while($row = mysqli_fetch_assoc($res)) 
								{$id = $row["id"];
								$p='profile';
								$a='<div id="person" onclick="setCookie(\'idview\', '.$id.');location.href=\'profile.php\';">';
								$profilePic = $row["profilePic"];
								$games = $row["recentplayed"];
								
								}
					else
					{$res = mysqli_query($conn, "SELECT * FROM `events` WHERE name='" . $name . "'");
					if (mysqli_num_rows($res) > 0) 
						while($row = mysqli_fetch_assoc($res)) 
								{$id = $row["id"];
								$p='event';
							
								$a='<div id="person" onclick="setCookie(\'idviewevent\', '.$id.');location.href=\'event.php\';">';
								$profilePic = $row["cover"];
								$games = "event";
								}
						
						
					}
			
				echo $a;
			
			echo '<div id="person-picture">';
							
			echo  '<img src="'.$p . $id. "/".$profilePic.'" width="100%" height="100%">';
			echo '</div>';
			echo '<div id="person-name">' .$name. '</div>';
			echo '<div id="person-games">'.$games.'</div>';
			echo '</div>';
		   
		   
        }
    }
}
?>
