import { Swiper } from "swiper";
import { Navigation, EffectFade, Pagination } from "swiper/modules";
import SwiperAnimation from "@cycjimmy/swiper-animation";
import "swiper/css/bundle";
import "swiper/css/pagination";

import "animate.css";

const swiperAnimation = new SwiperAnimation();
const swiper = new Swiper(".swiper", {
    modules: [Navigation, EffectFade],
    slidesPerView: 1,
    speed: 0,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    on: {
        init: function () {
            swiperAnimation.init(this).animate();
        },
        slideChange: function () {
            swiperAnimation.init(this).animate();
        },
    },
});

const testimonialSwiper = new Swiper(".testimonial-swiper", {
    modules: [Pagination],
    slidesPerView: 1,
    speed: 300,
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});
