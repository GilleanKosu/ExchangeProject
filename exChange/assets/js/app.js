require('../css/app.scss');
const $ = require('jquery');
require('../js/materialize.min.js');

$(function () {
    $('.modal').modal();
    $('select').formSelect();
    $('.sidenav').sidenav();
    $('#clearInput').click(function () {
        $('#q').val("");
    });
})