import Swiper from "swiper";

const productSwiper = new Swiper('.product-swiper', {
    slidesPerView: 3,
    centerInsufficientSlides: true,
    direction: 'horizontal',
    pagination: {
        el: '.swiper-pagination',
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    scrollbar: {
        el: '.swiper-scrollbar',
    },
    spaceBetween: 20,
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        480: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 3,
        },
    },
});
