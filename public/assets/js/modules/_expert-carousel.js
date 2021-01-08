import $ from 'jquery';
import Swiper, {
    Navigation,
    Pagination
} from 'swiper';

// configure Swiper to use modules
Swiper.use([Navigation, Pagination]);

class ExpertCarousel {
    constructor() {
        this.carouselMobi = '#connected-carousel--mobi';
        this.carouselDesktop = '#connected-carousel--desktop';
        this.init();
    }

    init() {
        if ($(window).width() >= 768) {
            const swiperDesktop = new Swiper(this.carouselDesktop, {
                loop: true,
                autoplay: true,
                speed: 600,
                slidesPerView: .60,

                navigation: {
                    nextEl: '.connected .controller__nav--next',
                    prevEl: '.connected .controller__nav--prev',
                },

                pagination: {
                    el: '.connected .swiper-pagination',
                    clickable: true,
                },

                breakpoints: {
                    768: {
                        slidesPerView: 1,
                    }
                }
            });
        }

        if ($(window).width() < 768) {
            const swiperMobi = new Swiper(this.carouselMobi, {
                loop: true,
                autoplay: true,
                speed: 600,
                slidesPerView: 1.30,
                spaceBetween: 15,
                
                pagination: {
                    el: '.connected .swiper-pagination',
                    clickable: true,
                },
            });
        }
    }
}

export default ExpertCarousel;