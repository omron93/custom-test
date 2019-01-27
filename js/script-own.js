$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        items: 1,
        touchDrag:false,
        mouseDrag:false,
        center: true,
        startPosition: 0,
        dots: false,
        smartSpeed: 50
    });
    $(".owl-carousel").trigger('refresh.owl.carousel');
    $(function () { objectFitImages() });
});

// Block keyboard input for some time after new page appear
$(".owl-carousel").on("change.owl.carousel", function (e) {
    console.log("Lock");
    $(".owl-carousel").addClass("lock");
    setTimeout(function () {
        $(".owl-carousel").removeClass("lock");
        console.log("Unlock");
    }, 10);
});

$('.buttonNext').click(function() {
    $(".owl-carousel").trigger('next.owl.carousel');
});
 
$('.buttonPrev').click(function() {
    $(".owl-carousel").trigger('prev.owl.carousel');
});


var session_start = new Date();
var result_stored = false;

var page_enter = new Date();

var time_recording = 0;
var recorded_keys = [];
var recorded_times = [];

$('.time_start').click(function() {
    console.log("Time recording started")
    time_recording = 1;
    nextPage();
});

$('#submit').click(function() {
    nextPage();
    var session_end = new Date();
    var serial =  $("#custom_input").serializeArray();
    var custom_data = "";
    var i = 0;
    for (; i < serial.length-1; i += 1){
        custom_data += serial[i].name + ": " + serial[i].value + "; ";
    }
    custom_data += serial[i].name + ": " + serial[i].value;
    console.log("custom_data -", custom_data);
    $.ajax({
        url: 'send.php',
        type: 'POST',
        data: {"start": session_start.toUTCString(), "end": session_end.toUTCString(), "custom_data": custom_data, "times": recorded_times, "keys": recorded_keys},
        success: function (msg) {
            $("#submit").slideUp();
            $(".database_success").slideDown();
            $(".database_fail").slideUp();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            $(".database_fail").slideDown();
            $(".database_success").slideUp();
        }
    });
});


$('html').bind('keydown', function(e) {
    var code = e.charCode || e.keyCode;

    // Pages before time recording starts - next page on Enter
    if (time_recording == 0 && !$(".owl-carousel").hasClass("lock")) {
        if (code == 13) {
            if ($(".owl-carousel .owl-item.active .time_start").length > 0) {
                time_recording = 1;
            }
            nextPage();
        }
    }
    // Pages during time recording - specified keys
    if (time_recording == 1 && !$(".owl-carousel").hasClass("lock")) {
        console.log("Time recording keydown")
        if (code == 70 || code == 102 || code == 74 || code == 106) { // f j
            console.log(e.key);logAnswer(e.key);
            nextPage();
        } else {
            console.log(code);
        }
    }
});

function nextPage(){
    page_enter = new Date();
    $(".owl-carousel").trigger('next.owl.carousel');
    if ($(".owl-carousel .owl-item.active .time_stop").length > 0 ){
        if (result_stored == false){
            result_stored = true;
            $("#submit").trigger("click");
        }
    }
}

function logAnswer(code){
    var now = new Date();

    recorded_times.push(page_enter.getMilliseconds() - now.getMilliseconds());
    recorded_keys.push(code);
    console.log(now.getMilliseconds() - page_enter.getMilliseconds());
}

