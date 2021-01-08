import $ from 'jquery';

//footer accordion
$(document).ready(function () {
    $('.footer__widget_title').on('click', function (e) {
        if ($(window).width() < 768) {
            if ($(this).parents('.col-12').hasClass('open')) {
                return false;
            } else {
                $(this)
                    .parents('.col-12')
                    .siblings()
                    .removeClass('open')
                    .find('.footer__widget_nav')
                    .slideUp(500);
                $(this)
                    .parents('.col-12')
                    .toggleClass('open')
                    .find('.footer__widget_nav')
                    .slideToggle(500);
                return false;
            }
        }
    });
})