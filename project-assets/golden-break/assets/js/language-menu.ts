// language-menu.ts
import { BaseMenu } from "./base-menu";

class LanguageMenu extends BaseMenu {
  constructor() {
    super("language", "language__toggle");
  }

  public static closeLanguageMenu() {
    const languageButtons = document.querySelectorAll(".language__toggle");
    const languageMenus = document.querySelectorAll(".language__menu");
    const siteHeaders = document.querySelectorAll(".site-header");

    languageMenus.forEach((menu) => menu.classList.remove("open"));
    languageButtons.forEach((button) => button.classList.remove("open"));
    siteHeaders.forEach((header) => header.classList.remove("open"));

    languageButtons.forEach((button) =>
      button.setAttribute("aria-expanded", "false")
    );
    languageMenus.forEach((menu) =>
      menu.setAttribute("aria-hidden", "true")
    );
  }
}

const languageMenu = new LanguageMenu();
export { LanguageMenu, languageMenu };
