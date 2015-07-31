
var Posts;
function ShowContacts(){
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById('contacts').innerHTML=xmlhttp.responseText;
			setTimeout(ShowContacts, 5000);
			}
        }
        xmlhttp.open("GET","PHP/getFreindsChat.php?",true);
        xmlhttp.send();

}
function getCurrentProfileName()
{
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
           document.getElementById("profile-name").innerHTML=xmlhttp.responseText  ; 
			}
        }
        xmlhttp.open("GET","PHP/getProfileName.php?id="+getCookie("idview"),true);
        xmlhttp.send();
	
}
function getPostsNumber()
{
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			Posts=  xmlhttp.responseText; 
		  
			}
        }
        xmlhttp.open("GET","PHP/getPostIdAll.php?prof="+getCookie("idview"),true);
        xmlhttp.send();

}

