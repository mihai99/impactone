
<?php

session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$table= $_COOKIE["idloggedon"]."_friends" ;
$res = mysqli_query($conn, "SELECT * FROM `".$table."` WHERE state=1");
if (mysqli_num_rows($res) > 0) 
	while($row = mysqli_fetch_assoc($res)) 
		{$id=$row["idfriend"];
		$name="";
		$pic="";
			$res2 = mysqli_query($conn, "SELECT * FROM `users` WHERE id=".$id);
				if (mysqli_num_rows($res2) > 0) 
				while($row2 = mysqli_fetch_assoc($res2)) 
						{$name=$row2["name"];
						$pic=$row2["profilePic"];
						}
		echo "<div id='contact' onclick=\"AddConversation('" .$name.'\')">';
		echo "<div id='contact-picture'><img src='profile".$id. "/".$pic."' width='100%' height='100%'></div>";
		echo "<div id='contact-name'>" .$name. "</div>	</div>";
		}
?>