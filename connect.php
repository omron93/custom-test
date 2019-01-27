<?php
ini_set("default_charset", "UTF-8");
?>

<?php
$db_server    = 'localhost:/var/run/mysql/mysql.sock'; /* DB location */
$db_login     = ''; /* DB user */
$db_password  = ''; /* DB password */
$db_name      = ''; /* DB name */
$mysqli       = new mysqli($db_server ,$db_login, $db_password, $db_name);
$mysqli->query("set names utf8");
?>
