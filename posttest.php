<?php
require_once 'config.php';
session_start();

try {
	$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	if ($pdo) {
		$msg = stripslashes(htmlspecialchars('test time'));
		$who = 'B';
		$sql = "INSERT INTO CHAT_LOG (TS, WHO, MSG) VALUES(NOW() + INTERVAL '8 hours', :who, :msg)";
		echo $sql;
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
?>
