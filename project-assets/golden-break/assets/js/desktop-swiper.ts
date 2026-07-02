import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";

// Register modules
Swiper.use([Pagination, Navigation]);

import { SCREEN_SM_MIN, SCREEN_MD_MIN } from "./breakpoints"; // Your custom breakpoint file

document.addEventListener("DOMContentLoaded", function () {
  let swiper: Swiper | null = null;

  function getSlidesPerView() {
    if (window.innerWidth >= SCREEN_MD_MIN) return 2; // Desktop
    if (window.innerWidth >= SCREEN_SM_MIN) return 2; // Tablet
    return 1; // Mobile
  }

  function initializeDesktopSwiper() {
    if (!swiper) {
      swiper = new Swiper(".custom-swiper-container-desktop", {
        navigation: {
          nextEl: ".content-controls-next",
          prevEl: ".content-controls-prev",
        },
        pagination: {
          el: ".content-controls-pagination",
          type: "custom",
          renderCustom: function (swiper, current, total) {
            return `${current}/${total}`;
          },
        },
        slidesPerView: getSlidesPerView(),
        spaceBetween: 20,
        wrapperClass: "custom-swiper-wrapper",
        slideClass: "custom-swiper-slide",
        loop: true,
      });
    } else {
      swiper.params.slidesPerView = getSlidesPerView();
      swiper.update();
    }
  }

  // Initialize Swiper on load
  initializeDesktopSwiper();

  // Update Swiper slides on window resize
  window.addEventListener("resize", initializeDesktopSwiper);
});
