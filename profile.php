<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="styles/popups.css">
<link rel="stylesheet" href="styles/messages_notifications.css">
<link rel="stylesheet" href="styles/profile.css">
<link rel="stylesheet" href="styles/conversations.css">
<script type="text/javascript" src="scripts/conversationsDisplay.js" > </script>
<script type="text/javascript" src="scripts/posts.js"> </script>
<script type="text/javascript" src="scripts/cookies.js"> </script>
<script type="text/javascript" src="scripts/aa.js"> </script>
<script>

 function SetMesBig(){				
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/messagesBigDiv.php?",
    'data': { },
    'success': function (data) {	
		document.getElementById('accordion').innerHTML=data;
		setTimeout(SetMesBig, 2000);
		}
 });	
 }
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
		'url': "PHP/getPostIdAll.php?",
		'data': { 'prof' :  getCookie("idview")},
		'success': function (data) {
			
			document.getElementById("PostBigDiv").innerHTML=null;
		for(var i=parseInt(data); i>=1;i--)
			$.ajax({'async': false,
					'type': "POST",
					'global': false,
					'dataType': 'html',
					'url': "PHP/ShowPost.php?",
					'data': { 'id':i},
					'success': function (data) {
	
					document.getElementById("PostBigDiv").innerHTML+=data;
					
					}
					});
					}
});	}
function del(){
var cookies = document.cookie.split(';');
				for (var i = 0; i < cookies.length; i++) {
					var cookie = cookies[i];
					var eqPos = cookie.indexOf("=");
					var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
					document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:00 GMT';
}}
</script>
<style>
#person-games {
  font-size: 20px;
  position: relative;
  margin-left: 60px;
}
#person {
  height: 100%;
  color:black;
  border-bottom:2px solid black;
}
#person-name {
  margin-left: 60px;
  font-size: 20px;
}
#person-picture {
  width: 50px;
  position: absolute;
  height: 50px;
}
#person:hover
{
	background:blue;
}
#title-to {
  background: blue;
  padding: 5px 20px 5px 0px;
  border-bottom: 2px solid rgb(2, 61, 89);
  color: yellow;
}
#name {
  position: absolute;
  margin-top: -66px;
  margin-left: 114px;
  font-size: 20px;
}
#friends td {
  border: 2px solid black;
  height: 80px;
}
#nameReq {
  position: absolute;
  margin-top: -86px;
  margin-left: 114px;
  font-size: 20px;
  text-align: center;
  width: 480px;
}
</style>

</head>
<body>

<div data-role="panel" id="Side" data-display="overlay" class="ui-bar-b" style="overflow-x:hidden; top: 55px; background-color: #1d1d1d;;">
	<!--- PANOU LATERAL --->
		<div data-role="controlgroup" data-type="vertical">
			<a class="ui-btn ui-shadow ui-icon-user ui-btn-icon-left" onclick="ShowPost()" href="#ChangeProfile" data-rel="popup" data-position-to="window" data-transition="fade" >Change Profile Picture</a>
			<a class="ui-btn ui-shadow ui-icon-camera ui-btn-icon-left" onclick="ShowPost()" href="#ChangeCover" data-rel="popup" data-position-to="window" data-transition="fade" >Upload Cover Picture</a>
			<a class="ui-btn ui-shadow ui-icon-gear ui-btn-icon-left"  href="#ChangeAccount" data-rel="popup" data-position-to="window" data-transition="fade">	Change Account Informations</a>
			<a class="ui-btn ui-shadow ui-icon-gear ui-btn-icon-left"  href="#ChangeSecurity" data-rel="popup" data-position-to="window" data-transition="fade">Change Security Informations</a>
			<a class="ui-btn ui-shadow ui-icon-gear ui-btn-icon-left"  href="#events-about" data-rel="popup" data-position-to="window" data-transition="fade">My Events</a>
			<a class="ui-btn ui-shadow ui-icon-action ui-btn-icon-left" onclick="
				del();
			location.href='index.php';
			">Log Out</a>
			</div>
</div>
	<!--- MESAJE SI NOTIFICARI DROP-DOWN --->
