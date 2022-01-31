<?php
session_start();

$A_TEMPLATE = "<div class='A'><img src='img/boy.png'><p>[MSG]</p><span>[TIME]</span></div>";
$B_TEMPLATE = "<div class='B'><img src='img/man.png'><p>[MSG]</p><span>[TIME]</span></div>";

$eightHours = DateInterval::createFromDateString('8 hours');
$msgdate = date_add(date(),$eightHours);

//$msgdate = date_add($msgdate,$eightHours);

if(isset($_SESSION['name'])){
    $text = $_POST['text'];
	
	if ($_SESSION['name'] == 'A'){
		$text_message = str_replace("[MSG]", stripslashes(htmlspecialchars($text)), $A_TEMPLATE);
		$text_message = str_replace("[TIME]", date_format($msgdate,"g:i A"), $text_message);
	}
	if ($_SESSION['name'] == 'B'){
		$text_message = str_replace("[MSG]", stripslashes(htmlspecialchars($text)), $B_TEMPLATE);
		$text_message = str_replace("[TIME]", date_format($msgdate,"g:i A"), $text_message);
	}
	
	//$text_message = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
	
    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
}
?>
