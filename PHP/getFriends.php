<?php


session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);


$id= $_COOKIE["idloggedon"];
$table=$id."_friends";
$res = mysqli_query($conn, "SELECT * FROM ".$table." where state=1");
	if (mysqli_num_rows($res) > 0) 
	{$num=1;
	echo '<table style="   width: 100%; margin-top:20px">';
	echo '<tr>';
		while($row2 = mysqli_fetch_assoc($res)) 
		{$id2=$row2["idfriend"] ;
		$resa = mysqli_query($conn, "SELECT * FROM users where id=".$id2 );
				if (mysqli_num_rows($resa) > 0) 
					while($rowa = mysqli_fetch_assoc($resa))
						{$name=$rowa["name"];
						$pic = $rowa["profilePic"];
						}
			echo '<td><img src="profile'.$id2.'/'.$pic.'" width="100px" height="100px"><div id="name">'.$name.'</div></td>';
			if($num%2==0)
				echo '</tr><tr>';
			$num++;
		}	
	echo '</tr></table>	';

	}
	
		
		


?>