<div  style="border: 2px solid black; z-index: 100; max-height: 200px;top: -300px; width: 320px; margin-left: 55%; position: fixed; background: rgb(0, 206, 209);overflow-y: auto;" id="MessagePopUp">
			
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
		<a class="ui-btn ui-btn-shadow ui-icon-home ui-btn-icon-left ui-corner-all ui-btn-e" onclick="setCookie('idview',getCookie('idloggedon'));location.href='profile.php'; location.reload();">Profile</a>
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
</fieldset>
</div>
<!--- PAGINA PROFIL --->
<div data-role="main" class="ui-content" style="background:url('images/back2.jpg'); background-repeat:no-repeat; background-size:100% 100%;">
	<div id="Profile">
	<!--- ACTIUNI PROFIL --->
	<div id="profile-actions">
		<a id="profile-add-friend" class="ui-btn" href="" data-rel="popup" data-position-to="window" data-transition="fade">
				<script>if(getCookie("idview")==getCookie("idloggedon")) 
						{document.getElementById("profile-add-friend").innerHTML="Friends";
						document.getElementById("profile-add-friend").href="#Friends"
						$('#profile-add-friend').removeAttr('target');
						}
						else
						{$.ajax({
							'async': false,
							'type': "POST",
							'global': false,
							'dataType': 'html',
							'url': "PHP/getFriendState.php?",
							'data': { },
							'success': function (data) {	
							if(data==0) {	document.getElementById("profile-add-friend").innerHTML="Add friend";	
											document.getElementById("profile-add-friend").href="PHP/addFriend.php";
											$('#profile-add-friend').attr('target', 'opt');
										}
							if(data==1) {	document.getElementById("profile-add-friend").innerHTML="Your Friend";	
											$('#profile-add-friend').removeAttr('href');
											$('#profile-add-friend').removeAttr('target');
										}	
							if(data==2) {	document.getElementById("profile-add-friend").innerHTML="Friend request send";	
											$('#profile-add-friend').removeAttr('href');
											$('#profile-add-friend').removeAttr('target');
										}	
										
							}
							});	
							
						
						}
				</script>
		</a>
		<a id="profile-folow"  class="ui-btn" href="#" data-rel="popup" data-position-to="window" data-transition="fade">
			<script>if(getCookie("idview")==getCookie("idloggedon")) 
			{	document.getElementById("profile-folow").innerHTML="Messages";
					$('#profile-folow').attr('href', '#messagesSelf');}
						else
						{document.getElementById("profile-folow").innerHTML="Send Message";	
						$('#profile-folow').attr('href', '#SendMessage');
						}
				</script>
		</a>
		<a id="profile-message" onclick="ShowPost()" class="ui-btn" href="#" data-rel="popup" data-position-to="window" data-transition="fade"></a>
		<a id="profile-invite" onclick="ShowPost()" class="ui-btn" href="#" data-rel="popup" data-position-to="window" data-transition="fade">
		<script>if(getCookie("idview")==getCookie("idloggedon")) 
						{document.getElementById("profile-invite").innerHTML="Create event";
						$('#profile-invite').attr('href', '#CreateEventPopUp');
						}
						else
						{document.getElementById("profile-invite").innerHTML="Invite to an event";	
						$('#profile-invite').removeAttr('href');}
				</script></a>
	</div>
	<!--- POZE RECENTE --->
	<div id="profile-recent-pictures">
			<a  style="padding-top: 0;padding-bottom: 0;margin-top: -7px;" href="#PhotosViewAll" data-rel="popup" data-position-to="window" data-transition="fade" class="ui-btn">View All Photos</a>
	</div>
	<!--- DESPRE PROFIL --->
	<div id="profile-about">
		<div id="profile-about-age"><b> Age:</b> 16 years</div>
		<div id="profile-about-nick"><b> Nickname:</b> Bandituu</div>
		<div id="profile-about-city"><b>City: </b>Piatra Neamt</div>
		<div id="profile-about-work"><b>Recent games played:</b> Starcraft II, League of Legends</div>
		
	</div>
	<!--- POZA COVER, PROFIL SI NUME --->
	<div id="profile-cover"></div>
	<div id="profile-picture"></div>
	<div id="profile-name"><script>getCurrentProfileName()</script></div>
	<!--- INCEPUT PERETE--->
<div id="PostBigDiv" style="margin-left: 31%;   margin-top: -330px;" data-role="controlgroup" data-type="vertical" style="margin-top: -280px;"></div>

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
		
<div data-role="popup" id="PostPopUp" style="">
      
 <div data-role="main" class="ui-content">
<form target="opt"  onsubmit="setTimeout(function () { window.location.reload(); }, 10)" action="uploadPost.php" method="post" enctype="multipart/form-data">
    What's on your mind?
	<textarea id="txt-post" name="txt-post"></textarea>
	Optionaly, you can add a photo with  your post!
    <input type="file" name="fileToUpload" id="fileToUpload">	
    

<div data-role="navbar">
<ul>
	<li>  <input type="submit" id="submitbut" value="Post" name="submit"></li>
	<li><a href="" onclick="$('#PostPopUp').popup('close')"> Cancel</a></li>
</ul>
</form>
</div>
</div>	
</div>

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

		<div id="conversations" style="background: transparent;pointer-events: none;">
		
		
		
		</div>
<div id="picturesPopUp" style="display:none"></div>
<div data-role="popup" id="Friends" style="" method="post" style=" width: 600px;">
    <div data-role="main" class="ui-content" style=" width: 600px; height:400px">
		<div data-role="navbar">
		<ul>
				<li> <a class="ui-btn" href="" onclick="
					$('#requests').fadeOut();
					$('#friends').fadeIn();					
				">Friends</a></li>
				<li><a class="ui-btn" href="" onclick="
					$('#friends').fadeOut();
					$('#requests').fadeIn();
				">Friend Requests</a></li>
		</ul>
		</div>
		<div id="friends" style="overflow-y:auto; height:360px; display:block">
		
		
		</div>
		<div id="requests" style="overflow-y:auto; height:360px; display:none">
		
		
		
		</div>
	</div>
</div>	


