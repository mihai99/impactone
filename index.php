<html>
<head>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="scripts/cookies.js"> </script>

<style>
body{
background:url('images/back2.jpg');
 background-repeat:no-repeat; 
background-size:100% 100%;}
#panel {
	background:rgb(255, 245, 245);
	 border: 2px solid rgb(228, 223, 223);
	padding:20px;
  margin-left: 35%;
 border-radius: 10px;
margin-top:20%;
   width: 400px;
  font-size: 20px;
}
#login
{
    text-align: center;
}
button {
  width: 50%;
  height: 50px;
  margin-top: 20px;
}
input {

  height: 25px;
  
}
td {
  width: 50%;
  text-align: center;
  font-size: 25px;
 // border-bottom: 2px solid;
}
button {
  border-radius: 10px;
  background: rgba(171, 171, 171, 0.38);
}
button:hover {
  background: rgba(115, 110, 110, 0.86);
}
</style>
<script>

function Register()
{
user=document.getElementById('username_reg').value;
pass=document.getElementById('password_reg').value;
nume=document.getElementById('name_reg').value;
age=document.getElementById('age_reg').value;
city=document.getElementById('city_reg').value;
nick=document.getElementById('nick_reg').value;
games=document.getElementById('games_reg').value;
email=document.getElementById('email_reg').value;
if(user!="" && pass !="" && nume!="" && email!="" && city!="" && nick!="" && games!="" && age!="")
{
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
           
			alert(xmlhttp.responseText);
			if(xmlhttp.responseText=="Acount Created, you can now Log in")
			{	alert("Acount Created, you can now Log in");
				document.getElementById('login').style.display='block';
				document.getElementById('register').style.display='none';
				
			}
            }
        }
        xmlhttp.open("GET","Register.php?user="+user+"&pass=" + pass+"&nume=" + nume+"&age=" + age+"&email=" + email+
						"&city=" + city+"&nick=" +nick+"&games=" + games	,true);
        xmlhttp.send();
}
else
alert("please fill in all the boxes for register");
}
function VerifyLogIn()
{
user=document.getElementById('username_login').value;
pass=document.getElementById('password_login').value;

var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(xmlhttp.responseText!=0)  {setCookie("idloggedon", xmlhttp.responseText);
			setCookie("idview", xmlhttp.responseText);
			location.href="check.php";
			}
			if(xmlhttp.responseText==0) alert('WRONG USERNAME OR PASSWORD');
			//alert(xmlhttp.responseText);
            }
        }
        xmlhttp.open("GET","PHP/LogIn.php?user="+user+"&pass=" + pass,true);
        xmlhttp.send();

}
function PostTop(post)
{

var top=($( window ).height()-parseFloat($(post).css("height")))/2;
$(post).css("margin-top", top+"px");

}
</script>
</head>

<body>
<?php
session_start();
$_SESSION["servername"] = "localhost";
$_SESSION["user"] = "root";
$_SESSION["pass"] = "";
$_SESSION["database"] = "impact";
?>
<div id="panel">
	<div id="login">
		<table style="  width: 100%;">
	<tr><td>username: </td><td> <input type=text id="username_login"></td></tr>
	<tr><td>password:</td><td>  <input type=text id="password_login"></td></tr>
	
	</table>
	<button id="login" onclick="VerifyLogIn()">Log In</button><button id="reg" onclick="
	document.getElementById('login').style.display='none';
		document.getElementById('register').style.display='block';
		 PostTop('#panel');
	">Register</button>
	</div>
	
	<div id="register" style="display:none">
	<table style="   width: 100%;">
	<tr><td>username:</td><td> <input type=text id="username_reg"></td></tr>
	<tr><td>password:</td><td>  <input type=text id="password_reg"></td></tr>
	<tr><td>email:</td><td> <input type=text id="email_reg"></td></tr>
	<tr><td>name:</td><td>  <input type=text id="name_reg"></td></tr>
	<tr><td>age: </td><td> <input type=text id="age_reg"></td></tr>
	<tr><td>city:</td><td>  <input type=text id="city_reg"></td></tr>
	<tr><td>nickname:</td><td>  <input type=text id="nick_reg"></td></tr>
	<tr><td>what you play: </td><td> <input type=text id="games_reg"></td></tr>
	</table>
	<button id="reg" onclick="Register()">Register</button><button id="back"  onclick="
	document.getElementById('login').style.display='block';
		document.getElementById('register').style.display='none';
			 PostTop('#panel');
	">Back</button>
	</div>
</div>
<script>
var left=($( window ).width()-400)/2;
$("#panel").css("margin-left", left+"px");
var top=($( window ).height()-parseFloat($('#panel').css("height")))/2;
$('#panel').css("margin-top", top+"px");

</script>
</body>

</html>