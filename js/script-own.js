$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        items: 1,
        touchDrag:false,
        mouseDrag:false,
        center: true,
        startPosition: 0,
        dots: false,
        smartSpeed: 150
    });
    $(".owl-carousel").trigger('refresh.owl.carousel');
    $(function () { objectFitImages() });
    var d = new Date();
    //console.log(d.toUTCString());
    $(".owl-item input.ot-time").val("null");


});

var seconds = 0;
var start = new Date();
$('.time_start').click(function() {
    start = new Date();
});

function incrementSeconds() {
    seconds++;
    var sekundy = seconds%60;
    var minuty = parseInt(seconds/60);
}

$('.customNextBtn').click(function() {
    $(".owl-carousel").trigger('next.owl.carousel');
});

$('.customPrevBtn').click(function() {
    $(".owl-carousel").trigger('prev.owl.carousel');
});

$("a.customNextBtn, a.customPrevBtn").on("click", function (e) {
    e.preventDefault();
});

$('#submit').click(function() {
    var konec = new Date();
    //console.log(konec.toUTCString(), konec.getUTCHours(), konec.getUTCMinutes() ,konec.getUTCSeconds() ,konec.getUTCMilliseconds());
    var serial =  $("#test").serializeArray();
    var data = [];
    var otazka_c = 0;
    for (var i= 0; i < serial.length; i = i+2){
        otazka_c++;
        if (serial[i].value == "null"){
            i--;
        }
        else {
            data[data.length] = [serial[i].value, serial[i+1].value, otazka_c];
        }
    }
    $.ajax({
        url: 'send.php',
        type: 'POST',
        data: {"start": start.toUTCString().slice(0,-4).concat("."+start.getUTCMilliseconds().toString().padStart(3,'0')+" GTM"), "konec": konec.toUTCString().slice(0,-4).concat("."+konec.getUTCMilliseconds().toString().padStart(3,'0')+" GTM"), "odpovedi": data},
        success: function (msg) {
            console.log("odesláno");
            $("#submit").slideUp();
            $(".uspesne-odeslano").slideDown();
            $(".neuspesne-odeslano").slideUp();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            $(".neuspesne-odeslano").slideDown();
            $(".uspesne-odeslano").slideUp();
        }
    });
});


$('html').bind('keydown', function(e) {
    var ind = $(".owl-item.active").index();
    var uv = $(".owl-carousel .owl-item.active .time_stop, .owl-carousel .owl-item.active .time_start");
    if (ind >= 0 && uv.length<=0 && !$(".owl-carousel").hasClass("zamknuto")) {
        var code = e.charCode || e.keyCode;
        if (code == 70 || code == 102) { // f
            //console.log("f");
            $(".owl-item.active .form-group label:nth-of-type(1) input[type=radio]").prop('checked', true);
            setTimeofAnswer();
            nextPage();
        } else if (co0de == 74 || code == 106) { // j
            //console.log("j");
            $(".owl-item.active .form-group label:nth-of-type(2) input[type=radio]").prop('checked', true);
            setTimeofAnswer();
            nextPage();
        } else {
            //console.log(e.keyCode);
        }
    }
});

$("input[type='radio']").change(function ()
{
    setTimeofAnswer();
    nextPage();
});

var odeslano = false;
function nextPage(){
    setTimeout(function(){
        $(".owl-carousel").trigger('next.owl.carousel');
        if ($(".owl-carousel .owl-item.active .time_stop").length > 0 ){
            //console.log("odeslat???");
            if (odeslano == false){
                odeslano = true;
                $("#submit").trigger("click");
            }
        }
    }, 300);
}
function setTimeofAnswer(){
    var d = new Date();
    //console.log(d.toUTCString());
    $(".owl-item.active input.ot-time").val(d.toUTCString().slice(0,-4).concat("."+d.getUTCMilliseconds().toString().padStart(3,'0')+" GTM"));
}


$(".owl-carousel").on("change.owl.carousel", function (e) {
    //console.log("statr");
    $(".owl-carousel").addClass("zamknuto");
    setTimeout(function () {
        $(".owl-carousel").removeClass("zamknuto");
        //console.log("stop");
    }, 200);
});
