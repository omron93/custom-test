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

    <script src="js/object-fit-images/dist/ofi.min.js"></script>

    <link rel="stylesheet" href="style/own.css">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Test - odpovedi</title>
</head>
<body style="overflow: auto!important;">
    <div class="row">

    </div>
                <h1>Předchozí odpovědi</h1>
                <table class="table">
                    <tr>
                        <td>id_sesion</td>
                        <td>začátek plnění</td>
                        <td>konec plnění</td>
                    </tr>
                    <?php
                    include "./connect.php";/* připojení k databázi */
                    $dotaz = mysql_query("select * from Kata_test_sesion");

                    while ($row = mysql_fetch_array($dotaz)) {
                        $dotaz2 = mysql_query("SELECT * FROM  `Kata_test_odpoved` WHERE  `id_sesion` = $row[0]");
                        $rowspan = mysql_num_rows($dotaz2) + 1;
                        printf("<tr><td rowspan=$rowspan>%s</td><td>%s</td><td>%s s</td><td>%s</td></tr>", $row[0], $row[1],$row[2]);
                        while ($row2 = mysql_fetch_array($dotaz2)) {
                            printf("<tr><td>%s</td><td>odpoved = %s</td><td>otazka = %s</td></tr>", $row2[2], $row2[3], $row2[4]);
                        }
                    }
                    ?>
                </table>
            </div>

<script src="js/script-own.js"></script>
</body>

</html>