<div data-role="popup" id="CreateEventPopUp" action="createEvent.php" method="post" enctype="multipart/form-data">
	<div data-role="main" class="ui-content">
		<form target="opt"  onsubmit="setTimeout(function () { window.location.reload(); }, 10)" action="createEvent.php" method="post" enctype="multipart/form-data">
			Name your event:<input type="text" id="event-name" name="event-name">
			Add a location for your event:<input type="text" id="event-loc" name="event-loc">
			Add a date for your event:<input type="text" id="event-date" name="event-date">
			What the event is about?:<input type="text" id="event-about" name="event-about">
			Select a photo for your event:
			<input type="file" name="fileToUpload" id="fileToUpload">	
		<div data-role="navbar">
		<ul>
			<li>  <input type="submit" id="submitbut" value="Create event" name="submit"></li>
			<li><a href="" onclick="$('#PostPopUp').popup('close')"> Cancel</a></li>
		</ul>
		</form>
		</div>
	</div>	
</div>


<div data-role="popup" id="events-about" style="" method="post" style=" width: 600px;">
    <div data-role="main" class="ui-content" style=" width: 600px; text-align: center; height:400px; font-size: 20px;">
		
		<div id="own-events" style="border-bottom: 1px solid;">
		
					
		</div>
		<div id="going-events">
	
			
		</div>
</div>	
</div>
<div data-role="popup" id="SendMessage" style="">
      
 <div data-role="main" class="ui-content">
<form target="opt"  action="PHP/SendMessage.php" method="post" onsubmit="setCookie('message', getCookie('idview'))">
    Send message:
	<textarea id="txt-post" name=" message-text"></textarea>
	
     <input type="submit" id="submitbut" value="Post" name="submit">


</div>	
</div>
<div data-role="popup" id="messagesSelf" style="" method="post" style=" width: 600px;">
    <div data-role="main" class="ui-content" style=" width: 600px; text-align: center; height:400px;  font-size: 20px;">
<div id="accordion">
 
  
</div>
</div>	
</div>
<div  id="SearchPanel" style="top: -300px; border: 2px solid black; z-index: 100; width: 30%; margin-left: 25%;position: fixed; background: rgb(0, 206, 209);">
		
		
</div>	

<script>
	 $(function() {
    $( "#accordion" ).accordion();
  });
 $.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/messagesBigDiv.php?",
    'data': { },
    'success': function (data) {	
		document.getElementById('accordion').innerHTML=data;
		
		}
 });
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
    'url': "PHP/getFriendRequests.php?",
    'data': { },
    'success': function (data) {	
		document.getElementById('requests').innerHTML=data;
		}
	});	
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/getFriends.php?",
    'data': { },
    'success': function (data) {	
		document.getElementById('friends').innerHTML=data;
		}
	});			
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/recentPictures.php?",
    'data': { },
    'success': function (data) {	
		document.getElementById('profile-recent-pictures').innerHTML=data;
		}
	});	
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/recentPicturesPopUPs.php?",
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
    'url': "PHP/getCoverPhoto.php?",
    'data': { 'prof': getCookie("idview") },
    'success': function (data) {	
		var txt=" <img src='profile" + getCookie("idview") + "/"+data+"' style='width: 100%;height: 100%; border-top-right-radius:20px;'>";
		document.getElementById("profile-cover").innerHTML=txt;
	}
	});
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/getProfilePhoto.php?",
    'data': { 'prof': getCookie("idview") },
    'success': function (data) {
		var txt=" <img src='profile" + getCookie("idview") + "/"+data+"'  style='width: 100%;height: 100%; border-radius:50%'>";
		document.getElementById("profile-picture").innerHTML=txt;
	}
	});	
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/showPhotosGalery.php?",
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
    'url': "PHP/showPhotosGaleryPopUp.php?",
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
    'url': "PHP/getAge.php?",
    'data': { },
    'success': function (data) {	
			document.getElementById('profile-about-age').innerHTML="<b>Age: </b>"+data+" years";
		}
});		
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/getNick.php?",
    'data': { },
    'success': function (data) {	
			document.getElementById('profile-about-nick').innerHTML="<b>Nickname: </b>"+data;
		}		
		});
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/getCity.php?",
    'data': { },
    'success': function (data) {	
			document.getElementById('profile-about-city').innerHTML="<b>City: </b>"+data;
		}		
		});
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/getGames.php?",
    'data': { },
    'success': function (data) {	
			document.getElementById('profile-about-work').innerHTML="<b>Recently played games:</b> "+data;
		}		
		});
		

		
$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/getMyEvents.php?",
    'data': { },
    'success': function (data) {	
	
			document.getElementById('own-events').innerHTML="My events:"+data;
			
		}		
		});


$.ajax({
    'async': false,
    'type': "POST",
    'global': false,
    'dataType': 'html',
    'url': "PHP/event/getParticipationEvents.php?",
    'data': { },
    'success': function (data) {	
		
			document.getElementById('going-events').innerHTML="Events i'm going to:"+data;
			
		}		
		});
		GetMessagesNotifications();
	
		</script>
<iframe id="opt" name="opt" style="display:none"></iframe>
</body>
</html>
