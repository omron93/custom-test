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

var timer = null;
function newPage(e) {
    var index = $(".owl-carousel .owl-item.active").index();
    console.log("Page "+index);

    page_enter = new Date();

    if(timeouts[index] != "") {
        timer = setTimeout(function () {
            nextPage();
        }, parseInt(timeouts[index]));
    }
    setTimeout(function () {
        $(".owl-carousel").removeClass("lock");
        console.log("Unlock");
    }, 50);
};


var session_start = new Date();
var result_stored = false;

var page_enter = new Date();

var recorded_keys = {};
var recorded_times = {};

$('#submit').click(function() {
    var session_end = new Date();
    var serial =  $("#custom_input").serializeArray();
    var custom_vars = "";
    var custom_data = "";
    var i = 0;
    var form = document.getElementById("custom_input").elements;
    var inputs = new Set([]);
    for (var i = 0; i<form.length; i++) {
        if(form[i].name !== "") {
            inputs.add(form[i].name);
        }
    }
    inputs.forEach(function(val, key, set) {
        custom_vars += val + ";";
        custom_data += form[val].value + ";";
    });
    custom_vars = custom_vars.slice(0, -1);
    custom_data = custom_data.slice(0, -1);
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

$('html').bind('keydown', function(e) {
    var key = e.key;
    var code = e.charCode || e.keyCode;

    var index = $(".owl-carousel .owl-item.active").index();
    var keysUp = next_keys[index].toUpperCase().split(',');
    var keysLo = next_keys[index].toLowerCase().split(',');
    // No keys are allowed for the slide - next page on Enter
    if (keysUp == "" && !$(".owl-carousel").hasClass("lock")) {
        if (code == 13) {
            nextPage();
        }
    } else if (keysUp != "" && !$(".owl-carousel").hasClass("lock")) {
    // Key logging enabled
        console.log(key);
        if (keysUp.includes(key) || keysLo.includes(key)) {
            recorded_keys[index] = key;
            nextPage();
        } else {
            console.log(code);
        }
    }
});

function nextPage(){
    if(timer) {
        clearTimeout(timer);
        timer = null;
    }

    logTime();
    $(".owl-carousel").addClass("lock");
    console.log("Lock!");
    $(".owl-carousel").trigger("next.owl.carousel");
    if ($(".owl-carousel .owl-item.active .time_stop").length > 0 ){
        if (result_stored == false){
            result_stored = true;
            $("#submit").trigger("click");
        }
    }
}

function logTime(code){
    var now = new Date();
    var index = $(".owl-carousel .owl-item.active").index();

    recorded_times[index] = now.getTime() - page_enter.getTime();
    console.log(now.getTime() - page_enter.getTime());
}


// Custom JS
$('.buttonNext').on("click", function (e) {
    nextPage();
    e.preventDefault();
});

