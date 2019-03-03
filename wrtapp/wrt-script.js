$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        items: 1,
        touchDrag:false,
        mouseDrag:false,
        center: true,
        startPosition: 0,
        dots: false,
        smartSpeed: 20
    });
    $(".owl-carousel").trigger('refresh.owl.carousel');
    $(function () { objectFitImages() });
});

// Get time of page enter and unblock keyboard input for some time
$(".owl-carousel").on("refreshed.owl.carousel", newPage);
$(".owl-carousel").on("translated.owl.carousel", newPage);

function newPage(e) {
    if ($(".owl-carousel .owl-item.active .time_start").length > 0) {
        console.log("TIME STARTED");
        time_recording = 1;
    }

    page_enter = new Date();
    setTimeout(function () {
        $(".owl-carousel").removeClass("lock");
        console.log("Unlock");
    }, 100);
};


var session_start = new Date();
var result_stored = false;

var page_enter = new Date();

var time_recording = 0;
var recorded_keys = [];
var recorded_times = [];

$('#submit').click(function() {
    var session_end = new Date();
    var serial =  $("#custom_input").serializeArray();
    var custom_vars = "";
    var custom_data = "";
    var i = 0;
    for (; i < serial.length-1; i += 1){
        custom_vars += serial[i].name + ";";
        custom_data += serial[i].value + ";";
    }
    custom_vars += serial[i].name
    custom_data += serial[i].value;
    console.log("custom_data -", custom_data);
    $.ajax({
        url: 'send.php',
        type: 'POST',
        data: {"start": session_start.toUTCString(), "end": session_end.toUTCString(), "custom_vars": custom_vars, "custom_data": custom_data, "times": recorded_times, "keys": recorded_keys},
        success: function (msg) {
            $("#submit").slideUp();
            $(".database_success").slideDown();
            $(".database_fail").slideUp();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            $("#submit").slideUp();
            $(".database_fail").slideDown();
            $(".database_success").slideUp();
        }
    });
});

var keysUp = next_keys.toUpperCase().split(',');
var keysLo = next_keys.toLowerCase().split(',');

$('html').bind('keydown', function(e) {
    var code = e.charCode || e.keyCode;
    // Pages before time recording starts - next page on Enter
    if (time_recording == 0 && !$(".owl-carousel").hasClass("lock")) {
        if (code == 13) {
            nextPage();
        }
    } else if (time_recording == 1 && !$(".owl-carousel").hasClass("lock")) {
    // Pages during time recording - specified keys
        console.log(e.key);
        console.log("Time recording keydown");
        if (keysUp.includes(e.key) || keysLo.includes(e.key)) {
            logAnswer(e.key);
            nextPage();
        } else {
            console.log(code);
        }
    }
});

function nextPage(){
    $(".owl-carousel").addClass("lock");
    console.log("Lock!");
    $(".owl-carousel").trigger("next.owl.carousel");
    if ($(".owl-carousel .owl-item.active .time_stop").length > 0 ){
        if (result_stored == false){
            result_stored = true;
            time_recording = 0;
            $("#submit").trigger("click");
        }
    }
}

function logAnswer(code){
    var now = new Date();

    recorded_times.push(now.getTime() - page_enter.getTime());
    recorded_keys.push(code);
    console.log(now.getTime() - page_enter.getTime());
}


// Custom JS
$('.buttonNext').click(function() {
    nextPage();
});

