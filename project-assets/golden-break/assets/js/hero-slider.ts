import Swiper from "swiper";
import { Autoplay, EffectFade, Pagination } from "swiper/modules";

Swiper.use([Autoplay, EffectFade, Pagination]);

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll<HTMLElement>("[data-hero-slider]").forEach(function (slider) {
    const slides = slider.querySelectorAll(".swiper-slide");

    if (slides.length <= 1) {
      return;
    }

    const hero = slider.closest(".hero-block");
    const pagination = hero?.querySelector<HTMLElement>(".hero-block-pagination") ?? undefined;

    const swiper = new Swiper(slider, {
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      effect: "fade",
      fadeEffect: {
        crossFade: true,
      },
      loop: true,
      pagination: pagination
        ? {
            el: pagination,
            clickable: true,
            renderBullet: function (index, className) {
              return `<button type="button" class="${className} hero-block__pagination-bullet" aria-label="Go to slide ${index + 1}"></button>`;
            },
          }
        : false,
      slidesPerView: 1,
      speed: 700,
    });

    pagination?.addEventListener("click", function (event) {
      const target = event.target as HTMLElement | null;
      const bullet = target?.closest(".hero-block__pagination-bullet");

      if (!bullet) {
        return;
      }

      const bullets = Array.from(pagination.querySelectorAll(".hero-block__pagination-bullet"));
      const slideIndex = bullets.indexOf(bullet);

      if (slideIndex >= 0) {
        swiper.slideToLoop(slideIndex);
      }
    });
  });
});
