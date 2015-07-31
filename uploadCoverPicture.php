<?php
$target_dir = "profile".$_COOKIE["idloggedon"]."/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

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

session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

$result = mysqli_query($conn, "UPDATE `users` SET `coverPic`='".basename( $_FILES["fileToUpload"]["name"])."' WHERE id='".$_COOKIE["idloggedon"]."';") ;
if($result) echo "ok"; else echo mysql_error($conn);

$res = mysqli_query($conn, "SELECT * FROM `".$_COOKIE["idloggedon"]."_photos`;") ;
$id=mysqli_num_rows($res);
$id++;
echo "---" . $id;
mysqli_query($conn, "INSERT INTO `".$_COOKIE["idloggedon"]."_photos`(`id`, `photo`) VALUES ('".$id."','".basename( $_FILES["fileToUpload"]["name"])."')") ;
$res = mysqli_query($conn, "SELECT * FROM `".$_COOKIE["idloggedon"]."_posts`;") ;
$id=mysqli_num_rows($res);
$id++;
$sql="INSERT INTO `".$_COOKIE["idloggedon"]."_posts` (`id`, `text`, `photo`) VALUES ('".$id."','', '".basename( $_FILES["fileToUpload"]["name"])."')";
	if(mysqli_query($conn, $sql)) echo "ok";
	echo "<script>alert('Cover picture uploaded');</script>";
$sql="CREATE TABLE ".$_COOKIE["idloggedon"]."_".$id."_comments (
id INT ,
idpers VARCHAR(255),
comm VARCHAR(255)
)";
if(mysqli_query($conn, $sql)) echo "created comments"; else echo mysql_error($conn);
	mysqli_close($conn);
?>