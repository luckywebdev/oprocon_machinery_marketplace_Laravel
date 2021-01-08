import $ from 'jquery';
import Swiper, { Navigation, Pagination } from 'swiper';

// configure Swiper to use modules
Swiper.use([Navigation, Pagination]);

class PortfulioCarousel {
    constructor() {
        this.carousel = '#portfulio-carousel';
        this.init();
    }

    init() {
        const swiper = new Swiper(this.carousel, {
            loop: true,
            autoplay: true,
            slidesPerView: 1.5,
            spaceBetween: 15,

            pagination: {
                el: '#portfulio-carousel .swiper-pagination',
                clickable: true,
            },
            
            breakpoints: {
                440: {
                    slidesPerView: 2.5,
                    spaceBetween: 15,
                },

                768: {
                    slidesPerView: 2.5,
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

export default PortfulioCarousel;
