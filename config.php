<?php

$host= 'ec2-44-193-188-118.compute-1.amazonaws.com';
$db = 'dd55qlmt6n84j6';
$user = 'nitldapiwouagu';
$password = '31d12efab6008cccc9dea29fe0133725eef19fdaedc4ea0ed37b83046dac4422'; 

$connStr = "host=".$host." dbname=".$db." user=".$user." password=".$password;
$dsn = "pgsql:host=".$host.";port=5432;dbname=".$db.";";

$A_TEMPLATE = "<div class='A'><img src='img/boy.png'><p>[MSG]</p><span>[TIME]</span></div>";
$B_TEMPLATE = "<div class='B'><img src='img/man.png'><p>[MSG]</p><span>[TIME]</span></div>";

$A_BYE_TEMPLATE = "<div class='msgln'><img src='img/boy.png'> Bye! <small>[TIME]</small></div>";
$B_BYE_TEMPLATE = "<div class='msgln'><img src='img/man.png'> Bye! <small>[TIME]</small></div>";

$A_PWD = '3dward';
$B_PWD = 'coll@r';

?>
