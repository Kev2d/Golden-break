import Swiper from "swiper";
import { Navigation, Pagination } from 'swiper/modules';

// Register modules
Swiper.use([Pagination, Navigation]);

import { SCREEN_SM_MIN } from './breakpoints'; // Your custom breakpoint file
document.addEventListener("DOMContentLoaded", function () {
  let swiper: Swiper | null = null;
  
  function initializeSwiper() {
    if (window.innerWidth <= SCREEN_SM_MIN) {
      if (!swiper) {
        swiper = new Swiper(".custom-swiper-container", {
          pagination: {
            el: ".content-controls-pagination",
            type: "custom",
            renderCustom: function (swiper, current, total) {
              return `${current}/${total}`;
            },
          },
          navigation: {
            nextEl: ".content-controls-next",
            prevEl: ".content-controls-prev",
          },
          slidesPerView: "auto",
          spaceBetween: 20,
          wrapperClass: "custom-swiper-wrapper",
          slideClass: "custom-swiper-slide",
        });
      }
    } else if (swiper) {
      swiper.destroy(true, true);
      swiper = null;
    }
  }

  // Initialize Swiper on load
  initializeSwiper();

  // Reinitialize Swiper on window resize
  window.addEventListener("resize", function () {
    initializeSwiper();
  });
});
