<?php
ini_set("default_charset", "UTF-8");

$cache_filename = './questionnaire.cache';

// Cache is newer than questionnaire.html
if (file_exists($cache_filename))
{
    $diff_in_secs = (filemtime($cache_filename) - filemtime('./questionnaire.html'));
    if ( $diff_in_secs > 120 )
    {
        print file_get_contents($cache_filename);
        exit();
    }
}
ob_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <link rel="stylesheet" href="wrtapp/OwlCarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="wrtapp/OwlCarousel/dist/assets/owl.theme.default.min.css">
    <script src="wrtapp/OwlCarousel/dist/owl.carousel.min.js"></script>

    <script src="wrtapp/object-fit-images/dist/ofi.min.js"></script>
    <script src="wrtapp/progressbar.js"></script>

    <link rel="stylesheet" href="wrtapp/wrt-style.css">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Response tester</title>
</head>
<body>
<form id="custom_input" action="javascript:void(0);">
    <div id="progressBar" style="height:3%;"></div>
    <div name="owl-slides" class="owl-carousel owl-theme">

<?php
$handle = fopen("questionnaire.html", "r");
$next_keys = array();
$timeouts = array();
if ($handle) {
    $stage = 0;
    while (($line = fgets($handle)) !== false) {
        if (substr( $line, 0, 8 ) == "<!--++++" && substr( $line, -4, -1 ) == "-->") {
            $options = explode(":", substr($line, 8, -4));
            if ($stage != 0) { echo "</div>"; };
            array_push($next_keys, $options[0]);
            if (count($options) >= 2) {
                array_push($timeouts, $options[1]);
            } else {
                array_push($timeouts, "");
            }
            echo "<div>";
            $stage = 1;
        } else {
            if ($stage == 0) {
                echo "<div>";
                array_push($next_keys, "");
                array_push($timeouts, "");
                $stage = 1;
            }
            echo $line;
        }
    }
    if ($stage > 0) { echo '</div>'; }
    array_push($next_keys, "");
    array_push($timeouts, "");

    echo '
<div>
  <div class="time_stop spinner-border" role="status">
    <span class="sr-only">Saving...</span>
  </div>
  <div id="database_success" class="alert alert-success" style="display:none;">
    <h4>Responses saved!</h4>
    You can now close the web page. Thank you.
  </div>
  <div id="database_fail" class="alert alert-danger" style="display:none;">
    <h4>Error occured. Can\'t store responses into database!</h4>
    <p><button class="btn btn-outline-secondary" onclick="saveResults();">Retry</button>
  </div>
</div>';


    fclose($handle);
}
?>


    </div>

</form>
<script type="text/javascript">var next_keys = <?php echo json_encode($next_keys); ?>;</script>
<script type="text/javascript">var timeouts = <?php echo json_encode($timeouts); ?>;</script>
<script type="text/javascript" src="wrtapp/wrt-script.js"></script>
</body>

</html>

<?php
$content = ob_get_contents();
ob_end_flush();
$file = fopen ( $cache_filename, 'w' );
fwrite ( $file, $content );
fclose ( $file );
?>
