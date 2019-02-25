require('../css/app.scss');
const $ = require('jquery');
require('../js/materialize.min.js');

console.log('Hello Webpack Encore');
$(function () {
    $('.modal').modal();
    $('select').formSelect();
    $('.sidenav').sidenav();
    $('#clearInput').click(function () {
        $('#search').val(" ");
    });
})