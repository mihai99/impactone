<?php

session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);
$target_dir = "profile".$_COOKIE["idloggedon"]."/";
if (empty($_POST["txt-post"])) {
     $txt = "";
   } else {
     $txt = $_POST["txt-post"];
   }
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


$id=1;
$res = mysqli_query($conn, "SELECT * FROM `".$_COOKIE["idloggedon"]."_photos`;") ;
$id=mysqli_num_rows($res);
$id++;
echo "---" . $id;
$sql="INSERT INTO `".$_COOKIE["idloggedon"]."_photos` (`id`, `photo`) VALUES ('".$id."','".basename( $_FILES["fileToUpload"]["name"])."')";
echo "<br>" . $sql ."<br>";
if(mysqli_query($conn, $sql)) echo "ok2<br>"; 
}

$id=1;
$res = mysqli_query($conn, "SELECT * FROM `".$_COOKIE["idloggedon"]."_posts`;") ;
$id=mysqli_num_rows($res);
$id++;
$sql="INSERT INTO `".$_COOKIE["idloggedon"]."_posts` (`id`, `text`, `photo`) VALUES ('".$id."','".$txt."', '".basename( $_FILES["fileToUpload"]["name"])."')";
	if(mysqli_query($conn, $sql)) echo "<script>alert(3)</script><br>";

	$sql="CREATE TABLE ".$_COOKIE['idloggedon']."_".$id."_comments (
id INT ,
idpers VARCHAR(255) ,
comm VARCHAR(255)
)";
echo $sql;
	if(mysqli_query($conn, $sql)) echo "<script>alert(4)</script>"; else echo "<script>alert('".mysql_error($conn)."')</script>";
	
	mysqli_close($conn);

?>