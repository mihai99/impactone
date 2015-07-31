<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="styles/popups.css">
<link rel="stylesheet" href="styles/messages_notifications.css">
<link rel="stylesheet" href="styles/event.css">
<link rel="stylesheet" href="styles/conversations.css">
<script type="text/javascript" src="scripts/conversationsDisplay.js" > </script>
<script type="text/javascript" src="scripts/posts.js"> </script>
<script type="text/javascript" src="scripts/cookies.js"> </script>
<script type="text/javascript" src="scripts/aa.js"> </script>
<script>


function GetMessagesNotifications(){
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/getNotifications.php?",
    'data': { },
    'success': function (data) {	
	
			document.getElementById('NotificationsPopUp').innerHTML=data;
			
		}		
		});	
		
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/getMessages.php?",
    'data': { },
    'success': function (data) {		
			document.getElementById('MessagePopUp').innerHTML=data;
			
		}		
});
setTimeout(GetMessagesNotifications, 2000);
}

function SearchResults(txt)
{
	if(txt!="")
	{		
	$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/searchPersons.php?",
    'data': {'id': txt},
    'success': function (data) {	
		document.getElementById('SearchPanel').innerHTML=data;
		}
	});	
		if(document.getElementById('SearchPanel').style.top=='-300px') 
					$('#SearchPanel').animate({top: '55px'}, { duration: 400, queue: false });
	}
	else $('#SearchPanel').animate({top: '-300px'}, { duration: 400, queue: false }); 
	
}
function SetPosts(){
$.ajax({'async': false,
		'type': "POST",
		'global': false,
		'dataType': 'html',
		'url': "PHP/event/eventgetPostIdAll.php?",
		'data': { 'prof' :  getCookie("idviewevent")},
		'success': function (data) {
			
			document.getElementById("PostBigDiv").innerHTML=null;
		for(var i=parseInt(data); i>=1;i--)
			$.ajax({'async': false,
					'type': "POST",
					'global': false,
					'dataType': 'html',
					'url': "PHP/event/eventShowPosts.php?",
					'data': { 'id':i},
					'success': function (data2) {
			
					document.getElementById("PostBigDiv").innerHTML+=data2;
						
					
					}
					});
					}
});	}
</script>
<style>
#title-to {
  background: blue;
  padding: 5px 20px 5px 0px;
  border-bottom: 2px solid rgb(2, 61, 89);
  color: yellow;
}
</style>
<?php
session_start();
$_SESSION["servername"] = "localhost";
$_SESSION["user"] = "root";
$_SESSION["pass"] = "";
$_SESSION["database"] = "impact";
$_COOKIE["idviewevent"]=1;
?>
</head>
<body>
<script>

</script>
<div data-role="panel" id="Side" data-display="overlay" class="ui-bar-b" style="overflow-x:hidden; top: 55px; background-color: #1d1d1d;;">
	<!--- PANOU LATERAL --->
		<div data-role="controlgroup" data-type="vertical">
			<a class="ui-btn ui-shadow ui-icon-user ui-btn-icon-left" onclick="ShowPost()" href="#ChangeProfile" data-rel="popup" data-position-to="window" data-transition="fade" >Change Profile Picture</a>
			<a class="ui-btn ui-shadow ui-icon-camera ui-btn-icon-left" onclick="ShowPost()" href="#ChangeCover" data-rel="popup" data-position-to="window" data-transition="fade" >Upload Cover Picture</a>
			<a class="ui-btn ui-shadow ui-icon-gear ui-btn-icon-left"  href="#ChangeAccount" data-rel="popup" data-position-to="window" data-transition="fade">	Change Account Informations</a>
			<a class="ui-btn ui-shadow ui-icon-gear ui-btn-icon-left"  href="#ChangeSecurity" data-rel="popup" data-position-to="window" data-transition="fade">Change Security Informations</a>
			<button class="ui-btn ui-shadow ui-icon-action ui-btn-icon-left" onclick="
			setCookie('idview', -1);
			setCookie('idloggedon', -1);
			location.href='index.php';
			">Log Out</button>
			</div>
</div>
	<!--- MESAJE SI NOTIFICARI DROP-DOWN --->
<div  style="border: 2px solid black; z-index: 100; max-height: 200px;top: -300px; width: 320px; margin-left: 55%; position: fixed; background: rgb(0, 206, 209);overflow-y: auto;" id="MessagePopUp">
			<div id="title-to">Messages:</div>
		<div id="message"><div id="sender">aaa</div><div id="text">sdasda</div></div>
		<div id="message"><div id="sender">aaa</div><div id="text">sdasda</div></div>
		<div id="message"><div id="sender">aaa</div><div id="text">sdasda</div></div>
