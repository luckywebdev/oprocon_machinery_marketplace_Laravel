import $ from 'jquery';
import 'popper.js';
import 'bootstrap/js/dist/dropdown';
import 'bootstrap/js/dist/carousel';
import 'bootstrap/js/dist/collapse';
import 'bootstrap/js/dist/modal';

//import header
import Nav from './modules/_header';

//portfulio carsousel
import PortfulioCarousel from './modules/_portfulio-carousel';

import './modules/_footer';

//document ready function
$(document).ready(() => {

    //init navigaiton
    new Nav();

    //init portfulio-carousel
    if ($(window).width() < 992) {
        new PortfulioCarousel();
    }

    //upload profile img
    $('.js-file-upload').change(function (e) {
        var event = e;
        uploadProfileImg(event, '.js-profile-img');
    });

    //upload profile img
    $('.js-file-upload-company').change(function (e) {
        var event = e;
        uploadProfileImg(event, '.js-profile-img-company');
    });

    function uploadProfileImg(event, profileImgHolder) {
        for (var i = 0; i < event.originalEvent.srcElement.files.length; i++) {
            var file = event.originalEvent.srcElement.files[i];
            var img = document.querySelector(profileImgHolder); // here is img id
            var reader = new FileReader();
            reader.onloadend = function () {
                img.src = reader.result;
            };
            reader.readAsDataURL(file);
        }
    }

    //insert new field
    $('.form-group__btn-add').on('click', function () {
        var field = $('.js-address').eq(0),
            cloneField = field.clone();
        field.after(cloneField);
    });


    //join carousel

    var joinCarousel = function () {
        var windowWidth = $(window).width(),
            joinCarousel = $('#join-carousel'),
            initCarousel = false;

        if (windowWidth < 768) {
            joinCarousel.carousel({
                ride: 'carousel',
            });
            initCarousel = true;
        } else {
            if (initCarousel) {
                joinCarousel.carousel('dispose');
                initCarousel = false;
            }
        }
    }

    joinCarousel();

    $(window).resize(function () {
        joinCarousel();
    })

    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
          $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');
      
      
        $(this).parents('li.dropdown.show').on('hidden.bs.dropdown', function(e) {
          $('.dropdown-submenu .show').removeClass("show");
        });
        return false;
      });


    $("#account-setting").submit(function(e){
        e.preventDefault();
        console.log('save_action===>', $(this).attr('action'));
        console.log('save_action===>', $(this).serialize());
        $.ajax({
            // dataType: 'json',
            type: "POST",
            url:$(this).attr('action'),
            data: $(this).serialize(),
            success: function(result) {
                console.log('save===>', result);
                return false;
            },
            error: function(result) {
                // var newData = JSON.parse(result)
            var error = result.responseJSON.errors.email[0];
                $("#email_error").html(error);

            },
        });
    })
});