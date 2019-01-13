<?php
ini_set("default_charset", "UTF-8");
?>

<?php
include "./connect.php";/* připojení k databázi */
$odpovedi = $_POST["odpovedi"];
$zacatek = $_POST["start"];
$konec = $_POST["konec"];
$doba = $_POST["cas_plneni"];
$sql= mysql_query("INSERT INTO `Kata_test_sesion`(`zacatek`,`delka_plneni`,`konec`) VALUES ('$zacatek', '$doba', '$konec')") or die(mysql_error());
$id = mysql_insert_id();
foreach ($odpovedi as $item){
    $sql= mysql_query("INSERT INTO `Kata_test_odpoved`(`id_sesion`,`cas`,`odpoved`, `otazka`) VALUES ('$id', '$item[1]', '$item[0]', '$item[2]')") or die(mysql_error());
}

?>
