// base-menu.ts
import { navigation } from "./navigation";

class BaseMenu {
  private static instances: BaseMenu[] = [];

  constructor(private menuClass: string, private toggleClass: string) {
    BaseMenu.instances.push(this);

    document.addEventListener("DOMContentLoaded", () => {
      this.initializeMenuButtons();
    });
  }

  private initializeMenuButtons() {
    const menuButtons = document.querySelectorAll(`.${this.toggleClass}`);

    menuButtons.forEach((button) => {
      button.addEventListener("click", (event) => {
        event.preventDefault();
        const menu = button
          .closest(`.${this.menuClass}`)
          ?.querySelector(`.${this.menuClass}__menu`);

        if (menu) {
          this.toggleMenu(button as HTMLElement, menu as HTMLElement);
        } else {
          console.error(`No menu found for button: ${button}`);
        }
      });
    });
  }

  private toggleMenu(button: HTMLElement, menu: HTMLElement) {
  const isInsideMobileNav = !!button.closest(".site-nav--mobile");

  // Only close all menus if not in mobile nav
  if (!isInsideMobileNav) {
    navigation.closeAllMenus();
  }

    
    const isOpen = menu.classList.contains("open");
    const header = button.closest(".site-header");

    if (isOpen) {
      this.closeMenu(button, menu);
    } else {
      BaseMenu.closeAllMenusExcept(this);
      this.openMenu(button, menu, header);
    }
  }

  private openMenu(
    button: HTMLElement,
    menu: HTMLElement,
    header: Element | null
  ) {
    menu.classList.add("open");
    button.classList.add("open");
    header?.classList.add("open");
    button.setAttribute("aria-expanded", "true");
    menu.setAttribute("aria-hidden", "false");
    menu.removeAttribute("inert");
  }

  private closeMenu(button: HTMLElement, menu: HTMLElement) {
    menu.classList.remove("open");
    button.classList.remove("open");
    button.setAttribute("aria-expanded", "false");
    menu.setAttribute("aria-hidden", "true");
  }

  private static closeAllMenusExcept(exceptInstance: BaseMenu) {
    BaseMenu.instances.forEach((instance) => {
      if (instance !== exceptInstance) {
        instance.closeAllMenus();
      }
    });
  }

  private closeAllMenus() {
    const menuButtons = document.querySelectorAll(`.${this.toggleClass}`);
    const menus = document.querySelectorAll(`.${this.menuClass}__menu`);
    const siteHeaders = document.querySelectorAll(".site-header");

    menus.forEach((menu) => menu.classList.remove("open"));
    menuButtons.forEach((button) => button.classList.remove("open"));
    siteHeaders.forEach((header) => header.classList.remove("open"));

    menuButtons.forEach((button) =>
      button.setAttribute("aria-expanded", "false")
    );
    menus.forEach((menu) => menu.setAttribute("aria-hidden", "true"));
  }
}

export { BaseMenu };
