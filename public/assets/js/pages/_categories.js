import $ from 'jquery';

$(document).ready(function () {
    var windowWidth = $(window).width();
    if (windowWidth < 992) {
        $('.categories__title').on('click', function (e) {
            $(this).parent().toggleClass('open')
        })
    }
})