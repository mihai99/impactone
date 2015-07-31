<?php

session_start();
require_once('getComents.php');
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$res = mysqli_query($conn, "SELECT * FROM `" . $_COOKIE["idview"] . "_photos` ;") ;
$nrPictures=mysqli_num_rows($res);
if($nrPictures>6) $showPics=6; else  $showPics=$nrPictures;

$res = mysqli_query($conn, "SELECT * FROM `users` WHERE id='" .  $_COOKIE["idview"] . "'");
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $pozaPostat=$row["profilePic"];
		 
    }
}
$res = mysqli_query($conn, "SELECT * FROM `users` WHERE id='" .  $_COOKIE["idloggedon"] . "'");
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $pozaVizitator=$row["profilePic"];
		 
    }
}
$txt="";
//document.getElementById("picturesPopUp").innerHTML=null;

for($i=1;$i<=$showPics;$i++)
{	
$res = mysqli_query($conn, "SELECT * FROM `" . $_COOKIE["idview"] . "_photos` WHERE id='". $i . "';") ;
	if (mysqli_num_rows($res) > 0) {
			while($row = mysqli_fetch_assoc($res)) {
				$photo= $row["photo"];		
				}
	}
	
$res = mysqli_query($conn, "SELECT * FROM `" . $_COOKIE["idview"] . "_posts` WHERE photo='". $photo . "';") ;
	if (mysqli_num_rows($res) > 0) {
			while($row = mysqli_fetch_assoc($res)) {
				$text= $row["text"];		
				$idpost= $row["id"];
				
				}
	}

echo "<div data-role='popup' id='opeanRecentPicture".$i . "' style='width:50%; position:fixed; z-index:10000000000000; top:10%; left:25%'>";

echo " <div data-role='main' class='ui-content'>";
echo "  <div id='opeanPostText' styvle='max-height:400px;'>";
if($text!=""){echo '<div id="TextOverPicture" style="max-height:400px;">';
echo $text.'</div>';}

echo " 	<img src='profile".$_COOKIE["idview"]."/" .$photo."' width='100%' style='max-height:400px;'>";

echo "	</div>";
echo 	"	<div id='comments' style='height:100px; overflow-y:scroll'>";
echo getComents($_COOKIE["idview"], $idpost);
echo 	"</div>";
$selfPicture="profile" . $_COOKIE["idloggedon"] ."/".$pozaVizitator;
echo "<div id='addComent'><img src=".$selfPicture . " style='width: 30px; height: 35px;position:absolute;'>";
echo			'<form action="PHP/uploadComment.php" target="opt" onsubmit="setCookie(\'post\', '.$idpost.');setTimeout(function () { window.location.reload(); }, 1)"  > ';

	echo			'<input style="margin-left:35px; id="comm-text-post"  name="comm-text-post" type="text" placeholder="Add a coment">';
	echo			'</form > ';
echo "     </div>      </div></div>";
//	document.getElementById("picturesPopUp").innerHTML+=txt;
}
//echo "<script>alert('".$txt."')</script>";




?>