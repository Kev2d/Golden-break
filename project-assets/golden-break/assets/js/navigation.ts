import { LanguageMenu } from "./language-menu";

class Navigation {
  constructor() {
    document.addEventListener("DOMContentLoaded", () => {
      this.initializeMenuItems();
      this.initializeHamburgers();
      this.initializeDocumentClick();
    });
  }

  private initializeMenuItems() {
    const menuItems = document.querySelectorAll(
      ".site-nav__menu .menu-item-has-children"
    );

    menuItems.forEach((item) => {
      const link = item.querySelector("a");
      const subMenu = item.querySelector(".sub-menu");

      link?.addEventListener("click", (event) => {
        event.preventDefault();

        const isMobileMenu = item.closest(".site-nav--mobile") !== null;
        if (subMenu?.classList.contains("open")) {
          subMenu.classList.remove("open");
          link.classList.remove("open");
        } else {
          if (!isMobileMenu) {
            this.closeAllMenus();
            LanguageMenu.closeLanguageMenu(); // Close the language menu
          }
          subMenu?.classList.add("open");
          link?.classList.add("open");
        }
      });
    });
  }

  private initializeHamburgers() {
    const hamburgers = Array.from(
      document.querySelectorAll(".js-hamburger")
    ) as HTMLElement[];

    if (hamburgers) {
      hamburgers.forEach((hamburger) => {
        hamburger.addEventListener("click", () => {
          LanguageMenu.closeLanguageMenu(); // Close the language menu
          this.closeAllSubMenus();
          const isOpen = hamburger
            .querySelector(".hamburger")
            ?.classList.contains("open");

          // Toggle hamburger button
          hamburger.querySelector(".hamburger")?.classList.toggle("open");

          // Toggle mobile navigation menu
          const siteNav = hamburger
            .closest(".site-header")
            ?.querySelector(".site-nav--mobile");
          siteNav?.classList.toggle("open", !isOpen);

          // Toggle header open class
          hamburger.closest(".site-header")?.classList.toggle("open", !isOpen);
        });
      });
    }
  }

  private initializeDocumentClick() {
    document.addEventListener("click", (event) => {
      const target = event.target as HTMLElement;
      const menuItems = document.querySelectorAll(
        ".site-nav__menu .menu-item-has-children"
      );
      const languageButton = document.querySelectorAll(".language__toggle");
      const languageMenu = document.querySelectorAll(".language__menu");
      const commonMenu = document.querySelectorAll(".common-menu__menu");
      const hamburgers = document.querySelectorAll(".js-hamburger");
      const siteNav = document.querySelectorAll(".site-nav");

      const isClickInsideMenu = Array.from(menuItems).some((item) =>
        item.contains(target)
      );
      const isClickInsideLanguageMenu = Array.from(languageMenu).some((menu) =>
        menu.contains(target)
      );
      const isClickOnLanguageButton = Array.from(languageButton).some(
        (button) => button.contains(target)
      );
      const isClickOnHamburger = Array.from(hamburgers).some((button) =>
        button.contains(target)
      );
      const isClickOnNav = Array.from(siteNav).some((nav) =>
        nav.contains(target)
      );

      const isClickOnCommonMenu = Array.from(commonMenu).some((menu) =>
        menu.contains(target)
      );

      if (
        !isClickInsideMenu &&
        !isClickOnHamburger &&
        !isClickOnNav &&
        !isClickInsideLanguageMenu &&
        !isClickOnLanguageButton &&
        !isClickOnCommonMenu
      ) {
        LanguageMenu.closeLanguageMenu();
        this.closeAllMenus();
      }
    });
  }

  public closeAllMenus() {
    const openHeaders = document.querySelectorAll(".site-header.open");
    const openSiteNav = document.querySelectorAll(".site-nav.open");
    const openSubMenus = document.querySelectorAll(".sub-menu.open");
    const openMenuLinks = document.querySelectorAll(".site-nav.open");
    const openLinks = document.querySelectorAll(".site-nav__menu a.open");
    const hamburgers = document.querySelectorAll(".js-hamburger .hamburger");
    openSubMenus.forEach((subMenu) => {
      subMenu.classList.remove("open");
    });

    openLinks.forEach((link) => {
      link.classList.remove("open");
    });

    openMenuLinks.forEach((link) => {
      link.classList.remove("open");
    });

    openSiteNav.forEach((siteNav) => {
      siteNav.classList.remove("open");
    });

    hamburgers.forEach((hamburger) => {
      hamburger.classList.remove("open");
    });

    openHeaders.forEach((header) => {
      header.classList.remove("open");
    });
  }

  public closeAllSubMenus() {
    const openSubMenus = document.querySelectorAll(".sub-menu.open");

    openSubMenus.forEach((subMenu) => {
      subMenu.classList.remove("open");
    });
  }
}

const navigation = new Navigation();
export { navigation };
