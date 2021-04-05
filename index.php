<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body onload="checkcookie()">
<div id="whitebg"></div>
<div id="loginbox">
    <h1>Pick a username:</h1>
    <p><input type="text" name="pickusername" id="cusername" placeholder="Pick a username" class="msginput"></p>
    <p class="buttonp"><button id="but_choose_username" >Choose Username</button></p>
</div>
<div class="msg-container">
	<div class="header">Messenger</div>
	<div class="msg-area" id="msg-area"></div>
	<div class="bottom">
        <input type="text" name="msginput" class="msginput" id="msginput"  value="" placeholder="Enter your message here ... (Press enter to send message)">
    </div>
</div>
<script type="text/javascript">

var msg_area=document.getElementById("msg-area");
const but_choose_username=document.getElementById("but_choose_username");
const mesage_e_send=document.getElementById("msginput");



function chooseusername(){
    
    var user=document.getElementById("cusername").value;
    document.cookie="messager_uname="+user;
    checkcookie();
}

function show_login(){
    document.getElementById("whitebg").style.display="initial";
    document.getElementById("loginbox").style.display="initial";
}
function hide_login(){
    document.getElementById("whitebg").style.display="none";
    document.getElementById("loginbox").style.display="none";
}
function checkcookie(){
    
    if(document.cookie.indexOf("messager_uname")==-1){
        show_login();
    }else{
        hide_login()
    }
}
function getcookie(cname) {//w3school
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}


let last_output_msg="x"; //for scroll down when resive new message ( for display_msg function)
function display_msg(){
    var  output_msg="";
    var xmlhttp= new XMLHttpRequest;
    var user=getcookie("messager_uname");
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            var response=xmlhttp.responseText.split("\n");

            for(var i=0; i<response.length; i++){
                var item= response[i].split("\\");

                if (item!=""){
                    if (item[0]==user){  //split sends msg from recived
                        output_msg += "<div class=\"msgc\" style=\"margin-bottom: 30px;\"> <div class=\"msg msgfrom\">" + item[1] + "</div> <div class=\"msgarr msgarrfrom\"></div> <div class=\"msgsentby msgsentbyfrom\">Sent by " + item[0] + "</div> </div>"; //first way of coding whit \   
                    }else{
                        output_msg += '<div class="msgc"> <div class="msg">' + item[1] + '</div> <div class="msgarr"></div> <div class="msgsentby">Sent by ' + item[0] + '</div> </div>'; //another way of coding by combination of ' and "
                    }
                }
            }
           msg_area.innerHTML=output_msg;

           if(output_msg!=last_output_msg){ // for scrolldown when resive new message and scrolldown at first time
                msg_area.scrollTop=msg_area.scrollHeight;
                last_output_msg=output_msg
           }  
        }
    }
    xmlhttp.open("GET","get_message.php?username="+user,true);
    xmlhttp.send();
}
setInterval(function(){display_msg()},1000)

function send_message(){
    var message=document.getElementById("msginput").value;
    if(message!=""){
        var user=getcookie("messager_uname");
        var xmlhttp= new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                console.log("uros")
                msg_area.innerHTML+='<div class="msgc" style="margin-bottom: 60px;"> <div class="msg msgfrom"> <p>'+message+'</p> </div><div class="msgarr msgarrfrom"></div><div class="msgsentby msgsentbyfrom"><p> Sent by: '+user+'</p></div></div>';
                var message=document.getElementById("msginput").value=""; //reset input filed to empty
            }
        }
        xmlhttp.open("GET","upload_message.php?username="+user+"&message="+message, true);
        xmlhttp.send();
    }
}
function press_enter(e){
    if(e.keyCode==13){
        send_message();
    }
}
 
document.body.onkeydown=press_enter;
but_choose_username.onclick=chooseusername;


</script> 

</body>
</html>