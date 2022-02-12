<?php
require_once 'config.php';
//session_start();

if(isset($_GET['logout'])){    
	setcookie($COOKIE_NAME, "", time() - 3600 );
	//session_destroy();
	header("Location: index.php"); //Redirect the user
}

function loginForm(){
    echo 
    '<div id="loginform">
        <form action="login.php" method="post">
			<div>
				<a href="#" id="backbtn" class="hidden"
					onclick="document.getElementById(\'manIcon\').className=\'visible\';
							document.getElementById(\'boyIcon\').className=\'visible\';
							document.getElementById(\'pwd\').className=\'hidden\'; 
							document.getElementById(\'enter\').className=\'hidden\';
							this.className=\'hidden\';
							document.getElementById(\'name\').value=\'\';
							return false;" ><img src="img/NO.png" alt="NO!" id="noIcon" style="width:32px; height:auto;" /></a><br/>
				<img src="img/boy.png" alt="BOY" class="visible" id="boyIcon" 
					onclick="document.getElementById(\'manIcon\').className=\'hidden\'; 
							document.getElementById(\'backbtn\').className=\'visible\'; 
							document.getElementById(\'pwd\').className=\'visible\'; 
							document.getElementById(\'enter\').className=\'visible\';
							document.getElementById(\'name\').value=\'A\';
							document.getElementById(\'pwd\').focus(); 
							return false;"/>
				<img src="img/man.png" alt="MAN" class="visible" id="manIcon" 
					onclick="document.getElementById(\'boyIcon\').className=\'hidden\'; 
							document.getElementById(\'backbtn\').className=\'visible\'; 
							document.getElementById(\'pwd\').className=\'visible\'; 
							document.getElementById(\'enter\').className=\'visible\';
							document.getElementById(\'name\').value=\'B\';
							document.getElementById(\'pwd\').focus(); 
							return false;"/>
			</div>
			<div>
				<input type="hidden" name="name" id="name" />
				<input type="password" name="pwd" id="pwd" style="width: 150px; height:32px; font-size:30px;" class="hidden" />
				<input type="image" name="enter" id="enter" class="hidden" src="img/key.png" border="0" alt="Lets go!" style="width:auto; height:23px; vertical-align:sub" />
			</div>
		</form>
	</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Shuuuuu!</title>
        <meta name="description" content="Shuuuuu!" />
        <link rel="stylesheet" href="css/style.css" />
		<link rel="icon" href="img/shushing.png" type="image/icon type" />
    </head>
    <body>
    <?php
    if(!isset($_COOKIE[$COOKIE_NAME])){
        loginForm();
    }
    else {
    ?>
        <div id="wrapper">
            <div id="menu">
                <a id="exit" href="#" ><img src="img/NO.png" alt="NO!" id="noIcon" style="width:26px; height:auto;" /></a>
            </div>
            <div id="chatbox">
            </div>

            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" />
				<input type="image" name="submitmsg" id="submitmsg" src="img/send.png" border="0" alt="Send" style="width:auto; height:24px; vertical-align:top" />
                <!--<input name="submitmsg" type="submit" id="submitmsg" value="Send" />-->
            </form>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            // jQuery Document
            $(document).ready(function () {
                $("#submitmsg").click(function () {
                    var clientmsg = $("#usermsg").val();
                    $.post("post.php", { text: clientmsg });
                    $("#usermsg").val("");
                    return false;
                });

                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request

                    $.ajax({
                        url: "log.php",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div

                            //Auto-scroll			
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }	
                        }
                    });
                }
				loadLog();
                setInterval (loadLog, 5000);

                $("#exit").click(function () {
                    //var exit = confirm("Are you sure you want to end the session?");
                    //if (exit == true) {
                    window.location = "index.php?logout=true";
                    //}
                });
            });
        </script>
    </body>
</html>
<?php
}
?>