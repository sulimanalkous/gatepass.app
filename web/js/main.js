var pathname = window.location.href;
var partsArray = pathname.split('/');
var url = '/' + partsArray[3];
var a_s = $('li a');
a_s.removeClass('active');
$('li a').each(function () {
    if ($(this).attr('href') == url) {
        $(this).addClass('active');
    }

});


$(document).ready(function(){
    $("#side_setting > a").click(function(){
        // $("#contents").load('url to home.php');
        alert("settings ");
    });
});