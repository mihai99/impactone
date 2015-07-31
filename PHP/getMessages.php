<?php
session_start();
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);
echo '<div id="title-to">Messages:</div>';
$pers[]="";
$res = mysqli_query($conn, "SELECT * FROM ".$_COOKIE["idloggedon"]."_messages ");
if (mysqli_num_rows($res) > 0) 
while($row = mysqli_fetch_assoc($res)) 
	{if(!array_search($row["pers"],$pers))
		$pers[]=$row["pers"];	
	}	

for($i=1;$i<count($pers);$i++)
	{	
$res = mysqli_query($conn, "SELECT * FROM users where id=".$pers[$i]);
	if (mysqli_num_rows($res) > 0) 
		while($row = mysqli_fetch_assoc($res)) 
			{
			$pic=$row["profilePic"];
			$name=$row["name"];
			}
	$res = mysqli_query($conn, "SELECT * FROM ".$_COOKIE["idloggedon"]."_messages where pers=".$pers[$i]);
	if (mysqli_num_rows($res) > 0) 
		while($row = mysqli_fetch_assoc($res)) 
			{
			$mes=$row["mes"];
			}
	$click="AddConversation('".$name."')";
	echo '<div id="message" onclick="'.$click.'">';
	echo 	'<img src="profile'.$pers[$i].'/'.$pic.'" style="width: 50px; height: 40px; position: absolute;">';
	echo 	'<div id="sender">'. $name.'</div>';
	echo 	'<div id="text" style="margin-left: 55px;">'.$mes.'</div>';
	echo '</div>';
	
}


?>
