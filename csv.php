<?php

ini_set("default_charset", "UTF-8");
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

include "./connect.php";

//print header
printf("start_time;end_time;");
$header1 = $mysqli->query("SELECT * FROM  `response_sessions` WHERE  `id_session` = 1");
$custom_vars = $header1->fetch_assoc()["custom_vars"];
echo $custom_vars;
$header2 = $mysqli->query("SELECT * FROM  `response_answers` WHERE  `id_session` = 1");
for ($row_no = 1; $row_no <= $header2->num_rows; $row_no++) {
    echo ";q".$row_no."_t;q".$row_no."_k";
}

echo "\r\n";

$res = $mysqli->query("SELECT * FROM `response_sessions`");
$res->data_seek(0);

while ($row = $res->fetch_assoc()) {
    $res2 = $mysqli->query("SELECT * FROM  `response_answers` WHERE  `id_session` = ".$row['id_session']);
    echo $row['start'] . ";" . $row['end'] . ";" .$row['custom_data'];
    while ($row2 = $res2->fetch_array()) {
        echo ";" . $row2['time'] . ";" . $row2['answer'];
    }
    echo "\r\n";
}

?>
