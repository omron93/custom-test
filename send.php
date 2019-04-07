<?php
ini_set("default_charset", "UTF-8");
?>

<?php
include "./connect.php";/* připojení k databázi */

$table1 = "CREATE TABLE IF NOT EXISTS response_sessions (
  id_session int(10) NOT NULL AUTO_INCREMENT,
  start varchar(40) NOT NULL,
  end varchar(40) NOT NULL,
  custom_vars LONGTEXT,
  custom_data LONGTEXT,
  PRIMARY KEY (id_session)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

$table2 = "CREATE TABLE IF NOT EXISTS response_answers (
  id int(10) NOT NULL AUTO_INCREMENT,
  id_session int(10) NOT NULL,
  slide_id int(10) NOT NULL,
  time varchar(40) NOT NULL,
  answer varchar(40) NOT NULL,
  PRIMARY KEY (id),
  KEY id_session (id_session)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

if ($mysqli->query($table1) === TRUE && $mysqli->query($table2) === TRUE) {
    error_log("Database created successfully");
} else {
    error_log("Error creating database: " . $mysqli->error);
}


$vars = $_POST["custom_vars"];
$data = $_POST["custom_data"];
$start = $_POST["start"];
$end = $_POST["end"];
$times = $_POST["times"];
$keys = $_POST["keys"];
$mysqli->query("INSERT INTO `response_sessions`(`start`,`end`, `custom_vars`, `custom_data`) VALUES ('$start', '$end', '$vars', '$data')") or die($mysqli->error);
$id = $mysqli->insert_id;
$sql = "INSERT INTO `response_answers`(`id_session`,`slide_id`, `time`, `answer`) VALUES ";
foreach ($times as $slide => $time) {
    if (array_key_exists($slide,$keys)) {
        $key = $keys[$slide];
    } else {
        $key = '';
    }
    if ($slide > 0) $sql .= ", ";
    $sql .= "('$id', '$slide', '$time', '$key')";
}
$mysqli->query($sql) or die($mysqli->error);


?>
