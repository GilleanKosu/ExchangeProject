require('../css/app.scss');
const $ = require('jquery');

console.log('Hello Webpack Encore');
$(function () {
    alert("Hola");
    $("h1").css("color", "blue");
})