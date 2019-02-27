require('../css/app.scss');
const $ = require('jquery');
require('../js/materialize.min.js');

$(function () {
    /* General */
    $('.modal').modal();
    $('select').formSelect();
    $('.sidenav').sidenav();

    /* Solicitud de servicio */
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        firstDay: true
    });
    $('.timepicker').timepicker({
        twelveHour: false
    });
    $('#clearInput').click(function () {
        $('#q').val("");
    });
    $('.request-btn').click(function () {
        $(this).parent().trigger("request");
    });
    $('article').on("request", function () {
        $('.section-article-request').find("article").remove();
        $(this).clone().appendTo(".section-article-request").find('a').remove();
    });
    /* Fin solicitud de servicio */

    /* Redireccionamiento */
    if ($('.count').length) {
        let time = 5;
        let counter = setInterval(() => {
            time -= 1;
            $('.count').html(time);
            if (time <= 0) {
                clearInterval(counter);
                $('.count-full-msg').html("Redireccionando...");
                window.location.replace("/");
            }
        }, 1000);
    }
})