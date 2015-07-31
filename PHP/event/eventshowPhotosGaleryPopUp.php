<?php

session_start();
require_once('getComents.php');
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$res = mysqli_query($conn, "SELECT * FROM `" . $_COOKIE["idviewevent"] . "_ev_photos` ;") ;
$nrPhotos=mysqli_num_rows($res);


for($i=1;$i<=$nrPhotos;$i++){
	$res = mysqli_query($conn, "SELECT * FROM `" . $_COOKIE["idviewevent"] . "_ev_photos` WHERE id='". $i . "';") ;
			if (mysqli_num_rows($res) > 0) {
					while($row = mysqli_fetch_assoc($res)) {
						$photo= $row["photo"];		
						}
			}
	$res = mysqli_query($conn, "SELECT * FROM `" . $_COOKIE["idviewevent"]. "_ev_posts` WHERE photo='". $photo . "';") ;
			if (mysqli_num_rows($res) > 0) {
					while($row = mysqli_fetch_assoc($res)) {
						$text = $row["text"];		
						$idpost = $row["id"];
						}
			}
		$res = mysqli_query($conn, "SELECT * FROM `users` WHERE id='" . $_COOKIE["idloggedon"] . "'");
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $pozaVizitator=$row["profilePic"];
		 
    }
}
echo "<div id='Picture".$i."Show' class='pic'  style='width:50%;display:none; background:white; border-radius:10px; position:fixed; z-index:10000000000000; top:10%; left:25%'>";
echo 	"<div data-role='main' class='ui-content'>";
echo 	"<div id='opeanPostText' style='max-height:400px;'>";
if($text!="")	{echo 	'<div id="TextOverPicture" style="max-height:400px;">';
				 echo 	$text;
				echo 	'</div>';}
echo 	"<img src='event".$_COOKIE["idviewevent"]."/".$photo."' width='100%' style='max-height:400px;'>";
echo '</div>';
echo 	"<div id='comments' style='height:100px; overflow-y:scroll'>";
	echo getComents($_COOKIE["idviewevent"], $idpost);
echo 	"</div><div id='addComent'>";
echo 	"<img src='profile".$_COOKIE["idloggedon"]."/".$pozaVizitator."' style='width: 30px; height: 35px;position:absolute;'>";
echo			'<form action="PHP/event/eventuploadComment.php" target="opt" onsubmit="setCookie(\'post\', '.$idpost.');setTimeout(function () { window.location.reload(); }, 1)"  > ';

	echo			'<input style="margin-left:35px; id="comm-text-post"  name="comm-text-post" type="text" placeholder="Add a coment">';
echo			'</form > ';

echo '</div> </div></div>';
	}
	
?>