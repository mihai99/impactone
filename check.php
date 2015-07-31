<!DOCTYPE html>
<html>
<head>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="scripts/cookies.js"> </script>
<script>
function PostTop()
{

var top=($( window ).height()-parseFloat($("#panel").css("height"))-200)/2;
$("#panel").css("margin-top", top+"px");

}
</script>
<style>
#back:hover {
  background: rgba(115, 110, 110, 0.86);
}
#back{
  border: 1px solid;
  margin-top: 20px;
  padding: 5px;
  text-align: center;
  background: rgba(171, 171, 171, 0.38);
border-radius: 10px;}
body{
background:url('images/back2.jpg');
 background-repeat:no-repeat; 
background-size:100%;
}
form {
  margin-top: 10px;
  border: 2px solid rgb(228, 223, 223);
  border-radius: 10px;
}
</style>
</head>
<body>
<div id="panel" 
    style="width: 560px; padding: 20px;font-size: 19px; margin-left: 408px; margin-top: 249.5px; background: rgb(255, 245, 245);border-radius: 10px;border: 1px solid rgb(144, 140, 140);"
>
To continue to your profile, pleaseupload a cover and a profile picture:<br>
<form target="up" onsubmit="setTimeout(function () { window.location.reload(); }, 10)" action="uploadProfilePicture.php" method="post" enctype="multipart/form-data">
    Select profile image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" style="  position: absolute;  margin-left: 2px;">

    <input type="submit"  value="Upload Profile Image" name="submit"  style="  margin-left: 180px;  position: absolute;">
</form>
<form target="up" onsubmit="setTimeout(function () { window.location.reload(); }, 10)" action="uploadCoverPicture.php" method="post" enctype="multipart/form-data">
    Select cover image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" style="  position: absolute;  margin-left: 2px;">
	
    <input type="submit"  value="Upload Cover Image" name="submit" style="    margin-left: 188px;  position: absolute;">
</form>
<div id="back" onclick="location.href='index.php'; setCookie('idview', ''); setCookie('idloggedon', '');">Log Out </div>
</div>
<iframe style="width:1000px; height:500px; display:none" id="up" name="up">
</iframe>
<script>
var left=($( window ).width()-550)/2;
$("#panel").css("margin-left", left+"px");
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
           if(xmlhttp.responseText==0) alert("upload cover and profile picture")  ; 
		   if(xmlhttp.responseText==1) alert("upload cover picture")  ; 
		   if(xmlhttp.responseText==2) alert("upload profile picture")  ; 
		    if(xmlhttp.responseText==3) location.href="profile.php"  ; 
			}
        }
        xmlhttp.open("GET","PHP/checkPhotos.php?id="+getCookie("idloggedon"),true);
        xmlhttp.send();
		 PostTop();
</script>
</body>
</html>