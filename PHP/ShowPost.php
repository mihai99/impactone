


<?php
$idPostat= $_COOKIE["idview"];
$idVizitator= $_COOKIE["idloggedon"];
$postare= $_POST["id"];
session_start();
require_once('getComents.php');
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$res = mysqli_query($conn, "SELECT * FROM `users` WHERE id='" . $idPostat . "'");
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $pozaPostat=$row["profilePic"];
		 
    }
}
$res = mysqli_query($conn, "SELECT * FROM `users` WHERE id='" . $idVizitator . "'");
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $pozaVizitator=$row["profilePic"];
		 
    }
}
$res = mysqli_query($conn, "SELECT * FROM `".$idPostat."_posts` WHERE id='" . $postare . "'");
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $poza=$row["photo"];
		$text=$row["text"];
		 
    }
}
echo '<div id="postholder">';
echo'<div id="post-imege-poster" >';
echo'<img src="profile'.$idPostat.'/'.$pozaPostat.'" width="100%" height="100%" style="border-top-left-radius: 20px;border-bottom-left-radius: 20px;">';
echo'</div>';
echo'	<div id="post" class="text1" style="">';
echo $text;
if($poza!="")echo "<img src='profile".$idPostat. "/" .$poza. "' width='100%'>";
echo '</div>';
			$href="#opeanPost" . $postare; $click="PostTop('#opeanPost".$postare."')";
echo '<a id="post-opean-button" href="'.$href.'" onclick="'.$click.'" data-rel="popup" data-position-to="window" data-transition="fade" class="ui-btn">View Post</a>';
echo '</div>';


echo	'<div data-role="popup" id="opeanPost'.$postare.'" style="width:50%;position:fixed; z-index:10000000000000; top:10%; left:25%">';
echo		'<div data-role="main" class="ui-content">';
echo		'<div id="opeanPostText" style="max-height:400px;">';
if($poza!="") echo		'<div id="TextOverPicture" style="max-height:400px;">';
echo				$text;
if($poza!="") echo			'</div>';
if($poza!="") echo				"<img src='profile".$idPostat. "/" .$poza. "' width='100%' style='max-height:400px;'>";
	echo	'</div>';
	echo	'<div id="comments" style="height:100px; overflow-y:scroll">';				
	echo getComents($idPostat, $postare);
	echo	'</div>';
	echo	'<div id="addComent"><img src="profile'.$idVizitator.'/'.$pozaVizitator.'" style="width: 30px; height: 35px;position:absolute;">';
	echo			'<form action="PHP/uploadComment.php" target="opt" onsubmit="setCookie(\'post\', '.$postare.');setTimeout(function () { window.location.reload(); }, 1)"  > ';

	echo			'<input style="margin-left:35px; id="comm-text-post"  name="comm-text-post" type="text" placeholder="Add a coment">';
	echo			'</form > ';
echo		'</div>  ';
echo	'</div>	';
echo '</div>';

mysqli_close($conn);

?>