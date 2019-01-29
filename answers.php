<?php
ini_set("default_charset", "UTF-8");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="js/OwlCarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="js/OwlCarousel/dist/assets/owl.theme.default.min.css">
    <script src="js/OwlCarousel/dist/owl.carousel.min.js"></script>

    <link rel="stylesheet" href="style/own.css">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Answers</title>
</head>
<body style="overflow: auto!important;">
    <div class=''>
                <h1>Answers</h1>
                <table class="table">
                    <tr>
                        <td>start</td>
                        <td>end</td>
                        <td>user_input</td>
                    </tr>
                    <?php
                    include "./connect.php";
                    $res = $mysqli->query("SELECT * FROM `response_sessions`");

                    while ($row = $res->fetch_assoc()) {
                        $res2 = $mysqli->query("SELECT * FROM  `response_answers` WHERE  `id_session` = ".$row['id_session']);
                        $rowspan = $res2->num_rows + 1;
                        printf("<tr><td rowspan=$rowspan>%s</td><td>%s</td><td>%s</td></tr>", $row['start'], $row['end'],$row['custom_data']);
                        while ($row2 = $res2->fetch_array()) {
                            printf("<tr><td>Question No %s</td><td>Time = %s</td><td>Key = %s</td></tr>", $row2['question_id'], $row2['time'], $row2['answer']);
                        }
                    }
                    ?>
                </table>
    </div>
</body>

</html>
