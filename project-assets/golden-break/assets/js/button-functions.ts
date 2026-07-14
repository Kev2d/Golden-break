import { navigation } from "./navigation";

class ButtonFunctions {
  static initialize() {
    document.addEventListener("DOMContentLoaded", () => {
      this.initializeFunctionButtons();
    });
  }

  private static initializeFunctionButtons() {
    const closeNavButtons = document.querySelectorAll(
      'button[data-function="close-nav-menu"]'
    );
    const subMenuButtons = document.querySelectorAll(
      'button[data-function="back-to-previous-menu"]'
    );

    const languageMenuButtons = document.querySelectorAll(
      'button[data-function="close-language-menu"]'
    );

    const accordionButton = document.querySelectorAll(
      'button[data-function="accordion-toggle"]'
    );

    closeNavButtons.forEach((button) => {
      button.addEventListener("click", (event) => {
        event.preventDefault();
        this.closeNav();
      });
    });

    subMenuButtons.forEach((button) => {
      button.addEventListener("click", (event) => {
        event.preventDefault();
        this.closeCurrentSubMenu(button as HTMLElement);
      });
    });

    languageMenuButtons.forEach((button) => {
      button.addEventListener("click", (event) => {
        event.preventDefault();
        this.closeLanguageMenu(button as HTMLElement);
      });
    });

    accordionButton.forEach((button) => {
      button.addEventListener("click", (event) => {
        event.preventDefault();
        this.toggleAccordion(button as HTMLElement);
      });
    });
  }

  static closeNav() {
    navigation.closeAllMenus();
  }

  static closeCurrentSubMenu(button: HTMLElement) {
    const subMenu = button.closest(".sub-menu");
    subMenu?.classList.remove("open");
    this.removeOpenStateFromLinks(subMenu as HTMLElement);
  }

  static closeLanguageMenu(button: HTMLElement) {
    const languageContainer = button.closest(".language");
    const languageMenu = languageContainer?.querySelector(".language__menu");
    const languageToggle =
      languageContainer?.querySelector(".language__toggle");
    languageMenu?.classList.remove("open");
    languageToggle?.classList.remove("open");
  }

  static removeOpenStateFromLinks(menu: HTMLElement) {
    const links = menu.querySelectorAll("a");
    const parentLi = menu.closest("li.menu-item-has-children");
    links.forEach((link) => {
      link.classList.remove("open");
    });
    const mainLink = parentLi?.querySelector("a.open");
    mainLink?.classList.remove("open");
  }

  static toggleAccordion(button: HTMLElement) {
    const accordion = button.nextElementSibling as HTMLElement; // Select next sibling
    if (accordion && accordion.matches('[data-role="accordion-content"]')) {
      const isExpanded = button.getAttribute("aria-expanded") === "true";
      button.setAttribute("aria-expanded", (!isExpanded).toString());

      if (isExpanded) {
        accordion.style.maxHeight = "0";
        accordion.setAttribute("aria-hidden", "true");
        accordion.setAttribute("inert", "");
      } else {
        accordion.style.maxHeight = accordion.scrollHeight + "px"; // Set to scrollHeight for a smooth animation
        accordion.setAttribute("aria-hidden", "false");
        accordion.removeAttribute("inert");
      }
    }
  }
}

// Initialize the button functions when this module is loaded
ButtonFunctions.initialize();

export default ButtonFunctions;
