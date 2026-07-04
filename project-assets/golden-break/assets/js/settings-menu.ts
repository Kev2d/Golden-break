class SettingsMenu {
  constructor() {
    this.initializeHideNotificationsButton();
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
