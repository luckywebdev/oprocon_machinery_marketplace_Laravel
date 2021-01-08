import $ from 'jquery';
import Swiper, { Navigation, Pagination } from 'swiper';

// configure Swiper to use modules
Swiper.use([Navigation, Pagination]);

class IndustriesCarousel {
    constructor() {
        this.carousel = '#industries-carousel';
        this.init();
    }

    init() {
        const swiper = new Swiper(this.carousel, {
            loop: true,
            autoplay: true,
            slidesPerView: 1.5,
            spaceBetween: 15,

            navigation: {
                nextEl: '.industries .controller__nav--next',
                prevEl: '.industries .controller__nav--prev',
            },

            pagination: {
                el: '.industries .swiper-pagination',
                clickable: true,
            },
            
            breakpoints: {
                440: {
                    slidesPerView: 2.5,
                    spaceBetween: 15,
                },

                768: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            },
        });
    }
}

export default IndustriesCarousel;
