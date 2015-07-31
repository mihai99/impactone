<?php


session_start();

$servername = $_SESSION["servername"];$username = $_SESSION["user"];$password = $_SESSION["pass"];$dbname =$_SESSION["database"];
$conn = mysqli_connect($servername, $username, $password, $dbname);
$name = $_POST["name"];
$id=$_COOKIE["idloggedon"];
$table=$id."_messages";
$idpers=$id;

$res = mysqli_query($conn, "SELECT * FROM `users` WHERE name='".$name."'");
				if (mysqli_num_rows($res) > 0) 
				while($row = mysqli_fetch_assoc($res)) 
						$idpers=$row["id"];		


$res = mysqli_query($conn, "SELECT * FROM `users` WHERE id=".$_COOKIE["idloggedon"]);
				if (mysqli_num_rows($res) > 0) 
				while($row = mysqli_fetch_assoc($res)) 
						$selfname=$row["name"];
						
	$cookie = "top-".$name;					

 echo "<div  class='conv' id=".$cookie.">";
echo "<div id='conv-name' class=".$name." onclick=\"
				if($(this.parentNode).css('margin-top')=='0px')
				$(this.parentNode).animate({ marginTop: '190px'}, { duration: 200, queue: false });
							else 
				$(this.parentNode).animate({ marginTop: '0px'},{ duration: 200, queue: false });
				setCookie('".$cookie."', $(this.parentNode).css('margin-top'));			
				\">";
echo $name;
$cookie = "chat-".$name;

echo "<div id='conv-close' onclick=\"setCookie('".$cookie."', ''); CloseConversation($(this).parent().attr('class'))\">X</div></div>";
echo "<div id='conv-body' class='conv-body'>";	

$res = mysqli_query($conn, "SELECT * FROM `".$table."` WHERE pers=".$idpers);
	if (mysqli_num_rows($res) > 0) 
		while($row = mysqli_fetch_assoc($res)) 
			{if($row["state"]==1)
				echo "<div id='mes'>".$name.":".$row["mes"]."</div>";
			else 
				echo "<div id='mes'>".$selfname.":".$row["mes"]."</div>";
			}
echo "</div>";
$cookie = "chat-".$name;
$on = "setCookie('".$cookie."', this.value);";
$no="";
$submit="setCookie('message','$idpers');setCookie('messageName','$cookie');	document.getElementById('chat-$name').value=''";
echo			'<form action="PHP/SendMessage.php" target="opt" method="POST" onsubmit='.$submit.' > ';

//$on = $on."alert(getCookie('".$cookie."'));";
 //
	echo			'<input id="chat-'.$name.'" name="message-text" class="conv-type"  type="text" onchange="'.$on.'" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();" placeholder="send message to '.$name.'">';
	echo			'</form > ';
echo "</div>";

	
			
			
		?>