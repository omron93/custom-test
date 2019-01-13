<?php
ini_set("default_charset", "UTF-8");

include "php/parsedown/Parsedown.php"
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
    <title>Test</title>
</head>
<body>
<div class="cas-plneni">
    Čas plnění: <span class="minuty">00</span>m:<span class="sekundy">00</span>s
</div>

<form id="test" action="send.php" method="post">
    <div class="owl-carousel owl-theme">
        <?php
        $Parsedown = new Parsedown();
        $handle = fopen("custom/content.htm", "r");
        if ($handle) {
            echo "<div class=''>";
            while (($line = fgets($handle)) !== false) {
                if (substr( $line, 0, 4 ) === "++++"){
                    echo "</div>";
                    if (($line = fgets($handle)) !== false){
                        if (substr( $line, 0, 15 ) === "<!-- uvodni -->"){
                            echo "<div class='uvodni'>";
                        }
                        else if (substr( $line, 0, 23 ) === "<!-- uvodni konecny -->"){
                            echo "<div class='uvodni konecny'>";
                        }
                        else if (substr( $line, 0, 16 ) === "<!-- konecny -->"){
                            echo "<div class='konecny'>";
                        }
                        else{
                            echo "<div class=''>";
                        }
                    }
                    else{
                        echo "<div class=''>";
                    }
                }
                else{
                    echo $line;
                }
            }
            echo "</div>";

            fclose($handle);
        } else {
            // error opening the file.
        }
        ?>

    </div>

</form>
<script src="js/script-own.js"></script>
</body>

</html>