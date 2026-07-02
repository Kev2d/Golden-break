// settings-menu.ts
import { BaseMenu } from "./base-menu";

class SettingsMenu extends BaseMenu {
  constructor() {
    super("settings", "settings__toggle");
    this.initializeThemeButtons();
    this.initializeHideNotificationsButton();
    //this.applySystemThemeIfUnset();
  }

  private initializeThemeButtons() {
    const themeButtons = document.querySelectorAll("[data-theme-button]");

    themeButtons.forEach((button) => {
      button.addEventListener("click", (event) => {
        event.preventDefault();
        const clickedButton = event.currentTarget as HTMLElement;
        const theme = clickedButton.getAttribute("data-theme-button");

        if (theme) {
          this.setActiveThemeButton(clickedButton);
          this.setTheme(theme);
        }
      });
    });
  }

  private setActiveThemeButton(clickedButton: HTMLElement) {
    const themeButtons = document.querySelectorAll("[data-theme-button]");

    themeButtons.forEach((button) => {
      button.classList.remove("active");
    });
    clickedButton.classList.add("active");
  }

  private applySystemThemeIfUnset() {
    // Check if `data-theme` is not set on the HTML element
    const currentTheme = document.documentElement.getAttribute("data-theme");
    if (!currentTheme) {
      const prefersDark = window.matchMedia(
        "(prefers-color-scheme: dark)"
      ).matches;
      const systemTheme = prefersDark ? "dark" : "light";

      // Find all matching theme buttons
      const themeButtons = document.querySelectorAll(
        `[data-theme-button="${systemTheme}"]`
      );

      // Activate all matching theme buttons
      themeButtons.forEach((button) => {
        button.classList.add("active");
      });

      // Then set the theme on the document
      this.setTheme(systemTheme);
    }
  }

  private setTheme(theme: string) {
    document.documentElement.setAttribute("data-theme", theme);

    // Generate a unique cookie name based on the current domain
    const domain = window.location.hostname.replace(/\./g, "_"); // Replace dots with underscores to make it a valid name
    const themeCookieName = `${domain}_theme`; // Example: "example_com_theme"

    document.cookie = `${themeCookieName}=${theme}; path=/; max-age=31536000;`;
  }

  private initializeHideNotificationsButton() {
    const hideNotificationsButton = document.querySelector(
      "[data-notification-action='hide']"
    );

    hideNotificationsButton?.addEventListener("click", (event) => {
      event.preventDefault();
      hideNotificationsButton.classList.toggle("active");
    });
  }

  public static closeSettingsMenu() {
    const settingsButtons = document.querySelectorAll(".settings__toggle");
    const settingsMenus = document.querySelectorAll(".settings__menu");
    const siteHeaders = document.querySelectorAll(".site-header");

    settingsMenus.forEach((menu) => menu.classList.remove("open"));
    settingsButtons.forEach((button) => button.classList.remove("open"));
    siteHeaders.forEach((header) => header.classList.remove("open"));

    settingsButtons.forEach((button) =>
      button.setAttribute("aria-expanded", "false")
    );
    settingsMenus.forEach((menu) => menu.setAttribute("aria-hidden", "true"));
    settingsMenus.forEach((menu) => menu.setAttribute("inert", ""));
  }
}

const settingsMenu = new SettingsMenu();
export { SettingsMenu, settingsMenu };