</div>		
<div  style="border: 2px solid black; z-index: 100; top: -300px; margin-left: 55%; width: 320px; max-height: 200px;overflow-y: auto;position: fixed; background: rgb(0, 206, 209);" id="NotificationsPopUp">
		
</div>


<!--- HEADER --->
<div id="header" data-role="header" data-theme="a" class="ui-bar-b" style="position:fixed; overflow-x:hidden;z-index:20000;width: 100%;">
<fieldset class="field-grid-a" data-theme="a">
<div class="ui-block-a" style="width: 20%;margin-top: 7px;"><a  href="#Side"><img src="images/logo.png" width="100%" height="40px" ></a></div>
<div class="ui-block-b" style="margin-left: 5%;width: 30%;">
	<input onchange="SearchResults($(this).val());" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();" type="search" name="search" id="search">
	
	
	</div>
<div class="ui-block-c" >
	<div data-role="controlgroup" data-type="vertical">
	<!--- BUTON PROFIL MEJASE NOTIFICARI --->
		<a class="ui-btn ui-btn-shadow ui-icon-home ui-btn-icon-left ui-corner-all ui-btn-e" onclick="setCookie('idview',getCookie('idloggedon'));location.href='profile.php'; ">Profile</a>
		<a  onclick="
		if(document.getElementById('MessagePopUp').style.top=='-300px') 
			{$('#MessagePopUp').animate({top: '55px'}, { duration: 400, queue: false });
			$('#NotificationsPopUp').animate({top: '-300px'}, { duration: 400, queue: false });
			}
		else 
			$('#MessagePopUp').animate({top: '-300px'}, { duration: 400, queue: false });" class="ui-btn ui-btn-shadow ui-icon-comment ui-btn-icon-left ui-corner-all ui-btn-e">Messages</a>
		<a  onclick="
		if(document.getElementById('NotificationsPopUp').style.top=='-300px') 
			{$('#NotificationsPopUp').animate({top: '55px'}, { duration: 400, queue: false });
			$('#MessagePopUp').animate({top: '-300px'}, { duration: 400, queue: false });
			}
		else 
			$('#NotificationsPopUp').animate({top: '-300px'}, { duration: 400, queue: false });" class="ui-btn ui-btn-shadow ui-icon-alert ui-btn-icon-left ui-corner-all ui-btn-g">Notifiactions</a>
		
			</div>		
</div>
<div class="ui-block-d" id="event-edit-but" style="float: right;">
<a href="#edit-event" data-rel="popup" data-position-to="window" data-transition="fade" class="ui-btn ui-btn-shadow ui-icon-alert ui-btn-icon-left ui-corner-all ui-btn-g">Edit</a>	
</div>
</fieldset>
</div>

	
<!--- PAGINA PROFIL --->
<div data-role="main" class="ui-content" style="background:url('images/back2.jpg'); background-repeat:no-repeat; background-size:100% 100%;">
	<div id="event">
	<!--- DESPRE PROFIL --->
	<div id="event-about">
		<div id="profile-about-name"><b>Name:</b>aaa</div>
		<div id="profile-about-location"><b>Location:</b> xx</div>
		<div id="profile-about-date"><b>Date: </b>Piatra Neamt</div>
		<div id="profile-about-about"><b>About:</b> Starcraft II, League of Legends</div>
		
	</div>
	<div id="event-status" style=" width: 30%;  position: absolute; margin-top: 170px; background: rgba(246, 246, 246, 0.32); height: 130px;">
	<form onsubmit="location.reload();" target="opt" action="PHP/event/updateState.php">
	<select name="option" id="option">
		<option id='1' value="1">Participate</option>
		<option id='2' value="2">Dont know if i can participate</option>
		<option id='3' value="3">Dont participate</option>
		</select>
		<input type="submit" value="Update my option">
	</form>
	</div>
	<a id="eventAddPost" style="position: absolute; margin-top: 283px; margin-left: 2px;border-radius: 5px; height: 20px;" href="#PostPopUp" data-rel="popup" data-position-to="window" data-transition="fade" class="ui-btn">
		Say Something about the event
	</a>
	<div id="event-recent-pictures" style="width: 30%;
  background: #f6f6f6;
  border-radius: 10px;
  position: absolute;
  height: 210px;
  margin-top: 330px;
  border-top: 2px solid black;
  border-radius: 0px;">
			<a  style="padding-top: 0;padding-bottom: 0;margin-top: -7px;" href="#PhotosViewAll" data-rel="popup" data-position-to="window" data-transition="fade" class="ui-btn">View All Photos</a>
	</div>
	<div id="event-participants" style="
  margin-top: 585px;
    position: absolute;
    background: #f6f6f6;
    width: 30%;
    border-top: 2px solid;
    text-align: center;
    font-size: 20px;
    height: 500px;
    overflow-y: auto;
