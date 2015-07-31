function PostTop(post)
{

var top=($( window ).height()-parseFloat($(post).css("height"))+50)/2;
$(post).css("top", top+"px");

}
function ShowPost()
{var left=$(window).width()/10-78-48;
$("#PostPopUp").css("margin-left", left+"px");
var width=$(window).width()*8/10;
$("#PostPopUp").css("width", width+"px");
var left=$(window).width()/10-78-48;
$("#ChangeProfil").css("margin-left", left+"px");
var width=$(window).width()*8/10;
$("#ChangeProfil").css("width", width+"px");
}
function OpeanPicturesAll()
{
$('#PhotosViewAll').popup('open');

}
var mouse_is_inside = false;


$(document).ready(function()
{
    $('.pic').hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    $("body").mouseup(function(){ 
        if(! mouse_is_inside) $('.pic').css("display", "none");
    });
});

$(document).ready(function()
{
    $('#SearchPanel').hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    $("body").mouseup(function(){ 
        if(! mouse_is_inside) $('#SearchPanel').animate({top: '-300px'}, { duration: 400, queue: false }); 
    });
});


function GetComents(idProfile, idPost)
{
var txt="";
txt+='<div id="comment"><img src="profile2/profile.jpg" style="width: 30px; height: 30px;">Zavate Ovidiu: Bafta</div>';
txt+='<div id="comment"><img src="profile3/profile.jpg" style="width: 30px; height: 30px;">Alex Trifan:Succes</div>';
return txt;
}
