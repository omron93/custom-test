<?php
ini_set("default_charset", "UTF-8");
?>

<?
$db_server    = 'localhost:/var/run/mysql/mysql.sock'; /* Název serveru, ke kterému se budeme připojovat */
$db_login     = ''; /* Jméno uživatele do DB */
$db_password  = ''; /* Heslo uživatele do DB */
$db_name      = ''; /* Název databáze, ve které jsme si vytvořili tabulku "uzivatele" */
$spojeni      = @MySQL_Connect($db_server ,$db_login, $db_password);
@MySQL_Select_DB($db_name)or die('<p style="color: red">Nastala chyba v pripojeni k databazi');
mysql_query("set names utf8");
?>