<?php
require_once 'config.php';
session_start();

$dbconn = pg_connect($connStr) or die("Could not connect");
echo "Connected successfully";
pg_close($dbconn);

?>