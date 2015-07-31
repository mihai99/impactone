<?php

session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);


$mes= $_POST["message-text"];
$to= $_COOKIE["message"];
$from = $_COOKIE["idloggedon"];
$tableFrom= $from."_messages";
$tableTo= $to."_messages";
$id=0;
//2 -trimis 1-primit


$sql="INSERT INTO `".$tableFrom."`(`pers`, `mes`, `state`) VALUES ('".$to."','".$mes."',2)";

$res=mysqli_query($conn, $sql);
if($res) echo "ok1"; else echo mysqli_error($conn);
$sql="INSERT INTO `".$tableTo."`(`pers`, `mes`, `state`) VALUES ('".$from."','".$mes."',1)";
echo $sql;
$res=mysqli_query($conn, $sql);
if($res) echo "ok2"; else echo mysqli_error($conn);
echo "<script>
var d = new Date();
    d.setTime(d.getTime() + (24*60*60*1000));
    var expires = 'expires='+d.toUTCString();
    document.cookie = '".$_COOKIE['messageName']."' + '=' + '' + '; ' + expires;
</script>";
$_COOKIE[$_COOKIE['messageName']]='';
//;
?>