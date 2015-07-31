<?php
session_start();
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);
$res = mysqli_query($conn, "SELECT * FROM ".$_COOKIE['idloggedon']."_friends where state=2" );

	if (mysqli_num_rows($res) > 0) 
		{while($row = mysqli_fetch_assoc($res)) 
			$id= $row["idfriend"];
			$name="";
			$resa = mysqli_query($conn, "SELECT * FROM users where id=".$id );
				if (mysqli_num_rows($resa) > 0) 
					while($rowa = mysqli_fetch_assoc($resa))
						{$name=$rowa["name"];
						$pic = $rowa["profilePic"];
						}
		echo '<div id="friendReq" style="border: 2px solid;width: 99%; margin-top:20px">';
		echo'<img src="profile'.$id.'/'.$pic.'" width="100px" height="100px"><div id="nameReq">'.$name.'</div>';
		echo'<div data-role="navbar" style=" margin-left: 110px;  margin-top: -40px;">';
		echo'<ul>';
		echo'<li> <a class="ui-btn" href="" onclick="	
						$.ajax({
						\'async\': false,
						\'type\': \'POST\',
						\'global\': false,
						\'dataType\': \'html\',
						\'url\': \'PHP/addFriendAccept.php?\',
						\'data\': {\'id\' : '.$id.' },
						\'success\': function (data) {	
									alert(\'Friend Added\');
									location.reload();
													}	});					
				">Add Friend</a></li>';
		echo		'<li><a class="ui-btn" href=""  onclick="	
						$.ajax({
						\'async\': false,
						\'type\': \'POST\',
						\'global\': false,
						\'dataType\': \'html\',
						\'url\': \'PHP/addFriendDecline.php?\',
						\'data\': {\'id\' : '.$id.' },
						\'success\': function (data) {	
									alert(\'Friend Request Declined\');
									location.reload();
													}	});					
				">Decline Friend Request</a></li>';
		echo'</ul>';
		echo'</div>';
		echo'</div>';
		}		
	
	


?>