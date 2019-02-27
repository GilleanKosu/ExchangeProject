require('../css/app.scss');
const $ = require('jquery');
require('../js/materialize.min.js');

$(function () {
    $('.modal').modal();
    $('select').formSelect();
    $('.sidenav').sidenav();
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
        $('.section-article-request').find(".service-id").remove();
        $('.section-article-request').find("article").remove();
        $(this).find('.service-id').clone().appendTo(".section-article-request");
        $(this).clone().appendTo(".section-article-request").find('a').remove();
    });
})