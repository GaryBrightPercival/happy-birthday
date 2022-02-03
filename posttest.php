<?php
require_once 'config.php';
session_start();

try {
	$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	if ($pdo) {
		$text = stripslashes(htmlspecialchars('test B');
		$who = 'B';
		$sql = 'INSERT INTO CHAT_LOG (TS, WHO, MSG) VALUES(NOW(), :who, :msg)';

		echo $text."<br/>";
		echo $who."<br/>";
		echo $sql."<br/>";
		
		//$statement = $pdo->prepare($sql);

		/*$statement->execute([
			':text' => $text,
			':who' => $who
		]);*/
	}
} catch (PDOException $e) {
	die($e->getMessage());
} finally {
	if ($pdo) {
		$pdo = null;
	}
}
?>
