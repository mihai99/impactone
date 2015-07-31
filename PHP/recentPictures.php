<?php
session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$txt="<div style='font-size:20px'>Recent Pictures:</div>";
$txt=$txt.	"<table >";
$res = mysqli_query($conn, "SELECT * FROM `" . $_COOKIE["idview"] . "_photos` ;") ;
$nrPictures=mysqli_num_rows($res);

if($nrPictures>6) $showPics=6; else  $showPics=$nrPictures;

$txt=$txt."<tr>";
for($i=1;$i<=$showPics;$i++)
	{$txt=$txt."<td>"; 
	$txt=$txt."<a href='#opeanRecentPicture".$i . "'  onclick=\"PostTop('#opeanRecentPicture".$i."')\" data-rel='popup' data-position-to='window' data-transition='fade'>";
	$res = mysqli_query($conn, "SELECT * FROM `" . $_COOKIE["idview"] . "_photos` WHERE id='". $i . "';") ;
	if (mysqli_num_rows($res) > 0) {
			while($row = mysqli_fetch_assoc($res)) {
				$photo= $row["photo"];		
		$txt=$txt.'<img src="profile'.$_COOKIE["idview"].'/'.$row["photo"].'">';				
		}
	}
	
$txt=$txt."</a></td>";
if($i==3) $txt=$txt."</tr><tr>";
}
$txt=$txt."</tr></table>";

$txt=$txt.'<a  style="padding-top: 0;padding-bottom: 0;margin-top: -7px;" href="#PhotosViewAll" data-rel="popup" data-position-to="window" data-transition="fade" class="ui-btn">View All Photos</a>';
echo $txt;
?>