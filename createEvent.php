<?php
session_start();
$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);
$res = mysqli_query($conn, "SELECT * FROM events") ;
$id=mysqli_num_rows($res);
$id++;
$target_dir = "event".$id."/";
mkdir("event".$id);
echo "<script>alert(".basename($_FILES["fileToUpload"]["name"]).")</script>";
if(empty(basename($_FILES["fileToUpload"]["name"]))) echo "<Script> alert('no file')</script>"; else {
	echo "<Script> alert('file')</script>";
	
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
echo $target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
//if (file_exists($target_file)) {
 //   echo "Sorry, file already exists.";
//    $uploadOk = 0;
//}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
}
}





$sql="INSERT INTO `events`(`id`, `name`, `location`, `date`, `cover`, `own`, `about`) VALUES  ('".$id."','".$_POST["event-name"]."','".$_POST["event-loc"]."', '".$_POST["event-date"]."', '".basename( $_FILES["fileToUpload"]["name"])."','".$_COOKIE["idloggedon"]."','".$_POST["event-about"]."')";

echo "<br>" . $sql ."<br>";
if(mysqli_query($conn, $sql)) echo 1; 


$sql="CREATE TABLE ".$id."_ev_persons (
pers INT ,
status INT 
)";
if(mysqli_query($conn, $sql)) echo 2;

$sql="CREATE TABLE ".$id."_ev_photos
	(
	id int,
	photo varchar(255)
	)";	
if(mysqli_query($conn, $sql)) echo 3;

$sql="CREATE TABLE ".$id."_ev_posts
	(
	id int,
	text varchar(5000),
	photo varchar(255)
	)";		
if(mysqli_query($conn, $sql)) echo 4;



echo "---" . $id;
mysqli_query($conn, "INSERT INTO `".$id."_ev_photos`(`id`, `photo`) VALUES ('1','".basename( $_FILES["fileToUpload"]["name"])."')") ;
$sql="INSERT INTO `".$id."_ev_posts` (`id`, `text`, `photo`) VALUES ('1','', '".basename( $_FILES["fileToUpload"]["name"])."')";
if(mysqli_query($conn, $sql)) echo "ok";

$sql="CREATE TABLE ".$id."_1_ev_comments (
id INT ,
idpers VARCHAR(255),
comm VARCHAR(255)
)";
if(mysqli_query($conn, $sql)) echo "created comments"; else echo mysql_error($conn);
echo "<script>alert('event created')</script>";
}

	mysqli_close($conn);

?>