class SmartHeader {
  private static readonly HIDE_DISTANCE = 320;
  private static readonly REVEAL_DISTANCE = 8;

  private readonly header: HTMLElement;
  private readonly headerSlot: HTMLElement;
  private lastScrollY: number;
  private headerOffsetTop: number;
  private downwardDistance = 0;
  private upwardDistance = 0;
  private direction: "up" | "down" | null = null;
  private ticking = false;

  constructor(header: HTMLElement) {
    this.header = header;
    this.headerSlot = header.closest<HTMLElement>(".site-header-slot") ?? header;

    this.lastScrollY = Math.max(window.scrollY, 0);
    this.headerOffsetTop = this.getDocumentTop(this.headerSlot);

    window.addEventListener("scroll", this.handleScroll, { passive: true });
    window.addEventListener("resize", this.handleResize);
    this.update();
  }

  private getDocumentTop(element: HTMLElement): number {
    return element.getBoundingClientRect().top + Math.max(window.scrollY, 0);
  }

  private handleScroll = () => {
    if (this.ticking) {
      return;
    }

    this.ticking = true;
    window.requestAnimationFrame(() => {
      this.update();
      this.ticking = false;
    });
  };

  private handleResize = () => {
    this.headerOffsetTop = this.getDocumentTop(this.headerSlot);
    this.update();
  };

  private update() {
    const currentScrollY = Math.max(window.scrollY, 0);
    const isPastHeader = currentScrollY > this.headerOffsetTop;
    const isMenuOpen = this.header.classList.contains("open");

    this.header.classList.toggle("site-header--fixed", isPastHeader);
    this.header.classList.toggle("site-header--scrolled", isPastHeader);

    if (!isPastHeader || isMenuOpen) {
      this.header.classList.remove("site-header--hidden");
      this.downwardDistance = 0;
      this.upwardDistance = 0;
      this.direction = null;
      this.lastScrollY = currentScrollY;
      return;
    }

    const scrollDelta = currentScrollY - this.lastScrollY;

    if (scrollDelta === 0) {
      return;
    }

    if (scrollDelta > 0) {
      if (this.direction !== "down") {
        this.downwardDistance = 0;
      }

      this.direction = "down";
      this.upwardDistance = 0;
      this.downwardDistance += scrollDelta;

      if (this.downwardDistance >= SmartHeader.HIDE_DISTANCE) {
        this.header.classList.add("site-header--hidden");
      }
    } else {
      if (this.direction !== "up") {
        this.upwardDistance = 0;
      }

      this.direction = "up";
      this.downwardDistance = 0;
      this.upwardDistance += Math.abs(scrollDelta);

      if (this.upwardDistance >= SmartHeader.REVEAL_DISTANCE) {
        this.header.classList.remove("site-header--hidden");
      }
    }

    this.lastScrollY = currentScrollY;
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const header = document.querySelector<HTMLElement>(".site-header");

  if (header) {
    new SmartHeader(header);
  }
});