">
	
		
	</div>
	<!--- POZA COVER, PROFIL SI NUME --->
	<div id="event-cover"><img src="" width="100%" height="100%" style=" border-top-right-radius: 20px;border-top-left-radius: 20px;"></div>
	
	<!--- INCEPUT PERETE--->
<div id="PostBigDiv" style="margin-left: 31%;   " data-role="controlgroup" data-type="vertical" style="margin-top: -280px;"></div>

</div>
</div>
	
<!---- CONTACTE---->
<div id="contacts"  style="overflow-y:scroll; width: 200px;height: 60%;border: 2px solid;float: right;position: fixed;top: 1500px;right: 0;"></div>
<a id="contacts-but" onclick="
		if(document.getElementById('contacts').style.top=='32.5%') 
			{$('#contacts').animate({top: '1500px'}, { duration: 400, queue: false });		
			$('#contacts-but').attr('data-icon', 'arrow-u');}
		else 
			{$('#contacts').animate({top: '32.5%'}, { duration: 400, queue: false }); 
			$('#contacts-but').attr('data-icon', 'arrow-d');}" data-icon="arrow-d" class="ui-btn ui-btn-shadow ui-btn-icon-left ui-icon-arrow-u ui-btn-b" style=" float: right; top: 92%; right: 0; height:3%;position: fixed; width: 144px; border: 2px solid black;"> Contacts</a>

<div id='PhotosViewAll' data-role="popup" style=" position: fixed;top: 16%; left: 10%;width: 80%; height: 80%;overflow-y: scroll;background: white;overflow-x: hidden;border: 1px solid;">
     
</div>	
	
<div id="picturesOpean"></div>
		


<div data-role="popup" id="ChangeProfile" style="">
    <div data-role="main" class="ui-content">
		<form target="opt"  onsubmit="setTimeout(function () { window.location.reload(); }, 10)" action="uploadProfilePicture.php" method="post" enctype="multipart/form-data">
					Select your next profile picture:
		<input type="file" name="fileToUpload" id="fileToUpload">	
			<div data-role="navbar">
			<ul>
				<li>  <input type="submit" id="submitbut" value="Post" name="submit"></li>
				<li><a href="" onclick="$('#ChangeProfile').popup('close')"> Cancel</a></li>
			</ul>
		</form>
			</div>
	</div>	
</div>

<div data-role="popup" id="ChangeCover" style="">
    <div data-role="main" class="ui-content">
		<form target="opt"  onsubmit="setTimeout(function () { window.location.reload(); }, 10)" action="uploadCoverPicture.php" method="post" enctype="multipart/form-data">
					Select your next cover picture:
		<input type="file" name="fileToUpload" id="fileToUpload">	
			<div data-role="navbar">
			<ul>
				<li>  <input type="submit" id="submitbut" value="Post" name="submit"></li>
				<li><a href="" onclick="$('#ChangeCover').popup('close')"> Cancel</a></li>
			</ul>
		</form>
			</div>
	</div>	
</div>

<div data-role="popup" id="ChangeSecurity" style="" method="post">
    <div data-role="main" class="ui-content">
		<form target="opt"  onsubmit="" action="PHP/changeSecurity.php" method="post" >
			If you dont want to change one of the fields, leave it empty:
		<table id="security">
		<tr><td>Change Username:</td><td><input type='text' id="username" name="username"></tr>
		<tr><td>Change Password:</td><td><input  type='text' id="password" name="password"></tr>
		<tr><td>Change Email:</td><td><input type='text' id="email" name="email"></tr>
	
		</table>
			<div data-role="navbar">
			<ul>
				<li>  <input type="submit" id="submitbut" value="Upload" name="submit"></li>
				<li><a href="" onclick="$('#ChangeSecurity').popup('close')"> Cancel</a></li>
			</ul>
		</form>
			</div>
	</div>	
</div>



<div data-role="popup" id="ChangeAccount" style="">
    <div data-role="main" class="ui-content">
		<form target="opt"  onsubmit="" action="PHP/changeAccount.php" method="post" >
		If you dont want to change one of the fields, leave it empty:
		<table id="account">
		<tr><td>Change Name:</td><td><input type='text' id="name" name="name"></tr>
		<tr><td>Change Nickname:</td><td><input  type='text' id="nick" name="nick"></tr>
		<tr><td>Change Age:</td><td><input type='text' id="age" name="age"></tr>
		<tr><td>Change City:</td><td><input type='text' id="city" name="city"></tr>
		<tr><td>Change Recently Played Games:</td><td><input type='text' id="games" name="games"></tr>
		</table>
			<div data-role="navbar">
			<ul>
				<li>  <input type="submit" id="submitbut" value="Upload" name="submit"></li>
				<li><a href="" onclick="$('#ChangeAccount').popup('close')"> Cancel</a></li>
			</ul>
		</form>
			</div>
	</div>	
