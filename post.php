<?php
require_once 'config.php';
session_start();

if(isset($_SESSION['name'])){
    $text = $_POST['text'];
	
	if ($_SESSION['name'] == 'A'){
		$text_message = str_replace("[MSG]", stripslashes(htmlspecialchars($text)), $A_TEMPLATE);
		$text_message = str_replace("[TIME]", date("g:i A"), $text_message);
	}
	if ($_SESSION['name'] == 'B'){
		$text_message = str_replace("[MSG]", stripslashes(htmlspecialchars($text)), $B_TEMPLATE);
		$text_message = str_replace("[TIME]", date("g:i A"), $text_message);
	}

    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
}
?>
