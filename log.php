<?php
require_once 'config.php';
session_start();

try {
	$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	if ($pdo) {
		//echo "Connected to the $db database successfully!";
		$sql = 'SELECT id, ts, who, msg FROM chat_log WHERE id >= (SELECT MIN(id) hh FROM (SELECT id FROM chat_log order by id desc LIMIT :rowCount) a) ORDER BY id';
		
		//$statement = $pdo->query($sql);
		
		$statement = $pdo->prepare($sql);
		$statement->bindParam(':rowCount', 100, PDO::PARAM_INT);
		$statement->execute();
		
//		echo "statement pass";
		$msgs = $statement->fetchAll(PDO::FETCH_ASSOC);
//		echo "fetchAll pass";
		
		if ($msgs) {
			foreach ($msgs as $row) {
				$text_message = str_replace("[MSG]", stripslashes(htmlspecialchars($row['msg'])), $A_TEMPLATE);
				$text_message = str_replace("[TIME]", $row['ts'], $text_message);
				echo $text_message;
			}
		}
		else
		{
			echo 'No Message!';
		}		
	}
} catch (PDOException $e) {
	die($e->getMessage());
} finally {
	if ($pdo) {
		$pdo = null;
	}
}

?>