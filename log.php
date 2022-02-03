<?php
require_once 'config.php';
session_start();

try {
	$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	if ($pdo) {
		echo "Connected to the $db database successfully!";
		$sql = 'SELECT id, ts, who, msg FROM chat_log WHERE id >= (SELECT MIN(id) hh FROM (SELECT id FROM chat_log order by id desc LIMIT 8) a) ORDER BY id';

		$statement = $pdo->query($sql);

		// get all publishers
		$msgs = $statement->fetchAll(PDO::FETCH_ASSOC);

		if ($msgs) {
			foreach ($row as $msgs) {
				echo $row['msg'] . '<br>';
				$text_message = str_replace("[MSG]", stripslashes(htmlspecialchars($row['msg'])), $A_TEMPLATE);
				$text_message = str_replace("[TIME]", $row['ts'], $text_message);
				echo $text_message;
			}
		}
		else
		{
			echo '$msg is null!';
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