<?php
session_start();
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$pers[]="";
$res = mysqli_query($conn, "SELECT * FROM ".$_COOKIE["idloggedon"]."_messages ");
if (mysqli_num_rows($res) > 0) 
while($row = mysqli_fetch_assoc($res)) 
	{if(!array_search($row["pers"],$pers))
		$pers[]=$row["pers"];	
	}	

$res = mysqli_query($conn, "SELECT * FROM `users` WHERE id=".$_COOKIE["idloggedon"]);
				if (mysqli_num_rows($res) > 0) 
				while($row = mysqli_fetch_assoc($res)) 
						$selfname=$row["name"];
					
for($i=1;$i<count($pers);$i++)
	{	
$res = mysqli_query($conn, "SELECT * FROM users where id=".$pers[$i]);
	if (mysqli_num_rows($res) > 0) 
		while($row = mysqli_fetch_assoc($res)) 
			{
			$name=$row["name"];
			}
			echo  '<h3 style="height: 15px; padding-top: 0;">';
			echo $name;
			echo '</h3>';
			echo  '<div style="display: block; text-align:left;max-height: 200px;">';
			echo  '<p>';
	$res = mysqli_query($conn, "SELECT * FROM ".$_COOKIE["idloggedon"]."_messages where pers=".$pers[$i]);
	if (mysqli_num_rows($res) > 0) 
		while($row = mysqli_fetch_assoc($res)) 
			{		
			if($row["state"]==1)
				echo "<b>".$name."</b>:".$row["mes"]."<br>";
			else 
				echo  "<b>".$selfname."</b>:".$row["mes"]."<br>";
			}
	 $submit="setCookie('message',$pers[$i]);location.reload();";
echo			'<form action="PHP/SendMessage.php" method="POST" target="opt" onsubmit='.$submit.' >';
	echo			'<input  name="message-text"   type="text" placeholder="send message to '.$name.'">';
	echo		'</form>';
 echo "   </p>  </div>";
   
 

   
 
	
}


?>
