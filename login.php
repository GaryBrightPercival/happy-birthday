<?php
require_once 'config.php';

if(isset($_POST[$NAME_LABEL])){
	if ($_POST[$NAME_LABEL] == "A"){
		if ($_POST[$PWD_LABEL] == $A_PWD){
			setcookie($COOKIE_NAME, stripslashes(htmlspecialchars($_POST[$NAME_LABEL])), time() + (86400 * 30), "/");
			//$_SESSION[$NAME_LABEL] = stripslashes(htmlspecialchars($_POST[$NAME_LABEL]));
		}
	}
	if ($_POST[$NAME_LABEL] == "B"){
		if ($_POST[$PWD_LABEL] == $B_PWD){
			setcookie($COOKIE_NAME, stripslashes(htmlspecialchars($_POST[$NAME_LABEL])), time() + (86400 * 30), "/");
			//$_SESSION[$NAME_LABEL] = stripslashes(htmlspecialchars($_POST[$NAME_LABEL]));
		}
	}
}
header("Location: index.php"); //Redirect the user
?>