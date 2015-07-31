<?php
function getComents($idProfile, $idPost)
{

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);


$res = mysqli_query($conn, "SELECT * FROM ".$idProfile."_".$idPost."_comments");
	if (mysqli_num_rows($res) > 0) 
		while($row = mysqli_fetch_assoc($res)) 
			{$res2 = mysqli_query($conn, "SELECT * FROM `users` WHERE id='" . $row["idpers"] . "'");
					if (mysqli_num_rows($res2) > 0) 
						while($row2 = mysqli_fetch_assoc($res2)) 
								{$Pic = $row2["profilePic"];
								$name =$row2["name"];
								}
			$comm = $row["comm"];	
			echo '<div id="comment"><img src="profile'.$row["idpers"].'/'.$Pic.'" style="width: 30px; height: 30px;">'.$name.':'.$comm.'</div>';						
								
			}

	
}




?>