</div>

<div data-role="popup" id="edit-event" style="">
    <div data-role="main" class="ui-content">
		<form target="opt"  onsubmit="" action="PHP/event/changeEvent.php" method="post" >
		If you dont want to change one of the fields, leave it empty:
		<table id="account">
		<tr><td>Change Name:</td><td><input type='text' id="name" name="name"></tr>
		<tr><td>Change Location:</td><td><input  type='text' id="location" name="location"></tr>
		<tr><td>Change Date:</td><td><input type='text' id="date" name="date"></tr>
		<tr><td>About:</td><td><input type='text' id="about" name="about"></tr>
		</table>
			<div data-role="navbar">
			<ul>
				<li>  <input type="submit" id="submitbut" value="Upload" name="submit"></li>
				<li><a href="" onclick="$('#edit-event').popup('close')"> Cancel</a></li>
			</ul>
		</form>
			</div>
	</div>	
</div>
		<div id="conversations" style="background: transparent;pointer-events: none;">
		
		
		
		</div>
<div id="picturesPopUp" style="display:none"></div>

<div  id="SearchPanel" style="top: -300px; border: 2px solid black; z-index: 100; width: 30%; margin-left: 25%;position: fixed; background: rgb(0, 206, 209);">
		
		
</div>	

<script>
		
		//setCookie("Profileid", 1 );
document.getElementById('PostBigDiv').innerHTML=null;
var width=$(window).width()-210;
$("#conversations").css("width", width+"px");
$(window).resize(function () {
var width=$(window).width()-210;
$("#conversations").css("width", width+"px");
});

ShowMessagesBlocks();
ShowContacts();
var idprofile=getCookie("idloggedon");

var ViewProfile=getCookie("idview");

	SetPosts();		
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/eventRecentPictures.php?",
    'data': { },
    'success': function (data) {	

		document.getElementById('event-recent-pictures').innerHTML=data;
		}
	});	
	
	
		
				

$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/eventrecentPicturesPopUPs.php?",
    'data': { },
    'success': function (data) {	
		document.getElementById('picturesPopUp').innerHTML=data;
		}
	});
	
	
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/getPhoto.php?",
    'data': { 'prof': getCookie("idview") },
    'success': function (data) {	
		var txt=" <img src='event" + getCookie("idviewevent") + "/"+data+"' style='width: 100%;height: 100%; border-top-right-radius:20px;'>";
		document.getElementById("event-cover").innerHTML=txt;
	}
	});


$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/eventshowPhotosGalery.php?",
    'data': { },
    'success': function (data) {	
		document.getElementById('PhotosViewAll').innerHTML=data;
		}
	});
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/eventshowPhotosGaleryPopUp.php?",
    'data': { },
    'success': function (data) {	
			document.getElementById('picturesOpean').innerHTML=data;
		}
});
		
		

	if(getCookie("idview")==getCookie("idloggedon")) 
		{document.getElementById("profile-message").innerHTML="Post something";
		document.getElementById("profile-message").href="#PostPopUp";
		
		}
		else
		{document.getElementById("profile-message").innerHTML="Follow";	
			document.getElementById("profile-message").href="";
		
		}

</script>
<script>



$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/getParticipants.php?",
    'data': { },
    'success': function (data) {	
	
			document.getElementById('event-participants').innerHTML="Participants:"+data;
			
		}		
		});		

GetMessagesNotifications();
		

$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/getOwn.php?",
    'data': { },
    'success': function (data) {	
		
			if(getCookie('idloggedon')!=data)
				document.getElementById('event-edit-but').style.display="none";
			
		}		
		});


$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/getState.php?",
    'data': { },
    'success': function (data) {	

		   $('#'+data).attr('selected','selected');
	
		}		
		});
		
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/getName.php?",
    'data': { },
    'success': function (data) {	
			document.getElementById('profile-about-name').innerHTML="<b>Name: </b>"+data;
		}
});
		
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/getLocation.php?",
    'data': { },
    'success': function (data) {	
			document.getElementById('profile-about-location').innerHTML="<b>Location: </b>"+data;
		}
});
		
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/getDate.php?",
    'data': { },
    'success': function (data) {	
			document.getElementById('profile-about-date').innerHTML="<b>Date: </b>"+data;
		}
});
		
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/getAbout.php?",
    'data': { },
    'success': function (data) {	
			document.getElementById('profile-about-about').innerHTML="<b>About: </b>"+data;
		}
});
		</script>
<iframe id="opt" name="opt" style="display:none"></iframe>
</body>
</html>
