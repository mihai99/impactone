var names=[];
var namesCount=names.length;
function GetConversation(name)
{
var div=document.getElementById('conversations');
$.ajax({'async': false,
					'type': "POST",
					'global': false,
					'dataType': 'html',
					'url': "PHP/ShowConversation.php?",
					'data': { 'name':name},
					'success': function (data) {
	
					div.innerHTML=div.innerHTML+ data;
					
					}
					});/*
for(var i=0;i<=namesCount;i++)
if(names[i]!=null)
document.getElementById('conv-'+names[i]).value=getCookie("chat_"+name);		
*/
}
function ShowMessagesBlocks(){
var div=document.getElementById('conversations');
 
div.innerHTML=null;
for(var i=0;i<=namesCount;i++)
if(names[i]!=null)
GetConversation(names[i]);
for(var i=0;i<document.getElementsByClassName('conv-type').length;i++)
{var idt=document.getElementsByClassName('conv-type')[i].id;
a=idt;	document.getElementById(idt).value = getCookie(a);

}
for(var i=0;i<document.getElementsByClassName('conv').length;i++)
{
var idt=document.getElementsByClassName('conv')[i].id;

a=idt;	$("#"+a).css("marginTop", 190-parseInt(getCookie(a))+"px");
document.getElementsByClassName('conv-body')[i].scrollTop =9999999999999999999999;
}
setTimeout(function() {
  ShowMessagesBlocks();

}, 3000);

}
function CloseConversation(n)
{
		for(var j=names.indexOf(n); j<=namesCount; j++)
			names[j]= names[j+1];
	namesCount--;
ShowMessagesBlocks();
}
function AddConversation(txt)
{if(FindInConversationsOpeaned(txt)==-1){
namesCount++;
names[namesCount]=txt;
ShowMessagesBlocks();}
}
function FindInConversationsOpeaned(txt)
{
return names.indexOf(txt);
}