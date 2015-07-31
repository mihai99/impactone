<?php
session_start();
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);
echo '<div id="title-to">Notifications:</div>';
$res = mysqli_query($conn, "SELECT * FROM ".$_COOKIE["idloggedon"]."_notifications ORDER BY date DESC");

if (mysqli_num_rows($res) > 0) 
while($row = mysqli_fetch_assoc($res)) 
	{$click="PostTop('#opeanPost".$row["post"]."');  ";
	$res2 = mysqli_query($conn, "SELECT * FROM users WHERE id=".$row["pers"]);
		if (mysqli_num_rows($res2) > 0) 
		while($row2 = mysqli_fetch_assoc($res2))
		{$name= $row2["name"];	
		$pic= $row2["profilePic"];	
		$string = $row["post"];
		$type=$string[0];
	
		if($_COOKIE['idview']==$_COOKIE['idloggedon'])
			{	if($type=="p")
					echo '<a href="#opeanPost'.substr($row["post"],1).'" onclick="'.$click.'" data-rel="popup" data-position-to="window" data-transition="fade" >';
				if($type=="f")
					echo '<a href="#Friends" onclick="'.$click.'" data-rel="popup" data-position-to="window" data-transition="fade" >';
				if($type=="e")
					echo '<a href="#" onclick="'.$click.';setCookie(\'idviewevent\', '.substr($row["post"],1).'); location.href=\'event.php\'" data-rel="popup" data-position-to="window" data-transition="fade" >';
				if($type=="q")
					echo '<a href="#Friends" onclick="'.$click.'" data-rel="popup" data-position-to="window" data-transition="fade" >';
				
			}
		if($type=="p")
			echo '<div id="message"><img src="profile'.$row["pers"].'/'.$pic.'" style="width: 50px; height: 40px; position: absolute;"><div id="sender">'. $name.'</div><div id="text" style="margin-left: 55px;">'.$row["mes"].'</div></div>';
		if($type=="f")
				echo '<div id="message"><img src="profile'.$row["pers"].'/'.$pic.'" style="width: 50px; height: 40px; position: absolute;"><div id="sender">'. $name.'</div><div id="text" style="margin-left: 55px;">Accepted your friend request</div></div>';
		if($type=="e")
				echo '<div id="message"><img src="profile'.$row["pers"].'/'.$pic.'" style="width: 50px; height: 40px; position: absolute;"><div id="sender">'. $name.'</div><div id="text" style="margin-left: 55px;">Added a comment to your event</div></div>';
		if($type=="q")
				echo '<div id="message"><img src="profile'.$row["pers"].'/'.$pic.'" style="width: 50px; height: 40px; position: absolute;"><div id="sender">'. $name.'</div><div id="text" style="margin-left: 55px;">Asked you to be friends</div></div>';
		
		if($_COOKIE['idview']==$_COOKIE['idloggedon'])
			echo '</a>';
		}
	}
?>