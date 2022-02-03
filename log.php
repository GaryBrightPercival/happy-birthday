<?php
require_once 'config.php';
session_start();

try {
	$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	if ($pdo) {
		$sql = 'SELECT id, ts, who, msg FROM chat_log WHERE id >= (SELECT MIN(id) hh FROM (SELECT id FROM chat_log order by id desc LIMIT 100) a) ORDER BY id';
		
		$statement = $pdo->query($sql);
		$msgs = $statement->fetchAll(PDO::FETCH_ASSOC);

		
		if ($msgs) {
			foreach ($msgs as $row) {
				if ($row['who'] == 'A')
				{
					$template = $A_TEMPLATE;
				}
				if ($row['who'] == 'B')
				{
					$template = $B_TEMPLATE;
				}
				if ($template)
				{
					$text_message = str_replace("[MSG]", $row['msg'], $template);
					$text_message = str_replace("[TIME]", $row['ts'], $text_message);
				}
				else
				{
					$text_message = $row['msg'];
				}					
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