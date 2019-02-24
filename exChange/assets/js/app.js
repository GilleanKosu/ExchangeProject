require('../css/app.scss');
const $ = require('jquery');
require('../js/materialize.min.js');

console.log('Hello Webpack Encore');
$(function () {
    $('.modal').modal();
    $('select').formSelect();
    $("h1").css("color", "blue");
    $('.sidenav').sidenav();
    $('#clearInput').click(function () {
        $('#search').val(" ");
    });

})