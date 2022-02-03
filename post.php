<?php
require_once 'config.php';
session_start();

if(isset($_SESSION['name'])){
	try {	
		$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		if ($pdo) {
			$msg = stripslashes(htmlspecialchars($_POST['text']));
			$who = $_SESSION['name'];
			$sql = 'INSERT INTO CHAT_LOG (TS, WHO, MSG) VALUES(NOW() + INTERVAL "8 hours", :who, :msg)';
		
			$statement = $pdo->prepare($sql);

			$statement->execute([
				':msg' => $msg,
				':who' => $who
			]);			
		}
	} catch (PDOException $e) {
		die($e->getMessage());
	} finally {
		if ($pdo) {
			$pdo = null;
		}
	}
/*	
	if ($_SESSION['name'] == 'A'){
		$text_message = str_replace("[MSG]", stripslashes(htmlspecialchars($text)), $A_TEMPLATE);
		$text_message = str_replace("[TIME]", date("g:i A"), $text_message);
	}
	if ($_SESSION['name'] == 'B'){
		$text_message = str_replace("[MSG]", stripslashes(htmlspecialchars($text)), $B_TEMPLATE);
		$text_message = str_replace("[TIME]", date("g:i A"), $text_message);
	}

    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
*/
}
?>
