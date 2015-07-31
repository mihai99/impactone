
			<?php
session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);



$opt= $_REQUEST['option'];

$table= $_COOKIE["idviewevent"] . "_ev_persons";
$res = mysqli_query($conn, "SELECT * FROM ".$table." WHERE pers='" . $_COOKIE["idloggedon"] . "'");
	if (mysqli_num_rows($res) > 0) 
		{$sql2="UPDATE `".$table."` SET `status`=".$opt." WHERE pers='" . $_COOKIE["idloggedon"] . "'";
		mysqli_query($conn, $sql2);
		}
	else
	{	
		$sql2="INSERT INTO `".$table."`(`pers`, `status`) VALUES ('". $_COOKIE["idloggedon"] ."','".$opt."')";
		mysqli_query($conn, $sql2);
	}
			

							
			?>