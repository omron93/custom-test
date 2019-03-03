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

    <link rel="stylesheet" href="wrtapp/OwlCarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="wrtapp/OwlCarousel/dist/assets/owl.theme.default.min.css">
    <script src="wrtapp/OwlCarousel/dist/owl.carousel.min.js"></script>

    <script src="wrtapp/object-fit-images/dist/ofi.min.js"></script>

    <link rel="stylesheet" href="wrtapp/wrt-style.css">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Response tester</title>
</head>
<body>
<form id="custom_input" action="send.php" method="post">
    <div name="owl-slides" class="owl-carousel owl-theme">

<?php
$handle = fopen("questionnaire.html", "r");
$next_keys = "";
if ($handle) {
    $stage = 0;
    while (($line = fgets($handle)) !== false) {
        if (substr( $line, 0, 8 ) == "<!--++++" && substr( $line, -4, -1 ) == "-->") {
            $keys = substr($line, 8, -4);
            if ($stage != 0) { echo "</div>"; }
            if (empty($keys)) {
                echo "<div class=''>";
            } else {
                $next_keys = $keys;
                echo "<div class='time_start $keys'>";
            }
            $stage = 1;
        } else {
            if ($stage == 0) { echo "<div class=''>"; $stage = 1; }
                echo $line;
            }
        }
        if ($stage > 0) { echo '</div>'; }

        echo '
<div><input id="submit" class="time_stop" style="width:300px;" type="button" name="submit" value="Save results" />
  <div class="database_success">
    <h4>Responses saved!</h4>
    You can now close the web page. Thank you.
  </div>
  <div class="database_fail">
    <h4>Error occured. Can\'t store responses into database!</h4>
  </div>
</div>';


            fclose($handle);
        }
?>


    </div>

</form>
<script type="text/javascript">var next_keys = "<?= $next_keys ?>";</script>
<script type="text/javascript" src="wrtapp/wrt-script.js"></script>
</body>

</html>
