import $ from 'jquery';
import Swiper, {
    Navigation,
    Pagination
} from 'swiper';

// configure Swiper to use modules
Swiper.use([Navigation, Pagination]);

class JoinCarousel {
    constructor() {
        this.carousel = '#join-carousel';
        this.window = $(window);
        this.init();
    }

    init() {

        let swiper = undefined,
            _this = this;

        this.window.on('resize', function () {
            let windowWidth = $(this).width();
            if (windowWidth < 768 && swiper === undefined) {
                initSwiper();
                swiper.update();
            } else if (windowWidth >= 768 && swiper !== undefined) {
                swiper.destroy(true, true);
                swiper = undefined;
                $(this.carousel).find('.swiper-wrapper').removeAttr('style');
                $(this.carousel).find('.swiper-slide').removeAttr('style');  
            }
        })

        if (this.window.width() < 768) {
            initSwiper();
        }

        function initSwiper() {
            swiper = new Swiper(_this.carousel, {
                loop: true,
                autoplay: true,
                slidesPerView: 1,
                autoHeight: true,
                pagination: {
                    el: '.swiper-pagination--join',
                    clickable: true,
                },
            });
        }

    }
}

export default JoinCarousel;