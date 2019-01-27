<?php
ini_set("default_charset", "UTF-8");
?>

<?php
include "./connect.php";/* připojení k databázi */
$data = $_POST["custom_data"];
$start = $_POST["start"];
$end = $_POST["end"];
$times = $_POST["times"];
$keys = $_POST["keys"];
$mysqli->query("INSERT INTO `response_sessions`(`start`,`end`, `custom_data`) VALUES ('$start', '$end', '$data')") or die($mysqli->error);
$id = $mysqli->insert_id;
for ($i = 0; $i < count($times); $i++) {
    $mysqli->query("INSERT INTO `response_answers`(`id_session`,`question_id`, `time`, `answer`) VALUES ('$id', '$i', '$times[$i]', '$keys[$i]')") or die($mysqli->error);
}

?>
