<?php
require_once 'config.php';
session_start();
echo $connStr;

$dbconn = pg_connect($connStr) or die("Could not connect");
echo "Connected successfully";
pg_close($dbconn);

?>