<?php

session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$res = mysqli_query($conn, "SELECT * FROM `" . $_COOKIE["idview"] . "_photos` ;") ;
$nrPhotos=mysqli_num_rows($res);

echo " <div data-role='main' class='ui-content' style='width: 100%;'>";
for($i=1;$i<=$nrPhotos;$i++){
	echo	" <a id='imageOpeanPopUp' onclick=\"$('#PhotosViewAll').popup('close'); $('#Picture".$i."Show').css('display', 'block')\"  >";
	$res = mysqli_query($conn, "SELECT * FROM `" . $_COOKIE["idview"] . "_photos` WHERE id='". $i . "';") ;
			if (mysqli_num_rows($res) > 0) {
					while($row = mysqli_fetch_assoc($res)) {
						$photo= $row["photo"];		
						}
			}
	echo "<img id='imageOpeanPopUp' src='profile".$_COOKIE["idview"]."/".$photo."' > </a>"	;
	}
	echo "</div>";
?>